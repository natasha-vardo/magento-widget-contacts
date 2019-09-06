<?php

class CC_Widgetcontacts_Block_Adminhtml_Widgetcontacts_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'contact_id';
        $this->_controller = 'adminhtml_widgetcontacts';
        $this->_blockGroup = 'widgetcontacts';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('widgetcontacts')->__('Save Address'));
        $this->_updateButton('delete', 'label', Mage::helper('widgetcontacts')->__('Delete Address'));
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText(): string
    {
        if (Mage::registry('widgetcontacts_block')->getId()) {
            return Mage::helper('widgetcontacts')
                ->__("Edit Address '%s'", $this
                    ->escapeHtml(Mage::registry('widgetcontacts_block')
                        ->getName()));
        } else {
            return Mage::helper('widgetcontacts')->__('New Address');
        }
    }
}
