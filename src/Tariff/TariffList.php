<?php

namespace OzonRocketSDK\Tariff;

class TariffList
{

    /**
     * integer <int64>
     * Идентификатор тарифа.
     * @var int
     */
    private int $id;

    /**
     * string Nullable
     * Наименование тарифа
     * @var string
     */
    private string $tariffName;

    /**
     * string Nullable
     * Наименование тарифной зоны.
     * @var string
     */
    private string $tariffZoneName;

    /**
     * integer <int64>
     * Идентификатор способа доставки.
     * @var string
     */
    private string $deliveryVariantId;

    /**
     * string Nullable
     * Наименование способа доставки.
     * @var string
     */
    private string $deliveryVariantName;

    /**
    * string Nullable
    * Тип способа доставки:
        К — курьерская доставка,
        С — самовывоз,
        П — постамат.
     * @var string
     */
    private string $deliveryVariantType;

    /**
     * integer <int64>
     * Идентификатор типа тарифа.
     * @var string
     */
    private string $tariffRateTypeId;

    /**
     * Наименование типа тарифа.
     * @var string
     */
    private string $tariffRateTypeName;

    /**
     * Идентификатор склада места передачи отправлений.
     * @var string
     */
    private string $placeId;

    /**
     * Наименование склада места передачи отправлений.
     * @var string
     */
    private string $placeName;

    /**
     * Базовый тариф.
     * @var float
     */
    private float $baseAmount;

    /**
     * Лимит базового тарифа в граммах.
     * @var int
     */
    private int $limit;

    /**
     * Доплата за превышение лимита. Шаг — 1000 грамм
     * @var float
     */
    private float $overdraftAmount;


    public function __construct(?array $properties = null)
    {
        if ($properties != null) {
            foreach ($properties as $key => $value) {
                if (!property_exists($this, $key)) continue;

                if ($value) $this->{$key} = $value;
            }
        }
        return $this;
    }

    /**
     * Идентификатор тарифа.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Наименование тарифа.
     * @return string
     */
    public function getTariffName(): string
    {
        return $this->tariffName;
    }

    /**
     * Наименование тарифной зоны.
     * @return string
     */
    public function getTariffZoneName(): string
    {
        return $this->tariffZoneName;
    }

    /**
     * Идентификатор способа доставки.
     * @return string
     */
    public function getDeliveryVariantId(): string
    {
        return $this->deliveryVariantId;
    }

    /**
     * Наименование способа доставки.
     * @return string
     */
    public function getDeliveryVariantName(): string
    {
        return $this->deliveryVariantName;
    }

    /**
     * Тип способа доставки:
        К — курьерская доставка,
        С — самовывоз,
        П — постамат.
     * @return string
     */
    public function getDeliveryVariantType(): string
    {
        return $this->deliveryVariantType;
    }

    /**
     * Идентификатор типа тарифа.
     * @return string
     */
    public function getTariffRateTypeId(): string
    {
        return $this->tariffRateTypeId;
    }

    /**
     * Наименование типа тарифа.
     * @return string
     */
    public function getTariffRateTypeName(): string
    {
        return $this->tariffRateTypeName;
    }

    /**
     * Идентификатор склада места передачи отправлений.
     * @return string
     */
    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    /**
     * Наименование склада места передачи отправлений.
     * @return string
     */
    public function getPlaceName(): string
    {
        return $this->placeName;
    }

    /**
     * Базовый тариф.
     * @return float
     */
    public function getBaseAmount(): float
    {
        return $this->baseAmount;
    }

    /**
     * Лимит базового тарифа в граммах.
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Доплата за превышение лимита. Шаг — 1000 граммов.
     * @return float
     */
    public function getOverdraftAmount(): float
    {
        return $this->overdraftAmount;
    }
}