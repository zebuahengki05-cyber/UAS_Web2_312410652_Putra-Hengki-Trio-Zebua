<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="border-bottom pb-2 mb-4">
        <h2 class="fw-bold text-dark"><?= $title; ?></h2>
        <p class="text-muted small m-0">Silakan isi formulir di bawah ini untuk menambahkan artikel beserta gambar baru.</p>
    </div>

    <div class="card border-0 shadow-sm bg-white p-4">
        <form action="<?= base_url('/admin/artikel/insert'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="id_kategori" class="form-label fw-bold text-dark">Kategori Artikel</label>
                <select name="id_kategori" id="id_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori Artikel --</option>
                    <?php if (!empty($kategori) && is_array($kategori)): ?>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label fw-bold text-dark">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artikel" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label fw-bold text-dark">Unggah Gambar Sampul</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                <div class="form-text text-muted small">Format yang didukung: JPG, JPEG, PNG, GIF.</div>
            </div>

            <div class="mb-4">
                <label for="isi" class="form-label fw-bold text-dark">Isi Konten Artikel</label>
                <textarea name="isi" id="isi" rows="8" class="form-control" placeholder="Tuliskan isi pembahasan artikel di sini..." required></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-medium px-4">
                    💾 Simpan Artikel
                </button>
                <a href="<?= base_url('/admin/artikel'); ?>" class="btn btn-outline-secondary px-4">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>