<?php
$posts = PostData::getLast10();
?>
<!-- Hero -->
<section class="hero-section text-center mb-5">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Encuentra lo que buscas</h1>
        <p class="lead mb-4 text-white-50">Explora los mejores anuncios y servicios en tu ciudad.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="./" method="get" class="bg-white p-2 rounded-pill shadow-lg d-flex">
                    <input type="hidden" name="view" value="search">
                    <input type="text" name="q" class="form-control border-0 rounded-pill px-4" placeholder="Buscar anuncios...">
                    <button class="btn btn-primary rounded-pill px-4" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <h2 class="fw-bold mb-0">Anuncios Recientes</h2>
    </div>

    <div class="row g-4">
        <?php if(count($posts)>0): ?>
            <?php foreach($posts as $p): 
                $img = null;
                if($p->image_id) $img = ImageData::getById($p->image_id);
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm overflow-hidden">
                    <?php if($img): ?>
                        <img src="admin/storage/images/<?php echo $img->src; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <?php 
                            $pcs = PostCategoryData::getAllByPostId($p->id);
                            foreach($pcs as $pc): 
                                $cat = $pc->getCategory();
                            ?>
                                <span class="category-badge mb-1 d-inline-block"><?php echo $cat->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <h5 class="card-title fw-bold mb-2"><?php echo $p->title; ?></h5>
                        <p class="card-text text-muted small mb-4"><?php echo substr(strip_tags($p->content), 0, 100); ?>...</p>
                        <div class="d-flex align-items-center mt-auto pt-3 border-top">
                            <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i> <?php echo date("d M, Y", strtotime($p->created_at)); ?></span>
                            <a href="./?view=post&id=<?php echo $p->id; ?>" class="btn btn-link text-indigo-600 fw-bold ms-auto p-0 text-decoration-none">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-megaphone fs-1 text-muted mb-3 d-block"></i>
                <h4 class="text-muted">No hay anuncios disponibles por ahora.</h4>
            </div>
        <?php endif; ?>
    </div>
</div>
