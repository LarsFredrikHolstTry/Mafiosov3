<?php

include '../../functions/numbers.php';

$item = removeSpace($_POST['value']);

if (!is_numeric($item)) {
    echo 'Ugyldig input. Kun tall er tillatt. ' . '<|>' . 'danger';
} elseif ($item && is_numeric($item) && $item <= 100000) {
    echo 'Du satt inn ' . number($item) . ' kr' . '<|>' . 'success';
} elseif ($item > 100000) {
    echo 'Du har ikke nok penger på hånden! ' . '<|>' . 'danger';
}
