<?php
if(isset($_SESSION["user_id"])){
$opt = $_GET["opt"];

if($opt == "add"){
    if(isset($_FILES["image"]) && $_FILES["image"]["name"]!=""){
        $handle = new Upload($_FILES["image"]);
        if($handle->uploaded){
            $handle->Process("storage/images/");
            if($handle->processed){
                $img = new ImageData();
                $img->src = $handle->file_dst_name;
                $img->user_id = $_SESSION["user_id"];
                $img->add();
            }
        }
    }
    Core::redir("./?view=images&opt=all");

} else if($opt == "del"){
    $img = ImageData::getById($_GET["id"]);
    // Opcionalmente borrar el archivo físico
    if(file_exists("storage/images/".$img->src)){
        unlink("storage/images/".$img->src);
    }
    $img->del();
    Core::redir("./?view=images&opt=all");
}

}
?>
