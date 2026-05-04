<?php
$opt = isset($_GET["opt"]) ? $_GET["opt"] : "all";
?>
<div class="row">
    <div class="col-md-12">

<?php if($opt=="all"):
$posts = PostData::getAll();
?>
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Anuncios</h1>
                <p class="text-muted mb-0">Gestión de listados y publicaciones</p>
            </div>
            <div class="ms-auto">
                <a href="./?view=posts&opt=new" class="btn btn-indigo shadow-sm fw-bold text-white px-4" style="background:#6366f1">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Anuncio
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">Titulo</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th class="pe-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $p): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-indigo-900"><?php echo $p->title; ?></div>
                                    <div class="text-muted small"><?php echo substr(strip_tags($p->content), 0, 50); ?>...</div>
                                </td>
                                <td>
                                    <?php if($p->is_public): ?>
                                        <span class="badge bg-emerald-100 text-emerald-700">Público</span>
                                    <?php else: ?>
                                        <span class="badge bg-amber-100 text-amber-700">Borrador</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="text-muted small"><?php echo $p->created_at; ?></span></td>
                                <td class="pe-4 text-end">
                                    <a href="../?view=post&id=<?php echo $p->id; ?>" target="_blank" class="btn btn-light btn-sm text-indigo-600"><i class="bi bi-eye"></i></a>
                                    <a href="./?view=posts&opt=edit&id=<?php echo $p->id; ?>" class="btn btn-light btn-sm text-amber-600"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deletePost(<?php echo $p->id; ?>)"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<script>
function deletePost(id){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./?action=posts&opt=del&id="+id;
        }
    })
}
</script>

<?php elseif($opt=="new" || $opt=="edit"):
$p = new PostData();
if($opt=="edit"){
    $p = PostData::getById($_GET["id"]);
}
$categories = CategoryData::getAll();
?>
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0"><?php echo $opt=="new" ? "Nuevo Anuncio" : "Editar Anuncio"; ?></h1>
                <p class="text-muted mb-0">Completa la información del listado</p>
            </div>
            <div class="ms-auto">
                <a href="./?view=posts&opt=all" class="btn btn-light shadow-sm fw-bold px-4">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form method="post" action="./?action=posts&opt=<?php echo $opt; ?>" enctype="multipart/form-data">
                            <?php if($opt=="edit"): ?>
                                <input type="hidden" name="id" value="<?php echo $p->id; ?>">
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Título del Anuncio</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $p->title; ?>" required placeholder="Ej: Vendo Laptop HP">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Contenido / Descripción</label>
                                <textarea name="content" class="form-control" rows="10" required><?php echo $p->content; ?></textarea>
                            </div>
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Dirección</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo $p->address; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Teléfono</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $p->phone; ?>">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">Email de Contacto</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $p->email; ?>">
                            </div>

                            <div class="d-flex gap-3 mb-4 bg-light p-3 rounded">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_public" id="is_public" <?php echo $p->is_public ? "checked" : ""; ?>>
                                    <label class="form-check-label small fw-bold" for="is_public">Publicar</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accept_comments" id="accept_comments" <?php echo $p->accept_comments ? "checked" : ""; ?>>
                                    <label class="form-check-label small fw-bold" for="accept_comments">Aceptar comentarios</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="show_image" id="show_image" <?php echo ($opt=="new" || $p->show_image) ? "checked" : ""; ?>>
                                    <label class="form-check-label small fw-bold" for="show_image">Mostrar imagen destacada</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-indigo text-white fw-bold px-5 py-2" style="background:#6366f1">
                                <?php echo $opt=="new" ? "Publicar Anuncio" : "Actualizar Anuncio"; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold small mb-0">Categorías</h5>
                    </div>
                    <div class="card-body px-4">
                        <?php 
                        $selected_cats = array();
                        if($opt=="edit"){
                            $pcs = PostCategoryData::getAllByPostId($p->id);
                            foreach($pcs as $pc) $selected_cats[] = $pc->category_id;
                        }
                        ?>
                        <?php foreach($categories as $cat): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="category_id[]" value="<?php echo $cat->id; ?>" id="cat_<?php echo $cat->id; ?>" <?php echo in_array($cat->id, $selected_cats) ? "checked" : ""; ?> form="add-post-form">
                            <label class="form-check-label small" for="cat_<?php echo $cat->id; ?>">
                                <?php echo $cat->name; ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold small mb-0">Imagen Destacada</h5>
                    </div>
                    <div class="card-body px-4 pb-4 text-center">
                        <?php if($opt=="edit" && $p->image_id): 
                            $img = ImageData::getById($p->image_id);
                        ?>
                            <img src="storage/images/<?php echo $img->src; ?>" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px;">
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control form-control-sm" form="add-post-form">
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden form connector for sidebar cards -->
        <script>
            // Need to make sure the sidebar checkboxes are submitted with the main form
            document.querySelector('form').id = 'add-post-form';
        </script>
<?php endif; ?>

    </div>
</div>
