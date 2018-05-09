<?php
namespace TutuTasks;

function removeExcessiveBracket(string $str)
{
    return preg_replace(
        '!([\)\(\{\}\]\[])+!',
        '$1',
        $str
    );
}

$str = 'Я тебе прислал картинку :-))). Посмотри, очень смешно. Хотя и грустно :((((';
echo removeExcessiveBracket($str);