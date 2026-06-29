<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <div>
            <h2 class="fw-bold text-dark">Data Artikel (Teknik AJAX)</h2>
            <p class="text-muted small m-0">Menampilkan dan mengelola data langsung dari server tanpa reload halaman.</p>
        </div>
        <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#tambahModal">
            ➕ Tambah Artikel AJAX
        </button>
    </div>

    <div class="card border-0 shadow-sm bg-white p-4">
        <table class="table table-striped table-hover align-middle" id="artikelTable">
            <thead class="table-dark">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Judul Artikel</th>
                    <th>Status</th>
                    <th style="width: 200px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="tambahModalLabel">Tambah Artikel Baru (AJAX)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahArtikel">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Artikel</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul artikel..." required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Artikel</label>
                        <textarea class="form-control" id="isi" name="isi" rows="4" placeholder="Tuliskan isi artikel lengkap..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-close="modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    // 1. Fungsi menampilkan indikator loading
    function showLoadingMessage() {
        $('#artikelTable tbody').html('<tr><td colspan="4" class="text-center text-muted py-3">🔄 Sedang mengambil data dari server...</td></tr>');
    }

    // 2. Fungsi Ambil/Load Data Artikel (AJAX GET)
    function loadData() {
        showLoadingMessage();
        
        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var tableBody = "";
                
                if (data.length === 0) {
                    tableBody = '<tr><td colspan="4" class="text-center text-muted">Data artikel kosong.</td></tr>';
                } else {
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td class="fw-medium text-dark">' + row.judul + '</td>';
                        tableBody += '<td><span class="badge bg-success">Aktif</span></td>';
                        tableBody += '<td class="text-center">';
                        tableBody += '<a href="<?= base_url('admin/artikel/edit/') ?>/' + row.id + '" class="btn btn-primary btn-sm me-2">📝 Edit</a>';
                        tableBody += '<a href="#" class="btn btn-danger btn-sm btn-delete" data-id="' + row.id + '">🗑️ Delete</a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                }
                $('#artikelTable tbody').html(tableBody);
            },
            error: function() {
                $('#artikelTable tbody').html('<tr><td colspan="4" class="text-center text-danger">⚠️ Gagal memuat data dari server!</td></tr>');
            }
        });
    }

    // Jalankan load data pertama kali saat halaman dibuka
    loadData();

    // 3. Logika Submit Form Tambah Data (AJAX POST) tanpa reload
    $('#formTambahArtikel').on('submit', function(e) {
        e.preventDefault(); // Menahan form agar tidak refresh halaman halaman bawaan browser
        
        $.ajax({
            url: "<?= base_url('ajax/insert') ?>",
            method: "POST",
            data: $(this).serialize(), // Mengubah inputan form menjadi data string siap kirim
            dataType: "json",
            success: function(response) {
                if (response.status === 'OK') {
                    alert(response.message);
                    
                    // Sembunyikan pop-up modal dan reset isi form inputan
                    $('#tambahModal').modal('hide');
                    $('#formTambahArtikel')[0].reset();
                    
                    // Ambil data terbaru langsung biar langsung muncul di tabel
                    loadData();
                }
            },
            error: function() {
                alert('Gagal menambah artikel baru!');
            }
        });
    });

    // 4. Logika Aksi Tombol Hapus (AJAX DELETE)
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (confirm('Apakah Anda yakin ingin menghapus artikel ID ' + id + ' ini?')) {
            $.ajax({
                url: "<?= base_url('ajax/delete') ?>/" + id,
                method: "DELETE",
                success: function(response) {
                    if(response.status === 'OK') {
                        alert(response.message);
                        loadData();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Gagal menghapus data: ' + textStatus);
                }
            });
        }
    });
});
</script>
<?= $this->endSection() ?>