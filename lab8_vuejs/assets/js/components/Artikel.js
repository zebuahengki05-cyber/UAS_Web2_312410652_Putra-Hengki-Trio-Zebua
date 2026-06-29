const Artikel = {
    template: `
    <div class="card">
        <div v-if="!isEdit">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4">Manajemen Data Artikel</h2>
            </div>
            
            <div style="text-align: left; margin-bottom: 15px;">
                <button class="btn-tambah" @click="tambah" style="background-color: #28a745; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                    + Tambah Artikel
                </button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in artikel" :key="row.id">
                        <td>{{ row.id }}</td>
                        <td>{{ row.judul }}</td>
                        <td>
                            <span :class="row.status == 1 ? 'badge-publish' : 'badge-draft'">
                                {{ row.status == 1 ? 'Publish' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="action-link edit-link" @click.prevent="edit(row)">Edit</a>
                            <a href="#" class="action-link hapus-link" @click.prevent="hapus(index, row.id)">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-else>
            <h3 class="mb-4">{{ form.id ? 'Edit Artikel: ' + form.judul : 'Tambah Artikel Baru' }}</h3>
            <form @submit.prevent="saveData">
                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input type="text" v-model="form.judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select v-model="form.status" class="form-control">
                        <option value="1">Publish</option>
                        <option value="0">Draft</option>
                    </select>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn-simpan">Simpan</button>
                    <button type="button" @click="isEdit = false" class="btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>
    `,
    data() {
        return {
            artikel: [],
            isEdit: false,
            form: { id: null, judul: '', status: 0 }
        };
    },
    methods: {
        fetchArtikel() {
    // Kita panggil langsung ke path yang terdaftar di routes
    this.$http.get('artikel/get_data_api') 
        .then(response => {
            console.log("Berhasil:", response.data);
            this.artikel = response.data.artikel;
        })
        .catch(error => {
            // Cek apakah server mengirim HTML (biasanya error server)
            console.error("Error Status:", error.response.status);
            console.error("Error Data:", error.response.data);
        });
},
        tambah() {
            this.form = { id: null, judul: '', status: 0 };
            this.isEdit = true;
        },
        edit(row) {
            this.form = { ...row, status: parseInt(row.status) };
            this.isEdit = true;
        },
        saveData() {
            const url = this.form.id 
                ? 'http://localhost:8081/artikel/update_data_api/' + this.form.id 
                : 'http://localhost:8081/artikel/tambah_data_api'; // Sesuaikan dengan route API tambahmu
            
            this.$http.post(url, this.form, { headers: { 'Content-Type': 'application/json' } })
                .then(response => {
                    this.isEdit = false;
                    this.fetchArtikel();
                })
                .catch(error => { alert("Gagal menyimpan data!"); });
        },
        hapus(index, id) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                axios.get('http://localhost:8081/artikel/delete_data_api/' + id)
                    .then(response => { this.artikel.splice(index, 1); })
                    .catch(e => alert("Gagal menghapus data"));
            }
        }
    },
    mounted() {
        this.fetchArtikel();
    }
};