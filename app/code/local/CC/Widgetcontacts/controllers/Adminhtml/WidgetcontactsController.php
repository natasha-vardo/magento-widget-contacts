<?php

class CC_Widgetcontacts_Adminhtml_WidgetcontactsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('widgetcontacts/adminhtml_widgetcontacts'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('contact_id');
        Mage::register('widgetcontacts_block',Mage::getModel('widgetcontacts/block')->load($id));
        $blockObject = (array)Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if(count($blockObject)) {
            Mage::registry('widgetcontacts_block')->setData($blockObject);
        }
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('widgetcontacts/adminhtml_widgetcontacts_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('contact_id');
            $block = Mage::getModel('widgetcontacts/block')->load($id);
            $block
                ->setData($this->getRequest()->getParams())
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();

            if(!$block->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Cannot save the address');
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
            return  $this->_redirect('*/*/edit',array('contact_id'=>$this->getRequest()->getParam('contact_id')));
        }

        Mage::getSingleton('adminhtml/session')->addSuccess('Address was saved successfully!');

        $this->_redirect('*/*/'.$this->getRequest()->getParam('back','index'),array('contact_id'=>$block->getId()));
    }

    public function deleteAction()
    {
        $block = Mage::getModel('widgetcontacts/block')
            ->setId($this->getRequest()->getParam('contact_id'))
            ->delete();
        if($block->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Address was deleted successfully!');
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $blocks = $this->getRequest()->getParams();
        try {
            $blocks= Mage::getModel('widgetcontacts/block')
                ->getCollection()
                ->addFieldToFilter('contact_id',array('in'=>$blocks['massaction']));
            foreach($blocks as $block) {
                $block->delete();
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Addresses were deleted!');

        return $this->_redirect('*/*/');
    }
}
