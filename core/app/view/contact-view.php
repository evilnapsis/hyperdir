<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <div class="avatar avatar-lg bg-indigo-100 text-indigo-600 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-envelope-at fs-1"></i>
                        </div>
                        <h2 class="fw-bold">Contáctanos</h2>
                        <p class="text-muted">Envíanos un mensaje y te responderemos lo antes posible.</p>
                    </div>

                    <form method="post" action="./?action=addmsg">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nombre Completo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="juan@ejemplo.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Mensaje</label>
                            <textarea name="content" class="form-control" rows="5" placeholder="¿En qué podemos ayudarte?" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-5 text-center">
                <div class="d-flex justify-content-center gap-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt text-indigo-600 me-2"></i>
                        <span class="small text-muted"><?php echo SettingData::getValue("navbar_text"); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
