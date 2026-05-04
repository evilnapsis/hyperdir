<?php
$settings = [
    "site_title" => SettingData::getValue("site_title"),
    "site_description" => SettingData::getValue("site_description"),
    "navbar_text" => SettingData::getValue("navbar_text"),
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Configuración del Sitio</h1>
                <p class="text-muted mb-0">Personaliza la identidad y parámetros globales de HyperDir</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="list-group list-group-flush" id="settings-tabs" role="tablist">
                        <a class="list-group-item list-group-item-action active p-3 fw-bold border-0" id="list-general-list" data-coreui-toggle="list" href="#list-general" role="tab">
                            <i class="bi bi-gear me-2"></i> Ajustes Generales
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content" id="nav-tabContent">
                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="list-general" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4 text-primary">Información General</h5>
                                <form method="post" action="./?action=settings&opt=update">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small">Título del Sitio</label>
                                        <input type="text" name="site_title" class="form-control" value="<?php echo $settings['site_title']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small">Descripción del Sitio</label>
                                        <textarea name="site_description" class="form-control" rows="3"><?php echo $settings['site_description']; ?></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small">Texto del Navbar</label>
                                        <input type="text" name="navbar_text" class="form-control" value="<?php echo $settings['navbar_text']; ?>">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                                            <i class="bi bi-save me-1"></i> Guardar Configuración
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
