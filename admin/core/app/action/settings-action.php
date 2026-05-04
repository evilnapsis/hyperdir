<?php
if(isset($_SESSION["user_id"])){
$opt = $_GET["opt"];

if($opt == "update"){
    foreach($_POST as $key => $value){
        $s = SettingData::getByKey($key);
        if($s){
            $s->description = $value;
            $s->update();
        }
    }
    Core::redir("./?view=settings&opt=all");
}

}
?>
