<?php
if(count($_POST)>0){
    $c = new CommentData();
    $c->name = $_POST["name"];
    $c->email = $_POST["email"];
    $c->content = $_POST["content"];
    $c->addmsg();
    
    echo "<script>alert('Tu mensaje ha sido enviado correctamente. Gracias por contactarnos.'); window.location.href='./?view=contact';</script>";
}
?>
