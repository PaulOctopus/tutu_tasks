<?php
namespace TutuTasks;

include 'Stone.php';
include 'StoneBag.php';

$bag = new StoneBag([
    new Stone( 5, 6 ),
    new Stone( 1.6,  0.5 )
], 37);

echo ' Максимальная прибыль: '.$bag->getMaxProfit();
$maxNum = 1;
echo ' Максимальная прибыль в случае использования каждого камня не более '.$maxNum.' раз: '.$bag->getMaxProfit($maxNum);