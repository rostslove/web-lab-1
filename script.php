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
session_start();
if(!isset($_SESSION['rows'])){
    $_SESSION['rows'] = array();
}
$index = count($_SESSION['rows']);
$start = microtime(true);
$x = $_POST['X'];
$y = $_POST['Y'];
$r = $_POST['R'];
$check = isHit($x, $y, $r);
$finish = microtime(true);
$time = number_format($finish-$start,8);
    $dt = new DateTime("now", new DateTimeZone('Europe/Moscow'));
echo '
                <table style= 
                "color: black;
                background-color: white;
                width: 100%;
                border-spacing: 13px;
                border-color: black;
                text-align: center;"
                >
                    <thead>
                        <th>X</th>
                        <th>Y</th>
                        <th>R</th>
                        <th>Попадает ли точка в область?</th>
                        <th>Текущее время</th>
                        <th>Время выполнения скрипта</th>
                    </thead>';
if ($check){
    $row = "<tr><td>" . $x . "</td> <td> " . $y . "</td> <td>" . $r . "</td> <td> Да </td> <td>" . $dt->format('H:i:s.u'). "</td> <td>". $time . " </td></tr>";
}
else {
    $row = "<tr><td>" . $x . "</td> <td> " . $y . "</td> <td>" . $r . "</td> <td> Нет </td> <td>" . $dt->format('H:i:s.u'). "</td> <td>". $time . " </td></tr>";
}
$_SESSION['rows'][$index] = $row;
if(count($_SESSION['rows'])>=5){
    $i = count($_SESSION['rows']) - 5;
}else{
    $i = 0;
}
for ($i; $i < count($_SESSION['rows']); $i++){
    echo $_SESSION['rows'][$i];
}
echo '</table>';
?>
