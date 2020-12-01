<?php
class customer
{
    private $customerID;
    private $customerName;

    public function __construct($customerID, $customerName)
    {
        $this->customerName = $customerName;
        $this->customerID = $customerID;
    }

    public function customerID()
    {
        return $this->customerID;
    }

    public function CustomerName()
    {
        return $this->customerName;
    }
}

