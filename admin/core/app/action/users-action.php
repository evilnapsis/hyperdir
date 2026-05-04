<?php
/**
* users-action.php - HyperDir
*/

if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
	$u = new UserData();
	$u->name = $_POST["name"];
	$u->lastname = $_POST["lastname"];
	$u->username = $_POST["username"];
	$u->email = $_POST["email"];
	$u->password = sha1(md5($_POST["password"]));
	$u->is_admin = isset($_POST["is_admin"]) ? 1 : 0;
	$u->is_active = isset($_POST["is_active"]) ? 1 : 0;
	$res = $u->add();
	
	if($res[0]){
		echo "success";
	} else { echo "error"; }
}

if(isset($_GET["opt"]) && $_GET["opt"] == "get"){
    $u = UserData::getById($_GET["id"]);
    header('Content-Type: application/json');
    echo json_encode($u);
    die();
}

if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
	$u = UserData::getById($_POST["id"]);
	$u->name = $_POST["name"];
	$u->lastname = $_POST["lastname"];
	$u->username = $_POST["username"];
	$u->email = $_POST["email"];
	$u->is_admin = isset($_POST["is_admin"]) ? 1 : 0;
	$u->is_active = isset($_POST["is_active"]) ? 1 : 0;
	$u->update();

    if($_POST["password"] != ""){
        $u->password = sha1(md5($_POST["password"]));
        $u->update_passwd();
    }
	echo "success";
}

if(isset($_GET["opt"]) && $_GET["opt"] == "del"){
	$u = UserData::getById($_GET["id"]);
	$u->del();
	echo "success";
}
?>
