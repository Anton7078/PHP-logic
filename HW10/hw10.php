<?php

$str = '3*4-(8/4-1)';

function prior1Arr($str)
{
    $arr = str_split($str);
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == '(') {
            $start = $i;
        }
        if ($arr[$i] == ')') {
            $end = $i;
            $array = complete($arr, $start + 1, $end - 1);
            array_splice($arr, $start, $end - $start + 1, prior2Arr(str_split($array)));
            return prior1Arr(complete($arr, 0, count($arr) - 1));
        }
    }
    return prior2Arr($arr);
}

function prior2Arr($arr)
{
    for ($i = 0; $i < count($arr) - 1; $i++) {
        if ($arr[$i] == "*") {
            $index = $i;
            $arr = searchSigns($arr, $index);
            return prior2Arr($arr);

        }
        if ($arr[$i] == "/" || $arr[$i] == ":") {
            $index = $i;
            $arr = searchSigns($arr, $index);
            return prior2Arr($arr);
        }
    }
    return prior3Arr($arr);
}


function prior3Arr($arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == '+') {
            $index = $i;
            $arr = searchSigns($arr, $index);
            return prior3Arr($arr);
        }
        if ($arr[$i] == "-") {
            $index = $i;
            $arr = searchSigns($arr, $index);
            return prior3Arr($arr);
        }
    }
    return complete($arr, 0, count($arr) - 1);
}


function complete($arr, $i, $j)
{
    for ($k = $i; $k <= $j; $k++) {
        $resArr[] = $arr[$k];
    }
    return implode('', $resArr);
}

function searchSigns($arr, $index)
{
    $start = 0;
    $end = count($arr);
    for ($j = 0; $j < count($arr); $j++) {
        if (($arr[$j] == '+') || ($arr[$j] == '*') || ($arr[$j] == '/') || ($arr[$j] == '-')) {
            if ($j < $index) {
                $start = $j;
            }
            if ($j > $index) {
                $end = $j;
                break;
            }
        }
    }
    $lenght[] = $start;
    $lenght[] = $end;
    return searchPlace($arr, $lenght, $index);
}

function searchPlace($arr, $lenght, $index)
{
    if ($lenght[0] == 0) {
        $result1 = complete($arr, $lenght[0], $index - 1);
        $result2 = complete($arr, $index + 1, $lenght[1] - 1);
        $result = operation($arr[$index], $result1, $result2);
        array_splice($arr, $lenght[0], $lenght[1] - $lenght[0], $result);
        return $arr;
    } else {
        $result1 = complete($arr, $lenght[0] + 1, $index - 1);
        $result2 = complete($arr, $index + 1, $lenght[1] - 1);
        $result = operation($arr[$index], $result1, $result2);
        array_splice($arr, $lenght[0] + 1, $lenght[1] - $lenght[0] - 1, $result);
        return $arr;
    }
}

function operation($action, $arg1, $arg2)
{
    if ($action == '*') return $arg1 * $arg2;
    if ($action == '/') return $arg1 / $arg2;
    if ($action == '+') return $arg1 + $arg2;
    if ($action == '-') return $arg1 - $arg2;
}


var_dump(prior1Arr($str));