<?php
function isHit($x, $y, $r)
{
    return (isRightTop($x, $y, $r) || isLeftBottom($x, $y, $r) || isLeftTop($x, $y, $r));
}

function isRightTop($x, $y, $r)
{
    return ($x >= 0) && ($y >= 0) && ($x ** 2 + $y ** 2 <= $r ** 2);
}

function isLeftBottom($x, $y, $r)
{
    return ($x <= 0) && ($y <= 0) && ($y >= -$x - $r);
}

function isLeftTop($x, $y, $r)
{
    return ($x <= 0) && ($y >= 0) && ($x >= -$r) && ($y <= $r / 2);
}

function xIsValid($x)
{
    return ($x == "-2" || $x == "-1.5" || $x == "-1" || $x == "-0.5" || $x == "0" || $x == "0.5" || $x == "1" || $x == "1.5" || $x == "2");
}

function yIsValid($y)
{
    $reg = "/[^-\d,.]/";
    return (!preg_match($reg, $y) && !($y == "") && (is_numeric($y)) && ($y > -5) && ($y < 3));
}

function rIsValid($r)
{
    return ($r == "1" || $r == "2" || $r == "3" || $r == "4" || $r == "5");
}
$x = "None";
$y = "None";
$r = "None";
$result = "Post request error";
$current_time = "-";
$processing_time = "-";


if (!empty($_POST))  {

    //Проверка на установленность всех значений
    if (isset($_POST['X']) && isset($_POST['Y']) && isset($_POST['R'])) {
        $x = trim($_POST['X']);
        $y = trim($_POST['Y']);
        $r = trim($_POST['R']);
        if (xIsValid($x)&&yIsValid($y)&&rIsValid($r)) {
            if (isHit($x, $y, $r)) {
                $result = "Hit";
            } else {
                $result = "Miss";
            }
            date_default_timezone_set('Europe/Moscow');
            $processing_time = round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 6);
            $current_time = date('G:i:s', time());
        }else {
            $result = "Incorrect input.";
        }
    } else {
        $result = "Fill all fields.";
    }
}
$response = '{
                "x": "' . $x . '",
                "y": "' . $y . '",
                "r": "' . $r . '",
                "result": "' . $result . '",
                "ctime": "' . $current_time . '",
                "etime": "' . $processing_time . '"
                }';
echo $response;

