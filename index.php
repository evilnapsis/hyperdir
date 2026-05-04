<?php
/**
* @author evilnapsis
* @brief HyperDir New Public Site
**/

session_start();
include "admin/core/autoload.php";

// Autoload de modelos desde el admin
function public_autoload($modelname){
	if(file_exists("admin/core/app/model/".$modelname.".php")){
		include "admin/core/app/model/".$modelname.".php";
	} 
}
spl_autoload_register("public_autoload");

$lb = new Lb();
$lb->start();

?>
