<?php
$messages = CommentData::getMessages();
?>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Mensajes de Contacto</h1>
                <p class="text-muted mb-0">Gestión de mensajes enviados desde el formulario de contacto</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="ps-4">Autor</th>
                                <th>Mensaje</th>
                                <th>Fecha</th>
                                <th class="pe-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $c): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold"><?php echo $c->name; ?></div>
                                    <div class="text-muted small"><?php echo $c->email; ?></div>
                                </td>
                                <td><div class="text-wrap" style="max-width: 400px;"><?php echo $c->content; ?></div></td>
                                <td><span class="text-muted small"><?php echo $c->created_at; ?></span></td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-light btn-sm text-danger" onclick="deleteMsg(<?php echo $c->id; ?>)"><i class="bi bi-trash"></i></button>
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
function deleteMsg(id){
    Swal.fire({
        title: '¿Eliminar mensaje?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6366f1',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./?action=comments&opt=del&id="+id+"&kind=msg";
        }
    })
}
</script>
