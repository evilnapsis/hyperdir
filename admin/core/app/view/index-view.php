<?php
$posts = PostData::getAll();
$categories = CategoryData::getAll();
$comments = CommentData::getAll();
$msgs = CommentData::getMessages();
?>

<!-- Header Section -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold text-indigo-900 mb-0">Resumen General</h2>
        <p class="text-muted small mb-0">Monitoriza el estado de tu directorio en tiempo real</p>
    </div>
    <div class="d-flex gap-2">
        <a href="./?view=posts&opt=new" class="btn btn-primary shadow-sm fw-bold">
            <i class="bi bi-plus-lg me-2"></i> Nuevo Anuncio
        </a>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 bg-white border-start border-primary border-4">
            <div class="d-flex align-items-center">
                <div class="p-3 bg-light rounded-circle me-3">
                    <i class="bi bi-megaphone text-primary fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0"><?php echo count($posts); ?></h3>
                    <span class="text-muted small fw-600">Anuncios</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 bg-white border-start border-success border-4">
            <div class="d-flex align-items-center">
                <div class="p-3 bg-light rounded-circle me-3">
                    <i class="bi bi-tags text-success fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0"><?php echo count($categories); ?></h3>
                    <span class="text-muted small fw-600">Categorías</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 bg-white border-start border-warning border-4">
            <div class="d-flex align-items-center">
                <div class="p-3 bg-light rounded-circle me-3">
                    <i class="bi bi-chat-dots text-warning fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0"><?php echo count($comments); ?></h3>
                    <span class="text-muted small fw-600">Comentarios</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100 bg-white border-start border-danger border-4">
            <div class="d-flex align-items-center">
                <div class="p-3 bg-light rounded-circle me-3">
                    <i class="bi bi-envelope text-danger fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0"><?php echo count($msgs); ?></h3>
                    <span class="text-muted small fw-600">Mensajes</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Chart Column -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold mb-0">Tendencia de Visitas</h5>
                    <span class="badge bg-light text-dark fw-normal">Últimos 7 días</span>
                </div>
                <div style="height: 350px;">
                    <canvas id="visitsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Recent Activity -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 p-4 pb-0">
                <h5 class="fw-bold mb-0">Anuncios Recientes</h5>
            </div>
            <div class="card-body p-4">
                <div class="list-group list-group-flush">
                    <?php if(count($posts)>0): ?>
                        <?php foreach(array_slice($posts, 0, 6) as $p): ?>
                        <div class="list-group-item px-0 border-0 mb-3 d-flex align-items-center">
                            <div class="avatar avatar-md bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                <i class="bi bi-megaphone-fill text-indigo-900 opacity-50"></i>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="fw-bold mb-0 text-truncate"><?php echo $p->title; ?></h6>
                                <span class="text-muted small"><?php echo date("d/m/Y", strtotime($p->created_at)); ?></span>
                            </div>
                            <div class="ms-2">
                                <a href="./?view=posts&opt=edit&id=<?php echo $p->id; ?>" class="btn btn-sm btn-light border">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted italic">No hay actividad reciente</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer bg-light border-0 p-3 text-center">
                <a href="./?view=posts&opt=all" class="text-decoration-none small fw-bold text-indigo-900">
                    Administrar todos los anuncios <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$days = [];
$counts = [];
for($i=6; $i>=0; $i--){
    $date = date("Y-m-d", strtotime("-$i days"));
    $days[] = date("d M", strtotime($date));
    $counts[] = PostViewData::countByDay($date);
}
?>

<script>
$(document).ready(function(){
    const ctx = document.getElementById('visitsChart').getContext('2d');
    
    // Gradiente para la gráfica
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(19, 15, 64, 0.2)');
    gradient.addColorStop(1, 'rgba(19, 15, 64, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($days); ?>,
            datasets: [{
                label: 'Visitas',
                data: <?php echo json_encode($counts); ?>,
                borderColor: '#130f40',
                backgroundColor: gradient,
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#130f40',
                pointBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#130f40',
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    padding: 12,
                    displayColors: false,
                    cornerRadius: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: { font: { size: 12 }, stepSize: 1 }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 } }
                }
            }
        }
    });
});
</script>
