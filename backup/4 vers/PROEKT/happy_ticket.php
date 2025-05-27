<?php

$ticket1 = $_POST['ticket1'];
$ticket2 = $_POST['ticket2'];

function checkLength(string $ticket): bool {
    $length = 0;
    for ($i = 0; isset($ticket[$i]); $i++) {
        $length++;
    }
    return $length === 6;
}

function isItLucky(string $ticket): bool {
    $firsthalfsum = (int)$ticket[0] + (int)$ticket[1] + (int)$ticket[2];
    $secondhalfsum = (int)$ticket[3] + (int)$ticket[4] + (int)$ticket[5];
    return $firsthalfsum === $secondhalfsum;
}

if (!checkLength($ticket1) || !checkLength($ticket2) ) {
    echo "Ошибка: оба билета должны быть длиной 6 символов.";
}

$start = (int)$ticket1;
$end = (int)$ticket2;

for ($i = $start; $i <= $end; $i++) {
    $ticket = $i;
    if (isItLucky($ticket)) {
        echo $ticket . "<br>";
    }
}

?>