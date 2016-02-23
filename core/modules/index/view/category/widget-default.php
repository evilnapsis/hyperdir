<?php
$category = CategoryData::getById($_GET["id"]);
		$posts = PostCategoryData::getAllByCategoryId($_GET["id"]); 
?>
<div class="container">
<div class="row">
<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
		<h1><?php echo $category->name;?></h1>
		<p class="text-muted"><?php echo count($posts); ?> Resultados</p>
		</div>
		</div>
	<div class="row">
		<div class="col-md-12">
		<?php if(count($posts)>0):?>
		<?php foreach($posts as $postx):$post=$postx->getPost(); ?>
			<div class="row">
			<div class="col-md-2">
<?php if($post->show_image&&$post->image_id!=null):
$image = ImageData::getById($post->image_id);
?>
<br>
<img src="admin/storage/images/<?php echo $image->src;?>" style='width:80px;' class="img-responsive img-thumbnail">
<?php endif;?>
			</div>
			<div class="col-md-10">
				<h2><a href="./?view=post&id=<?php echo $post->id; ?>"><?php echo $post->title;?></a></h2>
				<p><?php echo $post->content;?>.</p>
				    <?php if($post->phone!=""):?>
     <i class="fa fa-phone"></i> <?php echo $post->phone; ?>
    <?php else:?>
      Telefono no definido
    <?php endif;?>
				<a href="./?view=post&id=<?php echo $post->id; ?>" class="btn btn-default"> Mas Informacion <i class="fa fa-arrow-right"></i> </a>
				</div>
			</div>
			<?php endforeach; ?>
		<?php else:?>
			<div class="jumbotron">
			<h2>No hay anuncios</h2>
			<p>Al parecer aun no hay anuncios registrados en esta categoria.</p>
			</div>
			<br><br><br>
		<?php endif; ?>
		</div>
		
	</div>
</div>
<div class="col-md-3">
		<?php Action::load("widgets"); ?>
		</div>
</div>
</div>
<br><br><br>