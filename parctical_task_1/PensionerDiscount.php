<?php
namespace TutuTasks;

class PensionerDiscount implements DiscountInterface
{
    const PENSION_AGE = 65;

    private $_cart;
    private $_percentage;

    public function __construct(Cart $cart, $percentage)
    {
        $this->_cart = $cart;
        $this->_percentage = $percentage;
    }

    private function _isPensioner()
    {
        return $this->_cart->getUser()->getAge() >= self::PENSION_AGE;
    }

    public function getDiscount()
    {
        if($this->_isPensioner()){
            return $this->_cart->getTotalAmount() * $this->_percentage;
        }
        return 0;
    }
}