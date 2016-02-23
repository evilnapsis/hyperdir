<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1>CATEGORIAS</h1>
		</div>
		</div>
	<div class="row">
		<div class="col-md-9">
		<?php 
		$posts = CategoryData::getAll(); 
		?>
		<?php if(count($posts)>0):?>
			<ul>
		<?php foreach($posts as $post):?>
				<li><a href="./?view=category&id=<?php echo $post->id; ?>"><?php echo $post->name; ?></a></li>
			<?php endforeach; ?>
			</ul>
		<?php else:?>
			<div class="jumbotron">
			<h2>No hay categorias</h2>
			<p>En esta seccion se mostrara un listado de las categoria del sitio.</p>
			</div>
			<br><br><br>
		<?php endif; ?>
		</div>
	</div>
</div>
