<?php

$a = "bmw"; 
$color = array("a" => "Red", "b" => "green", "c" => "Blue", "d" => "violet", "e" => "grey", "f" => "brown");

//extract($color);

echo "The favourite color is: " . $a;

extract($color, EXTR_SKIP);

echo "<br>My pet color is: " . $a; 


$aa = "Rajkumar";
$bb = "RAjiv";
$cc = "Roni";
$dd = "Ravi";

$new = compact("aa", "bb", "cc", "dd");

echo "<pre>";
print_r($new);
echo "</pre>";


?>
