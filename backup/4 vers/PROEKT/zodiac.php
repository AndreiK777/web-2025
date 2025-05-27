<?php

$date = $_POST['date'];

function outputZodiac(string $date): string {

    $day = (int)($date[0] . $date[1]);   // Первые два символа (день)
    $month = (int)($date[3] . $date[4]); // Символы с 3 по 4 (месяц)

    if ($day < 1 || $day > 31 || $month < 1 || $month > 12) {
        return "Неверная дата";
    }

    if (($month === 3 && $day >= 21) || ($month === 4 && $day <= 19)) {
        return "Овен";
    }   elseif (($month === 4 && $day >= 20 && $day <= 30) || ($month === 5 && $day <= 20)) {
        return "Телец";
    }   elseif (($month === 5 && $day >= 21) || ($month === 6 && $day <= 21)) {
        return "Близнецы";
    }   elseif (($month === 6 && $day >= 22 && $day <= 30) || ($month === 7 && $day <= 22)) {
        return "Рак";
    }   elseif (($month === 7 && $day >= 23) || ($month === 8 && $day <= 22)) {
        return "Лев";
    }   elseif (($month === 8 && $day >= 23) || ($month === 9 && $day <= 22)) {
        return "Дева";
    }   elseif (($month === 9 && $day >= 23 && $day <= 30) || ($month === 10 && $day <= 23)) {
        return "Весы";
    }   elseif (($month === 10 && $day >= 24) || ($month === 11 && $day <= 22)) {
        return "Скорпион";
    }   elseif (($month === 11 && $day >= 23 && $day <= 30) || ($month === 12 && $day <= 21)) {
        return "Стрелец";
    }   elseif (($month === 12 && $day >= 22) || ($month === 1 && $day <= 19)) {
        return "Козерог";
    }   elseif (($month === 1 && $day >= 20) || ($month === 2 && $day <= 18)) {
        return "Водолей";
    }   elseif ($month === 2 && $day >= 19 && $day <= 29 || ($month === 3 && $day <= 20)) {
        return "Рыбы";
    }   else {
        return "Неверная дата";
    }
}

$result = outputZodiac($date);

echo $result;
?>