<?php
namespace TutuTasks;

//... include all classes


//sample:
$user = new User();
$cart = new Cart( $user );

$cart->addItem([
    'price' => 5000
]);
$cart->addItem([
    'price' => 7000
]);

$cart->addDiscount(
    new PensionerDiscount($cart, '0.05')
);
$cart->addDiscount(
    new FirstOrderDiscount($cart, 100)
);
$cart->addDiscount(
    new AmountOrderDiscount($cart, 10000, 500)
);

$final = $cart->getDiscountedTotalAmount();