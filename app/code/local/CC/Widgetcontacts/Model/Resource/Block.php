<?php

class CC_Widgetcontacts_Model_Resource_Block extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('widgetcontacts/block','contact_id');
    }
}
