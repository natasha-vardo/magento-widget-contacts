<?php

class CC_Widgetcontacts_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    /**
     * @return string
     */
    protected function _toHtml(): string
    {
        $companyName = Mage::getStoreConfig('widgetcontacts/global/company_name');
        $companyPhone = Mage::getStoreConfig('widgetcontacts/global/company_phone');

        $companyAddressCountry = Mage::getStoreConfig('widgetcontacts/global/company_address_country');
        $companyAddressCity = Mage::getStoreConfig('widgetcontacts/global/company_address_city');
        $companyAddressStreet = Mage::getStoreConfig('widgetcontacts/global/company_address_street');
        $companyAddressBuild = Mage::getStoreConfig('widgetcontacts/global/company_address_build');
        $address = sprintf('%s, %s, %s %s', $companyAddressCountry, $companyAddressCity, $companyAddressStreet, $companyAddressBuild);

        $html = sprintf('%s <br/> %s <br/> %s', $companyName, $address, $companyPhone);

        return $html;
    }
}
