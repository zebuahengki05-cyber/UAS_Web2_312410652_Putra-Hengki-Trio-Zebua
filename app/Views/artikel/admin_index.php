<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <div>
            <h2 class="fw-bold text-dark"><?= $title; ?></h2>
            <p class="text-muted small m-0">Manajemen data artikel menggunakan teknologi AJAX Search & Pagination.</p>
        </div>
        <a href="<?= base_url('admin/artikel/add') ?>" class="btn btn-success fw-bold">➕ Tambah Artikel</a>
    </div>

    <div class="card border-0 shadow-sm bg-white p-3 mb-4">
        <form id="search-form" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="q" id="search-box" value="<?= $q ?? ''; ?>" placeholder="🔍 Cari judul artikel..." class="form-control">
            </div>
            <div class="col-md-4">
                <select name="kategori_id" id="category-filter" class="form-select">
                    <option value="">📂 Semua Kategori</option>
                    <?php if(isset($kategori)): foreach ($kategori as $k): ?>
                        <option value="<?= $k['id_kategori']; ?>">
                            <?= $k['nama_kategori']; ?>
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary fw-bold">Cari Data</button>
            </div>
        </form>
    </div>

    <div class="card border-0 shadow-sm bg-white p-4">
        <div id="article-container" class="table-responsive">
            </div>
        <div id="pagination-container" class="d-flex justify-content-center mt-3">
            </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function fetchData(url) {
        $('#article-container').html('<div class="text-center py-4">🔄 Memuat data...</div>');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                // Mengambil data dari array 'artikel' dan 'pager'
                let listArtikel = res.artikel || [];
                let listPager = res.pager || '';

                // Render Tabel
                let html = '<table class="table table-striped table-hover align-middle">';
                html += '<thead class="table-dark"><tr><th>ID</th><th>Judul</th><th>Kategori</th><th class="text-center">Aksi</th></tr></thead><tbody>';
                
                if (listArtikel.length > 0) {
                    listArtikel.forEach(art => {
                        html += `<tr>
                            <td>${art.id}</td>
                            <td><div class="fw-bold">${art.judul}</div></td>
                            <td><span class="badge bg-secondary">${art.nama_kategori || 'Umum'}</span></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url('admin/artikel/edit') ?>/${art.id}">📝</a>
                                <a class="btn btn-sm btn-danger" href="<?= base_url('admin/artikel/delete') ?>/${art.id}" onclick="return confirm('Hapus?')">🗑️</a>
                            </td>
                        </tr>`;
                    });
                } else {
                    html += '<tr><td colspan="4" class="text-center">❌ Tidak ada data.</td></tr>';
                }
                html += '</tbody></table>';
                $('#article-container').html(html);
                $('#pagination-container').html(listPager);
            }
        });
    }

    // Trigger Load Data
    fetchData('<?= base_url('admin/artikel') ?>');

    // Event Pencarian
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        let query = $('#search-box').val();
        let cat = $('#category-filter').val();
        fetchData('<?= base_url('admin/artikel') ?>?q=' + query + '&kategori_id=' + cat);
    });

    // Event Pagination AJAX
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        fetchData($(this).attr('href'));
    });
});
</script>
<?= $this->endSection() ?>