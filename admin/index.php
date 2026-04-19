<?php
/**
* @author evilnapsis
* @brief Libera la bestia ...
**/
$debug= true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}else{
error_reporting(0);	
}
session_start();
include "core/autoload.php";

$lb = new Lb();
$lb->loadModule("index");


/**
* Zard CMS
**/

?>