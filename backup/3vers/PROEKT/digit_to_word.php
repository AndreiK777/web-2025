<?php

$digit = $_POST['digit'];

function outputDigit(int $digit): string {
    if ($digit < 0 || $digit > 9) {
        return "Неверная цифра! Введите цифру от 0 до 9";
    }

    $words = [
        0 => 'Ноль',
        1 => 'Один',
        2 => 'Два',
        3 => 'Три',
        4 => 'Четыре',
        5 => 'Пять',
        6 => 'Шесть',
        7 => 'Семь',
        8 => 'Восемь',
        9 => 'Девять',
    ];

    return $words[$digit];
}

$result = outputDigit($digit);

echo $result;
?>