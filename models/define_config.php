<?

require_once $_SERVER['DOCUMENT_ROOT']."/models/init.php";



$constants = $base->define_get();

define("DEBUG", (bool)$constants[0]['value']);
define("CACHE", (bool)$constants[1]['value']);