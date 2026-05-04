<?php
if(isset($_SESSION["user_id"])){
$opt = $_GET["opt"];

if($opt == "aprove"){
    $c = CommentData::getById($_GET["id"]);
    $c->aprove();
    Core::redir("./?view=comments&opt=all");

} else if($opt == "unaprove"){
    $c = CommentData::getById($_GET["id"]);
    $c->unaprove();
    Core::redir("./?view=comments&opt=all");

} else if($opt == "del"){
    $c = CommentData::getById($_GET["id"]);
    $c->del();
    if(isset($_GET["kind"]) && $_GET["kind"]=="msg"){
        Core::redir("./?view=msgs");
    }else{
        Core::redir("./?view=comments&opt=all");
    }
}

}
?>
