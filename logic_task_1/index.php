<?php
namespace TutuTasks;

function distributeSmoothies(int $m, int $n) : int
{
    return $n <= 0 || $m < 0 ? 0 : intdiv ($m, $n);
}

