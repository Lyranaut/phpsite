<?php
abstract class Carrier
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function calculateShippingCost($weight);
}

// Implementation of TransCompany carrier
class TransCompany extends Carrier
{
    public function calculateShippingCost($weight)
    {
        if ($weight <= 10) {
            return 20;
        } else {
            return 100;
        }
    }
}

// Implementation of PackGroup carrier
class PackGroup extends Carrier
{
    public function calculateShippingCost($weight)
    {
        return $weight;
    }
}

// Class responsible for calculating the shipping cost based on the carrier
class DeliveryCalculator
{
    private $carriers;

    public function __construct()
    {
        $this->carriers = [];
    }

    public function addCarrier(Carrier $carrier)
    {
        $this->carriers[] = $carrier;
    }

    public function calculatePrice($weight, $carrierSlug)
    {
        $carrier = $this->findCarrierBySlug($carrierSlug);

        if ($carrier) {
            return $carrier->calculateShippingCost($weight);
        }

        return null;
    }

    private function findCarrierBySlug($slug)
    {
        foreach ($this->carriers as $carrier) {
            if (strtolower($carrier->name) === strtolower($slug)) {
                return $carrier;
            }
        }

        return null;
    }
}