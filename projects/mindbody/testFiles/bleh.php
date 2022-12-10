<!DOCTYPE html>
<html>
<body>

<?php
$zzz = 5;

function add($val1, $val2) {
   echo $val1 + $val2;
   //echo $x + $GLOBALS['zzz'] + <br>;
   //echo "Hello World <br>";
}

function cars() {
   $cars = array("Volvo", "Honda", "BMW");
   var_dump($cars);
}

include 'include.php';

cars();
echo "<br>";
subtract(10, 8);
echo "<br>";
add($x, $y);
echo "<br>";
echo "Hello\tThere<br>";
?>

</body>
</html> 
