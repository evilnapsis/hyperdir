<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ConfigData::getByKey("site_title")->description; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .navbar { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .navbar-brand { font-weight: 700; color: #130f40; }
        .hero-section { background: linear-gradient(135deg, #130f40 0%, #000000 100%); color: white; padding: 100px 0; border-radius: 0 0 50px 50px; }
        .card { border: none; border-radius: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .btn-primary { background-color: #130f40; border: none; border-radius: 12px; padding: 10px 25px; font-weight: 600; }
        .btn-primary:hover { background-color: #0c0930; }
        .category-badge { background-color: #f0f2f5; color: #130f40; border-radius: 30px; padding: 5px 15px; font-size: 0.8rem; font-weight: 600; border: 1px solid rgba(19, 15, 64, 0.1); }
        footer { background-color: #130f40; color: white; padding: 60px 0 30px; margin-top: 80px; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="./">
                <i class="bi bi-folder2-open me-2 fs-4"></i>
                <span><?php echo ConfigData::getByKey("navbar_text")->description; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="./">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">Categorías</a>
                        <ul class="dropdown-menu border-0 shadow-lg" style="border-radius: 15px;">
                            <?php foreach(CategoryData::getAll() as $cat): ?>
                            <li><a class="dropdown-item py-2" href="./?view=category&id=<?php echo $cat->id; ?>"><?php echo $cat->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link px-3" href="./?view=contact">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php View::load("index"); ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <div class="mb-4">
                <h4 class="fw-bold"><?php echo ConfigData::getByKey("site_title")->description; ?></h4>
                <p class="text-white-50"><?php echo ConfigData::getByKey("site_description")->description; ?></p>
            </div>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
            </div>
            <hr class="border-white-10 my-4">
            <p class="small text-white-50 mb-0">&copy; <?php echo date("Y"); ?> HyperDir. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
