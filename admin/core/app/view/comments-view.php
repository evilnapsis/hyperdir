<?php
$comments = CommentData::getAll();
?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Comentarios</h1>
                <p class="text-muted mb-0">Gestiona los comentarios y feedback de los usuarios</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">Autor</th>
                                <th>Comentario</th>
                                <th>Anuncio</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th class="pe-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($comments as $c): 
                                $p = $c->getPost();
                            ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold"><?php echo $c->name; ?></div>
                                    <div class="text-muted small"><?php echo $c->email; ?></div>
                                </td>
                                <td><div class="text-wrap" style="max-width: 300px;"><?php echo $c->content; ?></div></td>
                                <td><?php echo $p ? $p->title : "N/A"; ?></td>
                                <td>
                                    <?php if($c->is_public): ?>
                                        <span class="badge bg-emerald-100 text-emerald-700">Aprobado</span>
                                    <?php else: ?>
                                        <span class="badge bg-amber-100 text-amber-700">Pendiente</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="text-muted small"><?php echo $c->created_at; ?></span></td>
                                <td class="pe-4 text-end">
                                    <?php if(!$c->is_public): ?>
                                        <a href="./?action=comments&opt=aprove&id=<?php echo $c->id; ?>" class="btn btn-light btn-sm text-success"><i class="bi bi-check-lg"></i></a>
                                    <?php else: ?>
                                        <a href="./?action=comments&opt=unaprove&id=<?php echo $c->id; ?>" class="btn btn-light btn-sm text-warning"><i class="bi bi-x-lg"></i></a>
                                    <?php endif; ?>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deleteComment(<?php echo $c->id; ?>)"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteComment(id){
    Swal.fire({
        title: '¿Eliminar comentario?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./?action=comments&opt=del&id="+id;
        }
    })
}
</script>
