<?php

$cookie_name = "aviso";
$cookie_value = "aceptado";
$month = 60 * 60 * 24 * 30 + time(); 
setcookie($cookie_name, $cookie_value, $month, "/");

?>