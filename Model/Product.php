<?php

class Products
{
    private $id;
    private $name;
    private $description;
    private $price;

    public function __construct(string $name, string $id, string $description, string $price)
    {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }


}