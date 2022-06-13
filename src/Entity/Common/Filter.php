<?php

namespace OzonRocketSDK\Entity\Common;

use OzonRocketSDK\Entity\AbstractEntity;

class Filter extends AbstractEntity
{
    protected bool $isCashAvailable;
    protected bool $isPaymentCardAvailable;
    protected bool $isAnyPaymentAvailable;

    /**
     * @param bool $isCashAvailable Возможность принимать платёж наличными: true — есть такая возможность; | false — нет.
     * @param bool $isPaymentCardAvailable Возможность принимать платёж банковской картой: true — есть такая возможность; | false — нет.
     * @param bool $isAnyPaymentAvailable Возможность принимать платёж: true — есть такая возможность; | false — нет.
     */
    public function __construct(bool $isCashAvailable, bool $isPaymentCardAvailable, bool $isAnyPaymentAvailable)
    {
        $this->isCashAvailable = $isCashAvailable;
        $this->isPaymentCardAvailable = $isPaymentCardAvailable;
        $this->isAnyPaymentAvailable = $isAnyPaymentAvailable;
    }

    /**
     * Возможность принимать платёж наличными: true — есть такая возможность; | false — нет.
     * @return bool
     */
    public function isCashAvailable(): bool
    {
        return $this->isCashAvailable;
    }

    /**
     * Возможность принимать платёж наличными: true — есть такая возможность; | false — нет.
     * @param bool $isCashAvailable
     * @return Filter
     */
    public function setIsCashAvailable(bool $isCashAvailable): Filter
    {
        $this->isCashAvailable = $isCashAvailable;
        return $this;
    }

    /**
     * Возможность принимать платёж банковской картой: true — есть такая возможность; | false — нет.
     * @return bool
     */
    public function isPaymentCardAvailable(): bool
    {
        return $this->isPaymentCardAvailable;
    }

    /**
     * Возможность принимать платёж банковской картой: true — есть такая возможность; | false — нет.
     * @param bool $isPaymentCardAvailable
     * @return Filter
     */
    public function setIsPaymentCardAvailable(bool $isPaymentCardAvailable): Filter
    {
        $this->isPaymentCardAvailable = $isPaymentCardAvailable;
        return $this;
    }

    /**
     * Возможность принимать платёж: true — есть такая возможность; | false — нет.
     * @return bool
     */
    public function isAnyPaymentAvailable(): bool
    {
        return $this->isAnyPaymentAvailable;
    }

    /**
     * Возможность принимать платёж: true — есть такая возможность; | false — нет.
     * @param bool $isAnyPaymentAvailable
     * @return Filter
     */
    public function setIsAnyPaymentAvailable(bool $isAnyPaymentAvailable): Filter
    {
        $this->isAnyPaymentAvailable = $isAnyPaymentAvailable;
        return $this;
    }

}