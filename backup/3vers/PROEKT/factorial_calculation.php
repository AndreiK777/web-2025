<?php

$digit= $_POST['digit'];

function factorial(int $n): int {
    if ($n === 0 || $n === 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

$result = factorial($digit);

echo "Факториал числа $digit равен $result.";

?>
