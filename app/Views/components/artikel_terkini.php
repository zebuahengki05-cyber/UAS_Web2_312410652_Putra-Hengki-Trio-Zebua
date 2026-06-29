<?php
// Buat data artikel tiruan langsung di sini agar aman dan anti-error
$artikel_terkini = [
    [
        'judul' => 'Selamat Datang di Kuliah Web 2',
        'slug'  => 'selamat-datang-di-kuliah-web-2'
    ],
    [
        'judul' => 'Tutorial View Layout CodeIgniter 4',
        'slug'  => 'tutorial-view-layout-codeigniter-4'
    ],
    [
        'judul' => 'Mengenal Fitur View Cell Modular',
        'slug'  => 'mengenal-fitur-view-cell-modular'
    ]
];
?>

<div class="card p-3 mb-3 shadow-sm border-0 bg-light">
    <h3 class="h5 border-bottom pb-2 fw-bold text-dark">Artikel Terkini</h3>
    <ul class="list-unstyled mb-0">
        <?php foreach ($artikel_terkini as $row): ?>
            <li class="mb-2">
                <a href="<?= base_url('/artikel/' . $row['slug']); ?>" class="text-decoration-none text-primary fw-medium">
                    <?= $row['judul']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>