<?php

namespace OzonRocketSDK\Entity\Request;

class DeliveryCalculateInformation extends AbstractRequest
{
    /**
     * @var int Идентификатор места отправления.
     */
    protected int $fromPlaceId;
    /**
     * @var string Адрес доставки.
     */
    protected string $destinationAddress;
    /**
     * Массив информации по отправлениям.
     * @var \OzonRocketSDK\Entity\Common\Package[]
     */
    protected array $packages;

    /**
     * @param int $fromPlaceId Идентификатор места отправления.
     * @param string $destinationAddress Адрес доставки.
     * @param \OzonRocketSDK\Entity\Common\Package[] $packages Массив информации по отправлениям.
     */
    public function __construct(int $fromPlaceId, string $destinationAddress, array $packages)
    {
        $this->fromPlaceId = $fromPlaceId;
        $this->destinationAddress = $destinationAddress;
        $this->packages = $packages;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): int
    {
        return $this->fromPlaceId;
    }

    /**
     * @param int $fromPlaceId
     * @return DeliveryCalculateInformation
     */
    public function setFromPlaceId(int $fromPlaceId): DeliveryCalculateInformation
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationAddress(): string
    {
        return $this->destinationAddress;
    }

    /**
     * @param string $destinationAddress
     * @return DeliveryCalculateInformation
     */
    public function setDestinationAddress(string $destinationAddress): DeliveryCalculateInformation
    {
        $this->destinationAddress = $destinationAddress;
        return $this;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\Package[]
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * @param \OzonRocketSDK\Entity\Common\Package[] $packages
     * @return DeliveryCalculateInformation
     */
    public function setPackages(array $packages): DeliveryCalculateInformation
    {
        $this->packages = $packages;
        return $this;
    }

}