<?php

namespace OzonRocketSDK\Client;

class Map
{
    /**
     * @var string = API or TEST
     */
    private $mode;

    /**
     * Адрес сервиса интеграции боевой.
     * @var string
     */
    private string $apiURL = 'https://xapi.ozon.ru/principal-integration-api/v1';

    /**
     * Адрес сервиса интеграции для тестов.
     * @var string
     */
    private string $testURL = 'https://api-stg.ozonru.me/principal-integration-api/v1';


    /**
     * @param string $mode = API | TEST
     */
    public function __construct(string $mode = 'API')
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @param string|null $method if method not null return url this method
     * @param bool $getREQUEST_TYPE if true return REQUEST_TYPE in array
     * @return array|string|string[]
         * /  not arguments return array all -> example [['URL' => '...', 'REQUEST_TYPE' => '...'], [...], [...]]
         * /  received $method return string url
         * /  received $method && $getREQUEST_TYPE return ['URL' => '..', 'REQUEST_TYPE' => '...']
     */
    public function getMap(?string $method = null, bool $getREQUEST_TYPE = false)
    {
        $api = $this->apiURL;
        $test = $this->testURL;

        $arMap = [
            'tokenGenerate' => [
                'API' => 'https://xapi.ozon.ru/principal-auth-api/connect/token',
                'TEST' => 'https://api-stg.ozonru.me/principal-auth-api/connect/token',
                'REQUEST_TYPE' => 'FORM'
            ],

            # Delivery
            'deliveryVariants' => [
                'API' => $api.'/delivery/variants',
                'TEST' => $test.'/delivery/variants',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCities' => [
                'API' => $api.'/delivery/cities/extended',
                'TEST' => $test.'/delivery/cities/extended',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCitiesExtended' => [
                'API' => $api.'/delivery/cities',
                'TEST' => $test.'/delivery/cities',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCalculate' => [
                'API' => $api.'/delivery/calculate',
                'TEST' => $test.'/delivery/calculate',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCalculateMaterialWeight' => [
                'API' => $api.'/delivery/calculate/materialWeight',
                'TEST' => $test.'/delivery/calculate/materialWeight',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryCalculatePost' => [
                'API' => $api.'/delivery/calculate',
                'TEST' => $test.'/delivery/calculate',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryCalculateInformation' => [/**/
                'API' => $api.'/delivery/calculate/information',
                'TEST' => $test.'/delivery/calculate/information',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryFromPlaces' => [
                'API' => $api.'/delivery/from_places',
                'TEST' => $test.'/delivery/from_places',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryReturnPlaces' => [
                'API' => $api.'/delivery/return_places',
                'TEST' => $test.'/delivery/return_places',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryVariantsByAddress' => [
                'API' => $api.'/delivery/variants/byaddress',
                'TEST' => $test.'/delivery/variants/byaddress',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByAddressShort' => [
                'API' => $api.'/delivery/variants/byaddress/short',
                'TEST' => $test.'/delivery/variants/byaddress/short',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByViewport' => [
                'API' => $api.'/delivery/variants/byviewport',
                'TEST' => $test.'/delivery/variants/byviewport',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByIds' => [
                'API' => $api.'/delivery/variants/byids',
                'TEST' => $test.'/delivery/variants/byids',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryTime' => [
                'API' => $api.'/delivery/time',
                'TEST' => $test.'/delivery/time',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryPickupPlaces' => [
                'API' => $api.'/delivery/pickup_places',
                'TEST' => $test.'/delivery/pickup_places',
                'REQUEST_TYPE' => 'GET',
            ],

            # Document
            'documentList' => [//deprecated
                'API' => $api.'/document/list',
                'TEST' => $test.'/document/list',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentReturnDocuments' => [
                'API' => $api.'/document/return_documents',
                'TEST' => $test.'/document/return_documents',
                'REQUEST_TYPE' => 'GET',
            ],
            'document' => [//deprecated
                'API' => $api.'/document',
                'TEST' => $test.'/document',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentImage' => [
                'API' => $api.'/document/image',
                'TEST' => $test.'/document/image',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentCreate' => [//deprecated
                'API' => $api.'/document/create',
                'TEST' => $test.'/document/create',
                'REQUEST_TYPE' => 'POST',
            ],
            'documentBinary' => [
                'API' => $api.'/document/binary',
                'TEST' => $test.'/document/binary',
                'REQUEST_TYPE' => 'GET',
            ],

            # DraftOrder
            'draftOrder' => [
                'API' => $api.'/draftOrder',
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],
            'draftOrderAddress' => [
                'API' => $api.'/draftOrder', //{logisticOrderNumber}/address <-added in method class
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],
            'draftOrderDeliveryVariant' => [
                'API' => $api.'/draftOrder', //{logisticOrderNumber}/deliveryVariant <-added in method class
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],

            # Dropoff
            'dropoff' => [
                'API' => $api.'/dropoff',
                'TEST' => $test.'/dropoff',
                'REQUEST_TYPE' => 'POST',
            ],
            'dropoffAct' => [
                'API' => $api.'/dropoff', // /{id}/act <-added in method class
                'TEST' => $test.'/dropoff',
                'REQUEST_TYPE' => 'GET',
            ],
            'dropoffActs' => [
                'API' => $api.'/dropoff/acts',
                'TEST' => $test.'/dropoff/acts',
                'REQUEST_TYPE' => 'GET',
            ],

            # Manifest
            'manifestUpload' => [
                'API' => $api.'/manifest/upload',
                'TEST' => $test.'/manifest/upload',
                'REQUEST_TYPE' => 'POST',
            ],
            'manifestUnprocessed' => [
                'API' => $api.'/manifest/unprocessed',
                'TEST' => $test.'/manifest/unprocessed',
                'REQUEST_TYPE' => 'GET',
            ],
            'manifestRemove' => [
                'API' => $api.'/manifest/remove',
                'TEST' => $test.'/manifest/remove',
                'REQUEST_TYPE' => 'POST',
            ],

            # Order
            'order' => [
                'API' => $api.'/order',
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderReturn' => [
                'API' => $api.'/order/return',
                'TEST' => $test.'/order/return',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderById' => [
                'API' => $api.'/order',
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'GET',
            ],
            'orderImport' => [
                'API' => $api.'/order/import',
                'TEST' => $test.'/order/import',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderStatusCanceled' => [
                'API' => $api.'/order/status/canceled',
                'TEST' => $test.'/order/status/canceled',
                'REQUEST_TYPE' => 'PUT',
            ],
            'orderCancellationReasons' => [
                'API' => $api.'/order/cancellationReasons',
                'TEST' => $test.'/order/cancellationReasons',
                'REQUEST_TYPE' => 'GET',
            ],
            'orderConvert' => [/**/
                'API' => $api.'/order', // /{draftLogisticOrderNumber}/convert <-added in method class
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'POST',
            ],

            # Posting
            'postingTicket' => [
                'API' => $api.'/posting/ticket',
                'TEST' => $test.'/posting/ticket',
                'REQUEST_TYPE' => 'GET',
            ],

            # Report
            'reportList' => [
                'API' => $api.'/report/list',
                'TEST' => $test.'/report/list',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportBinary' => [
                'API' => $api.'/report/binary',
                'TEST' => $test.'/report/binary',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportSentToDeliverySubscribe' => [
                'API' => $api.'/report/sent_to_delivery/subscribe',
                'TEST' => $test.'/report/sent_to_delivery/subscribe',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportSentToDeliveryUnsubscribe' => [/*/v1/report/sent_to_delivery/unsubscribe*/
                'API' => $api.'/report/sent_to_delivery/unsubscribe',
                'TEST' => $test.'/report/sent_to_delivery/unsubscribe',
                'REQUEST_TYPE' => 'GET',
            ],

            # Shipment
            'shipmentRequest' => [
                'API' => $api.'/shipmentRequest',
                'TEST' => $test.'/shipmentRequest',
                'REQUEST_TYPE' => 'POST',
            ],
            'shipmentRequestAct' => [
                'API' => $api.'/shipmentRequest', // /{id}/act <-added in method class
                'TEST' => $test.'/shipmentRequest',
                'REQUEST_TYPE' => 'GET',
            ],
            'shipmentRequestActs' => [
                'API' => $api.'/shipmentRequest/acts',
                'TEST' => $test.'/shipmentRequest/acts',
                'REQUEST_TYPE' => 'GET',
            ],

            # Tariff
            'tariffList' => [
                'API' => $api.'/tariff/list',
                'TEST' => $test.'/tariff/list',
                'REQUEST_TYPE' => 'GET',
            ],

            # Ticket
            'ticket' => [
                'API' => $api.'/ticket',
                'TEST' => $test.'/ticket',
                'REQUEST_TYPE' => 'GET',
            ],

            # Tracking
            'trackingByPostingNumber' => [
                'API' => $api.'/tracking/bypostingnumber',
                'TEST' => $test.'/tracking/bypostingnumber',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingByBarcode' => [
                'API' => $api.'/tracking/bybarcode',
                'TEST' => $test.'/tracking/bybarcode',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingList' => [
                'API' => $api.'/tracking/list',
                'TEST' => $test.'/tracking/list',
                'REQUEST_TYPE' => 'POST',
            ],
            'trackingByOrderNumber' => [
                'API' => $api.'/tracking/byordernumber',
                'TEST' => $test.'/tracking/byordernumber',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingPosting' => [/*deprecated*/
                'API' => $api.'/tracking/posting',
                'TEST' => $test.'/tracking/posting',
                'REQUEST_TYPE' => 'GET',
            ],

            # Other
            'pickupExtendedInfo' => [
                'API' => 'https://api.ozon.ru/delivery-params-api/v1/delivery/methods/pickup/extended-info',
                'TEST' => 'https://api-stg.ozonru.me/delivery-params-api/v1/delivery/methods/pickup/extended-info',
                'REQUEST_TYPE' => 'GET',
            ],
        ];

        // method not null
        if ($method) {
            if (isset($arMap[$method])) {
                return $getREQUEST_TYPE ? [
                    'URL' => $arMap[$method][$this->mode],
                    'REQUEST_TYPE' => $arMap[$method]['REQUEST_TYPE']
                ] : $arMap[$method][$this->mode];
            } else return false;
        }


        $arReturn = [];
        foreach($arMap as $method => $arData)
        {
            $url = $arData[$this->mode];

            $arReturn[$method] = $getREQUEST_TYPE ?  [
                    'URL' => $url,
                    'REQUEST_TYPE' => $arData['REQUEST_TYPE']
                ] : $url;
        }
        return $arReturn;
    }


    /**
     * Возвращает адрес сервиса интеграции
     * @return string
     */
    public function getBaseURL(): string
    {
        return $this->mode == 'TEST' ? $this->testURL : $this->apiURL;
    }
}