<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="border-bottom pb-2 mb-4">
        <h2 class="fw-bold text-dark"><?= $title; ?></h2>
        <p class="text-muted small m-0">Selamat datang di portal artikel resmi kami. Silakan jelajahi informasi terbaru.</p>
    </div>

    <div class="row g-4">
        <?php if (!empty($artikel) && is_array($artikel)): ?>
            <?php foreach ($artikel as $row): ?>
                <div class="col-lg-6 col-md-12">
                    <div class="card h-100 border-0 shadow-sm bg-light overflow-hidden hover-shadow transition">
                        <div class="row g-0 h-100">
                            
                            <div class="col-sm-4 bg-secondary-subtle d-flex align-items-center justify-content-center" style="min-height: 150px;">
                                <?php if (!empty($row['gambar']) && file_exists(ROOTPATH . 'public/gambar/' . $row['gambar'])) : ?>
                                    <img src="<?= base_url('gambar/' . $row['gambar']); ?>" class="img-fluid object-fit-cover w-100 h-100" alt="<?= $row['judul']; ?>">
                                <?php else : ?>
                                    <img src="<?= base_url('gambar/default.jpg'); ?>" class="img-fluid object-fit-cover w-100 h-100" alt="Default">
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-sm-8 d-flex flex-column">
                                <div class="card-body p-3 flex-grow-1">
                                    <div class="mb-1">
                                        <span class="badge bg-info text-dark fw-semibold small"><?= $row['nama_kategori'] ?? 'Tanpa Kategori'; ?></span>
                                    </div>
                                    <h5 class="card-title fw-bold text-dark mb-2 line-clamp-2">
                                        <?= $row['judul']; ?>
                                    </h5>
                                    <p class="card-text text-muted small line-clamp-3">
                                        <?= substr(strip_tags($row['isi']), 0, 120); ?>...
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-0 p-3 pt-0 mt-auto">
                                    <a href="<?= base_url('/artikel/' . $row['slug']); ?>" class="btn btn-outline-primary btn-sm px-3 fw-medium">
                                        Baca Selengkapnya ➡️
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-light rounded shadow-sm inline-block border">
                    <h4 class="text-muted fw-bold m-0">📭 Belum ada artikel yang diterbitkan, bro.</h4>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($pager)): ?>
        <div class="d-flex justify-content-start alignment-pager mt-4 pt-2 border-top">
            <?= $pager->links(); ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>