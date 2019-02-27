<?php

class CC_Widgetcontacts_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return array
     */
    public function getGeoData() {

        $companyAddressCountry = Mage::getStoreConfig('widgetcontacts/global/company_address_country');
        $companyAddressCity = Mage::getStoreConfig('widgetcontacts/global/company_address_city');
        $companyAddressStreet = Mage::getStoreConfig('widgetcontacts/global/company_address_street');
        $companyAddressBuild = Mage::getStoreConfig('widgetcontacts/global/company_address_build');
        $address = $companyAddressCountry.", ".$companyAddressCity.", ".$companyAddressStreet." ".$companyAddressBuild;

        $params = array(
            'geocode' => $address,
            'format'  => 'json',
            'results' => 1
        );
        $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));

        if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
        {
            $data = $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
            return $geoData = explode(' ', $data);
        }
        return $geoData = [];
    }

}
