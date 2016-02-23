<?php
/**
* @author evilnapsis
* @brief Actualizar los datos de un articulo
**/
		$p = PostData::getById($_POST["id"]);
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		$p->address = $_POST["address"];
		$p->phone = $_POST["phone"];
		$p->email = $_POST["email"];
		$p->lat = $_POST["lat"];
		$p->lng = $_POST["lng"];
		$p->use_map = isset($_POST["use_map"])?1:0;
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->update();

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$img = new ImageData();
					$img->src = $image->file_dst_name;
					$img->user_id=$_SESSION["user_id"];
					$imgx=$img->add();
					$p->image_id=$imgx[1];
					$p->update_img();
				}
			}
		}




if(isset($_POST["category_id"])&&count($_POST["category_id"])>0){
		$sels = $_POST["category_id"];
		$asigs = PostCategoryData::getAllByPostId($_POST["id"]);
		$categories = CategoryData::getAll();
		foreach($categories as $category){
				$pc = PostCategoryData::getByPC($_POST["id"],$category->id);
				if($pc!=null){$pc->del();}
				foreach ($sels as $sel) {
					if(PostCategoryData::getByPC($_POST["id"],$sel)==null){
						$pc = new PostCategoryData();
						$pc->post_id = $_POST["id"];
						$pc->category_id = $sel;
						$pc->add();
					}
				}
		}
		}

		Core::redir("./?view=editpost&id=".$_POST["id"]);
?>