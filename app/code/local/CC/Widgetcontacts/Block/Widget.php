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

            $address = $companyAddressCountry.", ".$companyAddressCity.", ".$companyAddressStreet." ".$companyAddressBuild;

            $html = '<div><ul><li>'.$companyName.'</li><li>'.$address.'</li><li>'.$companyPhone.'</li></ul></div>';

            return $html;
        }
    }
