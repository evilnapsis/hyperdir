<?php
$p = PostData::getById($_GET["id"]);

// Logica de conteo de visitas (una vez cada 24 horas por IP)
$ip = $_SERVER['REMOTE_ADDR'];
$pv = PostViewData::getByIPAndPost($ip, $p->id);
if(!$pv){
    $npv = new PostViewData();
    $npv->post_id = $p->id;
    $npv->realip = $ip;
    $npv->add();
}

$img = null;
if($p->image_id) $img = ImageData::getById($p->image_id);
$comments = CommentData::getApprovedByPostId($p->id);

// Obtener categoria para el sidebar
$pcs = PostCategoryData::getAllByPostId($p->id);
$related_posts = [];
if(count($pcs)>0){
    $cat_id = $pcs[0]->category_id;
    $related_pcs = PostCategoryData::getAllByCategoryId($cat_id);
    foreach($related_pcs as $rpc){
        if($rpc->post_id != $p->id){
            $rp = $rpc->getPost();
            if($rp->is_public && $rp->kind==1){
                $related_posts[] = $rp;
            }
        }
        if(count($related_posts)>=10) break;
    }
}
?>
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 300px;"><?php echo $p->title; ?></li>
                </ol>
            </nav>

            <!-- Post Content -->
            <div class="card shadow-sm border-0 mb-5 overflow-hidden">
                <?php if($img && $p->show_image): ?>
                    <img src="admin/storage/images/<?php echo $img->src; ?>" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body p-4 p-lg-5">
                    <div class="mb-3">
                        <?php 
                        foreach($pcs as $pc): 
                            $cat = $pc->getCategory();
                        ?>
                            <span class="category-badge mb-1 d-inline-block"><?php echo $cat->name; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h1 class="display-5 fw-bold mb-4"><?php echo $p->title; ?></h1>
                    
                    <div class="content mb-5" style="line-height: 1.8; color: #334155;">
                        <?php echo nl2br($p->content); ?>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-light rounded-4 p-4 mb-5">
                        <h5 class="fw-bold mb-3">Información de Contacto</h5>
                        <div class="row g-3">
                            <?php if($p->address): ?>
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill text-indigo-600 fs-5 me-3"></i>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Dirección</div>
                                        <div><?php echo $p->address; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($p->phone): ?>
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="bi bi-telephone-fill text-indigo-600 fs-5 me-3"></i>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Teléfono</div>
                                        <div><?php echo $p->phone; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($p->email): ?>
                                <div class="col-md-6 d-flex align-items-center">
                                    <i class="bi bi-envelope-fill text-indigo-600 fs-5 me-3"></i>
                                    <div>
                                        <div class="small text-muted fw-bold text-uppercase">Email</div>
                                        <div><?php echo $p->email; ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($p->use_map && $p->lat && $p->lng): ?>
                        <div class="mb-5">
                            <h5 class="fw-bold mb-3">Ubicación</h5>
                            <div class="rounded-4 overflow-hidden border" style="height: 300px;">
                                <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?key=YOUR_API_KEY&center=<?php echo $p->lat; ?>,<?php echo $p->lng; ?>&zoom=15" allowfullscreen></iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Comments Section -->
            <?php if($p->accept_comments): ?>
            <div id="comments" class="mb-5">
                <h4 class="fw-bold mb-4">Comentarios (<?php echo count($comments); ?>)</h4>
                
                <?php foreach($comments as $c): ?>
                <div class="d-flex mb-4 p-3 bg-white rounded-3 shadow-sm">
                    <div class="avatar avatar-md bg-indigo-100 text-indigo-600 rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px;">
                        <?php echo substr($c->name, 0, 1); ?>
                    </div>
                    <div>
                        <div class="fw-bold mb-1"><?php echo $c->name; ?> <span class="small text-muted fw-normal ms-2"><?php echo date("d/m/Y", strtotime($c->created_at)); ?></span></div>
                        <p class="text-muted mb-0"><?php echo $c->content; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="card border-0 shadow-sm rounded-4 mt-5">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Deja un comentario</h5>
                        <form method="post" action="./?action=addcomment">
                            <input type="hidden" name="post_id" value="<?php echo $p->id; ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nombre</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Comentario</label>
                                    <textarea name="content" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">Enviar Comentario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white p-4 border-0 pb-0">
                        <h5 class="fw-bold mb-0">Anuncios Relacionados</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if(count($related_posts)>0): ?>
                            <?php foreach($related_posts as $rp): 
                                $rimg = null;
                                if($rp->image_id) $rimg = ImageData::getById($rp->image_id);
                            ?>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <?php if($rimg): ?>
                                        <img src="admin/storage/images/<?php echo $rimg->src; ?>" class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">
                                        <a href="./?view=post&id=<?php echo $rp->id; ?>" class="text-decoration-none text-dark"><?php echo $rp->title; ?></a>
                                    </h6>
                                    <p class="text-muted small mb-0"><?php echo date("d/m/Y", strtotime($rp->created_at)); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted small">No hay otros anuncios en esta categoría.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Banner/Info Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-indigo-900 text-white" style="background: #130f40;">
                    <div class="card-body p-4 text-center">
                        <i class="bi bi-megaphone fs-1 mb-3 d-block"></i>
                        <h5 class="fw-bold">¿Quieres publicar?</h5>
                        <p class="small opacity-75 mb-4">Únete a nuestro directorio y llega a miles de personas.</p>
                        <a href="./?view=contact" class="btn btn-light btn-sm fw-bold px-4 rounded-pill">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
