<?php
if(isset($_SESSION["user_id"])){
$opt = $_GET["opt"];

if($opt == "add"){
	$cat = new CategoryData();
	$cat->name = $_POST["name"];
	$cat->color = $_POST["color"];
	$res = $cat->add();
	
	if($res[0]){ echo "success"; } else { echo "error"; }

} else if($opt == "update"){
    $cat = CategoryData::getById($_POST["id"]);
    $cat->name = $_POST["name"];
    $cat->color = $_POST["color"];
    $cat->update();
    echo "success";

} else if($opt == "del"){
    $cat = CategoryData::getById($_GET["id"]);
    $cat->del();
    Core::redir("./?view=categories&opt=all");
}

}
?>
