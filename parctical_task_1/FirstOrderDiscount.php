<?php
namespace TutuTasks;

class FirstOrderDiscount implements DiscountInterface
{
    private $_discount;
    private $_cart;

    public function __construct(Cart $cart, $discount)
    {
        $this->_cart = $cart;
        $this->_discount = $discount;
    }

    public function getDiscount()
    {
        if($this->_cart->getUser()->getOrderNumber() == 0){
            return $this->_discount;
        }
        return 0;
    }
}