<?php

class CC_Widgetcontacts_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return array
     */
    public function getGeoData()
    {
        $companyAddressCountry = Mage::getStoreConfig('widgetcontacts/global/company_address_country');
        $companyAddressCity = Mage::getStoreConfig('widgetcontacts/global/company_address_city');
        $companyAddressStreet = Mage::getStoreConfig('widgetcontacts/global/company_address_street');
        $companyAddressBuild = Mage::getStoreConfig('widgetcontacts/global/company_address_build');
        $address = sprintf('%s, %s, %s %s', $companyAddressCountry, $companyAddressCity, $companyAddressStreet, $companyAddressBuild);

        $params = [
            'geocode' => $address,
            'format'  => 'json',
            'results' => 1
        ];

        $url = 'http://geocode-maps.yandex.ru/1.x/?';
        $urlResponse = http_build_query($params, '', '&');
        $response = file_get_contents($url . $urlResponse);
        $responseDecode = json_decode($response);

        if ($responseDecode->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
        {
            $data = $responseDecode->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
            return $geoData = explode(' ', $data);
        }

        return $geoData = [];
    }
}
