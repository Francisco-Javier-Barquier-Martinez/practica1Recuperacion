<?php
require "../vendor/autoload.php";
require "../clases/Datos.php";
use Clases\Datos;
$usu = new Datos('users', 25);
echo "<h2>Usuarios Creados</h2>";