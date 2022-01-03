<?php

// Задание 1


function bubbleSort($array)
{
    for ($i = 0; $i < count($array); $i++) {
        $count = count($array);
        for ($j = $i + 1; $j < $count; $j++) {
            if ($array[$i] > $array[$j]) {
                $temp = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $temp;
            }
        }
    }
    return $array;
}

function shakerSort($array)
{
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
            }
        }
        $right -= 1;
        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
                list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
            }
        }
        $left += 1;
    } while ($left <= $right);
    return $array;
}

function quickSort(&$arr, $low, $high)
{
    $i = $low;
    $j = $high;
    $middle = $arr[($low + $high) / 2];
    do {
        while ($arr[$i] < $middle) ++$i;
        while ($arr[$j] > $middle) --$j;
        if ($i <= $j) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;
            $i++;
            $j--;
        }
    } while ($i < $j);

    if ($low < $j) {
        quickSort($arr, $low, $j);
    }

    if ($i < $high) {
        quickSort($arr, $i, $high);
    }
    return $arr;
}


function heapify(&$arr, $countArr, $i)
{
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    if ($left < $countArr && $arr[$left] > $arr[$largest])
        $largest = $left;

    if ($right < $countArr && $arr[$right] > $arr[$largest])
        $largest = $right;


    if ($largest != $i) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $swap;


        heapify($arr, $countArr, $largest);
    }
}

function heapSort(&$arr)
{
    $countArr = count($arr);

    for ($i = $countArr / 2 - 1; $i >= 0; $i--)
        heapify($arr, $countArr, $i);


    for ($i = $countArr - 1; $i >= 0; $i--) {
        // Перемещаем текущий корень в конец
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;

        heapify($arr, $i, 0);
    }
    return $arr;
}


$arr = [];
for ($i = 0; $i < 10; $i++) {
    $arr[] = random_int(0, 10);
}
var_dump($arr);

$start_time1 = microtime(true);
$sor1 = bubbleSort($arr);
$send_time1 = microtime(true);
var_dump($sor1);
echo "Time = " . ($send_time1 - $start_time1) . PHP_EOL;


$start_time2 = microtime(true);
$sor2 = shakerSort($arr);
$send_time2 = microtime(true);
var_dump($sor2);
echo "Time = " . ($send_time2 - $start_time2) . PHP_EOL;


$start_time3 = microtime(true);
$sor3 = quickSort($arr, 0, count($arr) - 1);
$send_time3 = microtime(true);
var_dump($sor3);
echo "Time = " . ($send_time3 - $start_time3) . PHP_EOL;


$start_time4 = microtime(true);
$sor4 = heapSort($arr);
$send_time4 = microtime(true);
var_dump($sor4);
echo "Time = " . ($send_time4 - $start_time4) . PHP_EOL;


// Задание 2, 3


function LinearSearch($arr, $num)
{
    $count = 0;
    for ($i = 0; $i < count($arr) - 1; $i++) {
        if ($arr[$i] == $num) unset($arr[$i]);
        $count++;
    }
    var_dump($count).PHP_EOL;
    return $arr;
}


var_dump(LinearSearch($arr, 7));

function binarySearch($myArray, $num)
{
    $count = 0;
    $left = 0;
    $right = count($myArray) - 1;

    while ($left <= $right) {

        $middle = floor(($right + $left) / 2);
        if ($myArray[$middle] == $num) {
            unset($myArray[$middle]);
            $left = $middle + 1;
            $count++;
        } elseif ($myArray[$middle] > $num) {
            $right = $middle - 1;
            $count++;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
            $count++;
        }
    }
    var_dump($count).PHP_EOL;
    return $myArray;
}

var_dump(binarySearch(bubbleSort($arr), 7));


function InterpolationSearch($myArray, $num)
{
    $count = 0;
    $start = 0;
    $last = count($myArray) - 1;

    while (($start <= $last) && ($num >= $myArray[$start])
        && ($num <= $myArray[$last])) {

        $pos = floor($start + (
                (($last - $start) / ($myArray[$last] - $myArray[$start]))
                * ($num - $myArray[$start])
            ));
        if ($myArray[$pos] == $num) {
            unset($myArray[$pos]);
            $start = $pos + 1;
            $count++;
        } elseif ($myArray[$pos] < $num) {
            $start = $pos + 1;
            $count++;
        } else {
            $last = $pos - 1;
            $count++;
        }
    }
    var_dump($count).PHP_EOL;
    return $myArray;
}

var_dump(InterpolationSearch(bubbleSort($arr), 7));
