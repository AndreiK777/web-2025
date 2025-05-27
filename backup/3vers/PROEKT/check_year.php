<?php

$year = $_POST['year'];

function isLeapYear(int $year): bool {
    if ($year % 4 != 0) {
        return false; // не делится на 4, не вискоксный
    }   elseif ($year % 100 !== 0) {
        return true; // делится на 4 и не делится на 100, висококсный
    }   elseif ($year % 400 !== 0) {
        return false; // делится на 4 и делится на 100, но не делится на 400, не висококсный
    }   else {
        return true; // делится на 4, делится на 100 и делится на 400, висококсный
    }
}

if (isLeapYear($year)) {
    echo "YES";
}   else {
    echo "NO";
}

?>