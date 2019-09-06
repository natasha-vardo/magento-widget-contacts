<?php

class CC_Widgetcontacts_Block_Widget
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    /**
     * @return string
     */
    protected function _toHtml(): string
    {
        return Mage::getSingleton('core/layout')
            ->createBlock('core/template')
            ->setTemplate('cc/contacts-map.phtml')
            ->toHtml();
    }
}
