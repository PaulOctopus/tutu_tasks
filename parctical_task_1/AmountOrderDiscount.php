<?php
namespace TutuTasks;

class AmountOrderDiscount implements DiscountInterface
{
    private $_limit;
    private $_discount;
    private $_cart;

    public function __construct(Cart $cart, $limit, $discount)
    {
        $this->_cart = $cart;
        $this->_limit = $limit;
        $this->_discount = $discount;
    }

    public function getDiscount()
    {
        if($this->_cart->getTotalAmount() >= $this->_limit){
            return $this->_discount;
        }
        return 0;
    }
}
