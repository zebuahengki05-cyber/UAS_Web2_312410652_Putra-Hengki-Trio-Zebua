<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="border-bottom pb-2 mb-4">
        <h2 class="fw-bold text-dark"><?= $title; ?></h2>
        <p class="text-muted small m-0">Silakan ubah informasi dan gambar pada formulir di bawah ini untuk memperbarui artikel.</p>
    </div>

    <div class="card border-0 shadow-sm bg-white p-4">
        <form action="<?= base_url('/admin/artikel/update/' . $artikel['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="id_kategori" class="form-label fw-bold text-dark">Kategori Artikel</label>
                <select name="id_kategori" id="id_kategori" class="form-select" required>
                    <?php if (!empty($kategori) && is_array($kategori)): ?>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>" <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                                <?= $k['nama_kategori']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label fw-bold text-dark">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?= $artikel['judul']; ?>" placeholder="Masukkan judul artikel" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label fw-bold text-dark d-block">Gambar Sampul Artikel</label>
                
                <div class="mb-2">
                    <span class="d-block text-muted small mb-1">Gambar saat ini:</span>
                    <?php if (!empty($artikel['gambar']) && file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])) : ?>
                        <img src="<?= base_url('gambar/' . $artikel['gambar']); ?>" class="img-thumbnail bg-light shadow-sm" style="max-width: 180px; max-height: 120px; object-fit: cover;" alt="Gambar Lama">
                    <?php else : ?>
                        <img src="<?= base_url('gambar/default.jpg'); ?>" class="img-thumbnail bg-light shadow-sm" style="max-width: 180px; max-height: 120px; object-fit: cover;" alt="Default">
                    <?php endif; ?>
                </div>

                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                <div class="form-text text-muted small">Biarkan kosong jika tidak ingin mengubah gambar artikel asli.</div>
            </div>

            <div class="mb-4">
                <label for="isi" class="form-label fw-bold text-dark">Isi Konten Artikel</label>
                <textarea name="isi" id="isi" rows="8" class="form-control" placeholder="Tuliskan isi pembahasan artikel di sini..." required><?= $artikel['isi']; ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-medium px-4">
                    💾 Perbarui Artikel
                </button>
                <a href="<?= base_url('/admin/artikel'); ?>" class="btn btn-outline-secondary px-4">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>