<?php
$opt = isset($_GET["opt"]) ? $_GET["opt"] : "all";
?>
<div class="row">
    <div class="col-md-12">

<?php if($opt=="all"):
$pages = PostData::getPages();
?>
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Páginas</h1>
                <p class="text-muted mb-0">Gestión de páginas estáticas del sitio</p>
            </div>
            <div class="ms-auto">
                <a href="./?view=pages&opt=new" class="btn btn-indigo shadow-sm fw-bold text-white px-4" style="background:#6366f1">
                    <i class="bi bi-plus-lg me-1"></i> Nueva Página
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
                            <?php foreach($pages as $p): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-indigo-900"><?php echo $p->title; ?></div>
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
                                    <a href="../?view=page&id=<?php echo $p->id; ?>" target="_blank" class="btn btn-light btn-sm text-indigo-600"><i class="bi bi-eye"></i></a>
                                    <a href="./?view=pages&opt=edit&id=<?php echo $p->id; ?>" class="btn btn-light btn-sm text-amber-600"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deletePage(<?php echo $p->id; ?>)"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<script>
function deletePage(id){
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
            window.location.href = "./?action=posts&opt=del&id="+id+"&kind=page";
        }
    })
}
</script>

<?php elseif($opt=="new" || $opt=="edit"):
$p = new PostData();
if($opt=="edit"){
    $p = PostData::getById($_GET["id"]);
}
?>
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0"><?php echo $opt=="new" ? "Nueva Página" : "Editar Página"; ?></h1>
                <p class="text-muted mb-0">Completa el contenido de la página</p>
            </div>
            <div class="ms-auto">
                <a href="./?view=pages&opt=all" class="btn btn-light shadow-sm fw-bold px-4">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form method="post" action="./?action=posts&opt=<?php echo $opt; ?>&kind=page" enctype="multipart/form-data">
                            <?php if($opt=="edit"): ?>
                                <input type="hidden" name="id" value="<?php echo $p->id; ?>">
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Título de la Página</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $p->title; ?>" required placeholder="Ej: Nosotros, Contacto...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Contenido</label>
                                <textarea name="content" class="form-control" rows="15" required><?php echo $p->content; ?></textarea>
                            </div>
                            
                            <div class="d-flex gap-3 mb-4 bg-light p-3 rounded">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_public" id="is_public" <?php echo $p->is_public ? "checked" : ""; ?>>
                                    <label class="form-check-label small fw-bold" for="is_public">Pública</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-indigo text-white fw-bold px-5 py-2" style="background:#6366f1">
                                <?php echo $opt=="new" ? "Crear Página" : "Actualizar Página"; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>

    </div>
</div>
