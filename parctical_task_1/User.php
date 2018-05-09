<?php
namespace TutuTasks;

class User
{
    public function getAge(): int {
        return mt_rand(15, 80);
    }

    public function getOrderNumber()
    {
        // выводит количество завершенных покупок
        return 0;
    }
}