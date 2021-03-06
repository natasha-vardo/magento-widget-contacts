<?php

class CC_Widgetcontacts_Block_Adminhtml_Widgetcontacts_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_form');
        $this->setTitle(Mage::helper('widgetcontacts')->__('Address Information'));
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
    protected function _prepareForm(): Mage_Adminhtml_Block_Widget_Form
    {
        $widgetcontactsModel = Mage::registry('widgetcontacts_block');
        $form = new Varien_Data_Form(
            [
                'id' => 'edit_form',
                'action' => $this->getUrl(
                    '*/*/save',
                    ['contact_id'=>$this->getRequest()->getParam('contact_id')]
                ),
                'method' => 'post'
            ]
        );

        $form->setHtmlIdPrefix('contact_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend'=>Mage::helper('widgetcontacts')->__('Address Information'),
                'class' => 'fieldset-wide']
        );

        if ($widgetcontactsModel->getBlockId()) {
            $fieldset->addField(
                'contact_id',
                'hidden',
                ['name' => 'contact_id',]
            );
        }

        $fieldset->addField('name', 'text', [
            'name'      => 'name',
            'label'     => Mage::helper('widgetcontacts')->__('Company Name'),
            'title'     => Mage::helper('widgetcontacts')->__('Company Name'),
            'required'  => true,
        ]);


        $fieldset->addField('country', 'text', [
            'name'      => 'country',
            'label'     => Mage::helper('widgetcontacts')->__('Country'),
            'title'     => Mage::helper('widgetcontacts')->__('Country'),
            'required'  => true,
        ]);


        $fieldset->addField('city', 'text', [
            'name'      => 'city',
            'label'     => Mage::helper('widgetcontacts')->__('City'),
            'title'     => Mage::helper('widgetcontacts')->__('City'),
            'required'  => true,
        ]);


        $fieldset->addField('street', 'text', [
            'name'      => 'street',
            'label'     => Mage::helper('widgetcontacts')->__('Street'),
            'title'     => Mage::helper('widgetcontacts')->__('Street'),
            'required'  => true,
        ]);


        $fieldset->addField('build', 'text', [
            'name'      => 'build',
            'label'     => Mage::helper('widgetcontacts')->__('Build'),
            'title'     => Mage::helper('widgetcontacts')->__('Build'),
            'required'  => true,
        ]);


        $fieldset->addField('phone', 'text', [
            'name'      => 'phone',
            'label'     => Mage::helper('widgetcontacts')->__('Company Phone Number'),
            'title'     => Mage::helper('widgetcontacts')->__('Company Phone Number'),
            'required'  => true,
        ]);

        $form->setValues($widgetcontactsModel->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
