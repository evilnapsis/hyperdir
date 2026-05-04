<?php
if(count($_POST)>0){
    $c = new CommentData();
    $c->name = $_POST["name"];
    $c->email = $_POST["email"];
    $c->content = $_POST["content"];
    $c->post_id = $_POST["post_id"];
    $c->add();
    
    echo "<script>alert('Tu comentario ha sido enviado y está pendiente de aprobación.'); window.location.href='./?view=post&id=".$_POST["post_id"]."';</script>";
}
?>
