<?php

class CC_Widgetcontacts_Block_Adminhtml_Widgetcontacts extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_widgetcontacts';
        $this->_blockGroup = 'widgetcontacts';
        $this->_headerText = Mage::helper('widgetcontacts')->__('Company Contacts');
        $this->_addButtonLabel = Mage::helper('widgetcontacts')->__('Add New Address');
        parent::__construct();
    }
}
