<?php

class CC_Widgetcontacts_Helper_Data extends Mage_Core_Helper_Abstract
{

    CONST URL = 'http://geocode-maps.yandex.ru/1.x/?';

    /**
     * @return array
     */
    public function getGeoData(): array
    {
        $adminData = Mage::getModel('widgetcontacts/block')->getCollection();
        $shopData = [];

        foreach($adminData as $data) {
            $address = sprintf(
                '%s, %s, %s %s',
                $data->getCountry(),
                $data->getCity(),
                $data->getStreet(),
                $data->getBuild()
            );
            $shopData[] = [
                'title' => sprintf(
                    '%s <br/> %s <br/> %s',
                    $data->getName(),
                    $address,
                    $data->getPhone()
                ),
                'address' => $address
            ];
        }

        $geoDataArray = [];

        foreach($shopData as $data) {
            $params = [
                'geocode' => $data['address'],
                'format'  => 'json',
                'results' => 1
            ];

            $urlResponse = http_build_query($params, '', '&');
            $response = file_get_contents(SELF::URL . $urlResponse);
            $responseDecode = json_decode($response);

            $GeoObjectCollection = $responseDecode->response->GeoObjectCollection;
            $isFoundGeoData = $GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found;

            if ($isFoundGeoData > 0) {
                $pointPosition = $GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
                $geoData = explode(' ', $pointPosition);
                $geoDataArray[] = [
                    'title' => $data['title'],
                    'coordinates' => $geoData
                ];
            }
        }

        return $geoDataArray;
    }
}
