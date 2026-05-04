<?php
if(isset($_SESSION["user_id"])){
$opt = $_GET["opt"];

if($opt=="new"){
    $p = new PostData();
    $p->title = $_POST["title"];
    $p->content = $_POST["content"];
    $p->address = $_POST["address"] ?? "";
    $p->phone = $_POST["phone"] ?? "";
    $p->email = $_POST["email"] ?? "";
    $p->is_public = isset($_POST["is_public"]) ? 1 : 0;
    $p->accept_comments = isset($_POST["accept_comments"]) ? 1 : 0;
    $p->show_image = isset($_POST["show_image"]) ? 1 : 0;
    $p->user_id = $_SESSION["user_id"];
    $p->use_map = isset($_POST["use_map"]) ? 1 : 0;

    if(isset($_FILES["image"]) && $_FILES["image"]["name"]!=""){
        $handle = new Upload($_FILES["image"]);
        if($handle->uploaded){
            $handle->Process("storage/images/");
            if($handle->processed){
                $img = new ImageData();
                $img->src = $handle->file_dst_name;
                $img->user_id = $_SESSION["user_id"];
                $imgx = $img->add();
                $p->image_id = $imgx[1];
            }
        }
    }

    if(isset($_GET["kind"]) && $_GET["kind"]=="page"){
        $px = $p->addpage();
        Core::redir("./?view=pages&opt=all");
    }else{
        $px = $p->add();
        if(isset($_POST["category_id"]) && is_array($_POST["category_id"])){
            foreach ($_POST["category_id"] as $cat) {
                $pc = new PostCategoryData();
                $pc->post_id = $px[1];
                $pc->category_id = $cat;
                $pc->add();
            }
        }
        Core::redir("./?view=posts&opt=all");
    }

} else if($opt=="edit"){
    $p = PostData::getById($_POST["id"]);
    $p->title = $_POST["title"];
    $p->content = $_POST["content"];
    $p->address = $_POST["address"];
    $p->phone = $_POST["phone"];
    $p->email = $_POST["email"];
    $p->is_public = isset($_POST["is_public"]) ? 1 : 0;
    $p->accept_comments = isset($_POST["accept_comments"]) ? 1 : 0;
    $p->show_image = isset($_POST["show_image"]) ? 1 : 0;
    $p->use_map = isset($_POST["use_map"]) ? 1 : 0;

    if(isset($_FILES["image"]) && $_FILES["image"]["name"]!=""){
        $handle = new Upload($_FILES["image"]);
        if($handle->uploaded){
            $handle->Process("storage/images/");
            if($handle->processed){
                $img = new ImageData();
                $img->src = $handle->file_dst_name;
                $img->user_id = $_SESSION["user_id"];
                $imgx = $img->add();
                $p->image_id = $imgx[1];
                $p->update_img();
            }
        }
    }

    $p->update();

    // Actualizar categorías: primero borrar las anteriores y agregar las nuevas
    $old_categories = PostCategoryData::getAllByPostId($p->id);
    foreach($old_categories as $oc) $oc->del();

    if(isset($_POST["category_id"]) && is_array($_POST["category_id"])){
        foreach ($_POST["category_id"] as $cat) {
            $pc = new PostCategoryData();
            $pc->post_id = $p->id;
            $pc->category_id = $cat;
            $pc->add();
        }
    }
    
    if(isset($_GET["kind"]) && $_GET["kind"]=="page"){
        Core::redir("./?view=pages&opt=all");
    }else{
        Core::redir("./?view=posts&opt=all");
    }

} else if($opt=="del"){
    $p = PostData::getById($_GET["id"]);
    // Borrar categorías asociadas
    $categories = PostCategoryData::getAllByPostId($p->id);
    foreach($categories as $c) $c->del();
    
    $p->del();
    
    if(isset($_GET["kind"]) && $_GET["kind"]=="page"){
        Core::redir("./?view=pages&opt=all");
    }else{
        Core::redir("./?view=posts&opt=all");
    }
}

}
?>
