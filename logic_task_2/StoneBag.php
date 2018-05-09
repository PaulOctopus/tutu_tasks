<?php
namespace TutuTasks;

class StoneBag
{
    /**@var Stone[] */
    private $_stones;
    private $_maxWeight;

    public function __construct(array $stones, $maxWeight)
    {
        $this->_stones = $stones;
        if($maxWeight<0){
            throw new \Exception('Максимальный вес должен быть положительным');
        }
        $this->_maxWeight = floatval($maxWeight);
    }

    private function _getStonesOrderedBySpecificPrice()
    {
        $stones = $this->_stones;
        uasort($stones, function($a, $b){
            /**@var Stone $a*/
            /**@var Stone $b*/
            return $b->getSpecificPrice() - $a->getSpecificPrice();
        });
        return $stones;
    }

    public function getMaxProfit( $maxStoneUsage = false )
    {
        $stones = $this->_getStonesOrderedBySpecificPrice();
        $amounts = [];
        $profit = 0;
        $weightLeft = $this->_maxWeight;
        foreach( $stones as $index => $stone ){
            if($weightLeft <= 0){
                break;
            }
            $number = intval($weightLeft / $stone->weight );
            if($maxStoneUsage && $number > $maxStoneUsage){
                $number = $maxStoneUsage;
            }
            $amounts[$index] = $number;
            $profit += $number * $stone->price;
            $weightLeft -= $number * $stone->weight;
        }
        return $profit;
    }
}