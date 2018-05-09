<?php
namespace TutuTasks;

class Stone
{
    public $weight;
    public $price;
    private $_specificPrice;

    public function __construct(float $weight, float $price)
    {
        if($weight < 0){
            throw new \Exception('Вес камня должен быть положительным');
        }
        if($price <= 0){
            throw new \Exception('Цена камня должна быть неотрицательной');
        }
        $this->price = $price;
        $this->weight = $weight;
        $this->_specificPrice =  $this->price / $this->weight;
    }

    public function getSpecificPrice()
    {
        return $this->_specificPrice;
    }
}