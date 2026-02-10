
<?php
require_once 'Productos.php';

$productos = new Productos();
$productos->manejarRequest(); // get o post
