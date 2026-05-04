<?php
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$posts = PostData::getLike($q);
?>
<div class="container py-5">
    <div class="mb-5">
        <h2 class="fw-bold mb-1">Resultados de búsqueda</h2>
        <p class="text-muted">Mostrando resultados para: <span class="fw-bold text-indigo-600">"<?php echo $q; ?>"</span></p>
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
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                    <h4 class="text-muted">No se encontraron anuncios que coincidan con tu búsqueda.</h4>
                    <p class="mb-4">Intenta con otros términos o explora nuestras categorías.</p>
                    <a href="./" class="btn btn-primary px-4 fw-bold">Volver al Inicio</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
