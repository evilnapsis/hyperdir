<?php
if(!isset($_GET["action"])){
	Module::loadLayout("index");
}else{
	Action::load($_GET["action"]);
}
?>
