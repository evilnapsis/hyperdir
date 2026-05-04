<?php
$images = ImageData::getAll();
?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Galería de Imágenes</h1>
                <p class="text-muted mb-0">Administra las imágenes subidas al sistema</p>
            </div>
            <div class="ms-auto">
                <button class="btn btn-indigo shadow-sm fw-bold text-white px-4" style="background:#6366f1" data-coreui-toggle="modal" data-coreui-target="#newImageModal">
                    <i class="bi bi-upload me-1"></i> Subir Imagen
                </button>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($images as $img): ?>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 border-0 shadow-sm overflow-hidden position-relative group">
                    <img src="storage/images/<?php echo $img->src; ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2">
                        <div class="text-truncate small fw-bold text-muted"><?php echo $img->src; ?></div>
                    </div>
                    <div class="position-absolute top-0 end-0 p-2 opacity-0 group-hover-opacity-100 transition-opacity">
                        <button class="btn btn-danger btn-sm shadow-sm" onclick="deleteImage(<?php echo $img->id; ?>)"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
.group:hover .group-hover-opacity-100 { opacity: 1 !important; }
.transition-opacity { transition: opacity 0.2s ease-in-out; }
</style>

<!-- Modal: New Image -->
<div class="modal fade" id="newImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Subir Nueva Imagen</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal"></button>
            </div>
            <form method="post" action="./?action=images&opt=add" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Seleccionar archivo</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light fw-bold" data-coreui-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-indigo text-white fw-bold px-4">Subir ahora</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function deleteImage(id){
    Swal.fire({
        title: '¿Eliminar imagen?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./?action=images&opt=del&id="+id;
        }
    })
}
</script>
