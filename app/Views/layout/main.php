<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light m-0 p-0">

    <div class="container-fluid min-vh-100 d-flex flex-column p-0 m-0 bg-white">
        
        <header class="bg-dark text-white p-4">
            <h1 class="m-0 fw-bold h2">Layout Sederhana</h1>
        </header>
        
        <nav class="bg-secondary p-2 d-flex justify-content-between align-items-center px-4 shadow-sm">
            <div class="d-flex gap-3">
                <a href="<?= base_url('/artikel'); ?>" class="text-white text-decoration-none fw-medium">Home</a>
                <a href="<?= base_url('/artikel'); ?>" class="text-white text-decoration-none">Artikel</a>
                <a href="<?= base_url('/about'); ?>" class="text-white text-decoration-none">About</a>
                <a href="<?= base_url('/contact'); ?>" class="text-white text-decoration-none">Kontak</a>
            </div>
            
            <?php if (session()->get('logged_in')): ?>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-white-50 me-2 small">Halo, <strong><?= session()->get('username'); ?></strong>!</span>
                    <a href="<?= base_url('/user/logout'); ?>" class="btn btn-danger btn-sm fw-medium py-1 px-3 shadow-sm" onclick="return confirm('Yakin ingin logout, bro?')">
                        🚪 Logout
                    </a>
                </div>
            <?php endif; ?>
        </nav>
        
        <div class="flex-grow-1 p-4">
            <div class="row g-4 m-0">
                <section class="col-md-9 p-0 pr-md-3">
                    <?= $this->renderSection('content') ?>
                </section>
                
                <aside class="col-md-3 p-0 ps-md-3">
                    <?= view('components/artikel_terkini') ?>
                    
                    <div class="card p-3 mb-3 shadow-sm border-0 bg-light">
                        <h3 class="h5 border-bottom pb-2 fw-bold text-dark">Widget Header</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><a href="#" class="text-decoration-none text-secondary small">🔗 Widget Link 1</a></li>
                            <li><a href="#" class="text-decoration-none text-secondary small">🔗 Widget Link 2</a></li>
                        </ul>
                    </div>
                    
                    <div class="card p-3 shadow-sm border-0 bg-light">
                        <h3 class="h5 border-bottom pb-2 fw-bold text-dark">Widget Text</h3>
                        <p class="small text-muted mb-0">Vestibulum lorem elit, iaculis in nisl volutpat, vestibulum mi porta, nunc pretium ac.</p>
                    </div>
                </aside>
            </div>
        </div>
        
        <footer class="bg-dark text-white text-center p-3 mt-auto">
            <p class="m-0 small">&copy; 2026 Universitas Pelita Bangsa | Teknik Informatika</p>
        </footer>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>