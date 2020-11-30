<?php
class customer
{
    private $id;
    private $customerName;

    public function __construct($id, $customerName)
    {
        $this->customerName = $customerName;
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function CustomerName()
    {
        return $this->customerName;
    }
}

