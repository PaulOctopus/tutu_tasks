<?php
namespace TutuTasks;

class Cart
{
    private $_user;
    private $_items = [];
    /**@var DiscountInterface[]*/
    private $_discounts = [];

    public function __construct(?User $user)
    {
        $this->_user = $user;
    }

    public function getUser(): ?User
    {
        return $this->_user;
    }

    // item_id, price, sku, etc.
    public function addItem(array $item): void
    {
        $this->_items[] = $item;
    }

    public function addDiscount(DiscountInterface $discount): void
    {
        $this->_discounts[] = $discount;
    }

    public function getTotalAmount(): int
    {
        $ret = 0;
        foreach ($this->_items as $item)
            $ret += $item['price'];
        return $ret;
    }

    public function getDiscountedTotalAmount(): int
    {
        $amount = $this->getTotalAmount() - $this->_getDiscount();
        return $amount > 0 ? $amount : 0;
    }

    private function _getDiscount(): float
    {
        $discount = 0;
        foreach($this->_discounts as $discount){
            $discount+= $discount->getDiscount();
        }
        return $discount;
    }
}