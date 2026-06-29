# UAS_Web2_312410652_Putra-Hengki-Trio-Zebua
1. Pratikum 1: membuat program sederhana menggunakan Framework Codeigniter4.
   <img width="959" height="539" alt="Cuplikan layar 2026-06-26 222029" src="https://github.com/user-attachments/assets/b22d58cf-678c-41dd-af07-16ebf8a1257c" />
2. Pratikum 2: membuat aplikasi CRUD sederhana, dengan menyiapkan database server menggunakan MySQL.
   <img width="959" height="539" alt="Cuplikan layar 2026-06-26 233905" src="https://github.com/user-attachments/assets/3cfe0f63-43ec-4e43-90a7-9664e13b8c9b" />
3. Pratikum 3: Membuat template tampilan mengunakan konsep View Layout dan View Cell
   <img width="959" height="539" alt="Cuplikan layar 2026-06-27 123330" src="https://github.com/user-attachments/assets/42210dd9-d5ac-4524-8930-2faf37a39bb0" />
4. Pratikum 4: membuat modul Login,dengan menyiapkan database server menggunakan MySQL.
   <img width="512" height="425" alt="Cuplikan layar 2026-06-29 121121" src="https://github.com/user-attachments/assets/86f271eb-16b1-475c-b20a-5a1c4e32046e" />
5. Pratikum 5: membuat Paging dan Pencarian menggunakan Framework
   <img width="959" height="539" alt="Cuplikan layar 2026-06-27 204622" src="https://github.com/user-attachments/assets/c8f4241d-f54f-4d88-8ef0-d0c4d35a65cd" />
6. Pratikum 6: konsep relasi antar tabel dalam database.
   <img width="960" height="540" alt="Cuplikan layar 2026-06-27 204703" src="https://github.com/user-attachments/assets/7ebc4f7f-6a4b-4401-8c77-8b287b093eb5" />
   <img width="959" height="539" alt="Cuplikan layar 2026-06-27 204622" src="https://github.com/user-attachments/assets/47d8d6b3-cf7c-4e91-b231-d6d64397a8fb" />
7. Pratikum 7: membuat File Upload menggunakan Framework Codeigniter 4.
   <img width="960" height="540" alt="Cuplikan layar 2026-06-27 204703" src="https://github.com/user-attachments/assets/33e45fdb-fdcd-4729-8c3e-69f590ec012a" />
8. Pratikum 8 & 9: mengimplementasikan AJAX pada aplikasi web dengan CodeIgniter 4.
   <img width="959" height="539" alt="Cuplikan layar 2026-06-27 205714" src="https://github.com/user-attachments/assets/ded88df8-0253-4787-a14b-e6dbda355f57" />
9. Pratikum 10: Uji coba tembak Api
    <img width="960" height="540" alt="Cuplikan layar 2026-06-27 212707" src="https://github.com/user-attachments/assets/02670337-ee0c-40b2-b477-f5e6b71627b3" />
10. Pratikum 11: konsep dasar Framework VueJS.
    <img width="959" height="539" alt="Cuplikan layar 2026-06-28 194548" src="https://github.com/user-attachments/assets/9aadd004-dfd6-4a53-a1ca-aa54c256bd7b" />
11. Pratikum 12: meningkatkan struktur project sebelumnya dengan menambahkan pustaka Vue Router menggunakan CDN.
    <img width="959" height="539" alt="Cuplikan layar 2026-06-28 214751" src="https://github.com/user-attachments/assets/a4df09a6-e878-436d-b597-709bfa836ce0" />
    <img width="959" height="539" alt="Cuplikan layar 2026-06-28 215242" src="https://github.com/user-attachments/assets/57d22599-51a6-4423-854e-cb053b62a6cc" />
12. Pratikum 13: VueJS Autentikasi dan Navigation Guards (SPA Security)
    <img width="957" height="535" alt="image" src="https://github.com/user-attachments/assets/63e42361-9a64-4da6-9d11-d245e2f448cb" />
    <img width="957" height="536" alt="image" src="https://github.com/user-attachments/assets/432f2646-e607-44d8-81c3-326e953dfd80" />
13. Pratikum 14: Keamanan API, Autentikasi Token, dan Axios Interceptors
    <img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/f6cb11d6-2ba3-49bc-8f05-da00f568a1b3" />

  Dokumentasi Praktikum Pemrograman Web (Pertemuan 1 - 14) Repositori ini berisi kumpulan tugas dan implementasi dari Praktikum Pemrograman Web (Pertemuan 1 hingga 14). Proyek ini dibangun menggunakan framework CodeIgniter 4 (CI4) untuk sisi backend (termasuk RESTful API) dan Vue.js (secara standalone) untuk integrasi frontend.

🚀 Teknologi yang Digunakan Backend: PHP, CodeIgniter 4 Frontend: HTML, CSS, JavaScript, Vue.js Database: MySQL Tools: Composer, Spark (CI4 CLI) 📚 Ringkasan Progres Praktikum Berikut adalah penjelasan tahapan pengembangan sistem dari awal hingga akhir praktikum:                            

Praktikum 1 - 3: Setup & Instalasi Dasar Pengenalan dan instalasi framework CodeIgniter 4 menggunakan Composer. Pemahaman struktur direktori CI4 (seperti app/, public/, writable/). Konfigurasi awal sistem pada file .env dan app/Config/Paths.php untuk environment development. Menjalankan local development server menggunakan perintah php spark serve.                                                      
Praktikum 4 - 5: Konsep MVC (Model-View-Controller) Dasar Pengenalan konsep Routing (app/Config/Routes.php) untuk memetakan URL ke fungsi tertentu. Pembuatan Controller dasar (Home.php, Artikel.php) untuk mengatur alur logika aplikasi. Pembuatan Views (welcome_message.php, layout dasar) untuk menampilkan antarmuka web kepada pengguna.      
Praktikum 6 - 7: Database, Migrations, dan Models Konfigurasi koneksi database MySQL di file .env. Penggunaan CI4 Migrations untuk version control database. Membuat tabel user (2026-06-22-000003_CreateUserTable.php). Membuat tabel kategori (2026-06-22-000001_CreateKategoriTable.php). Memperbarui struktur tabel artikel (2026-06-22-000002_UpdateArtikelForKategoriAndUpload.php). Penggunaan Seeders (PraktikumSeeder.php) untuk mengisi data awal (dummy data) ke dalam database. Pembuatan Models (ArtikelModel.php, UserModel.php, KategoriModel.php) untuk berinteraksi dengan tabel-tabel di database.                                                  
Praktikum 8 - 9: Operasi CRUD (Create, Read, Update, Delete) Implementasi antarmuka halaman admin untuk mengelola artikel. Pembuatan form tambah artikel (form_add.php) dan edit artikel (form_edit.php). Validasi input pengguna dan penanganan proses upload file/gambar untuk artikel. Menampilkan data secara dinamis dari database ke halaman detail artikel (detail.php) dan halaman index (admin_index.php).                                                  
Praktikum 10 - 11: Sistem Autentikasi (Login) Pembuatan sistem autentikasi sederhana menggunakan sistem Session bawaan CodeIgniter. Pembuatan halaman login (login.php) dan controller User.php. Membatasi akses halaman admin agar hanya bisa diakses oleh user yang sudah berhasil login (Proteksi Route).                      
Praktikum 12: Implementasi AJAX Request Pengenalan konsep Asynchronous JavaScript and XML (AJAX). Pembuatan controller khusus AjaxController.php untuk merespons request AJAX. Membangun view (ajax/index.php) yang dapat memuat data secara dinamis tanpa melakukan reload halaman utuh.                                
Praktikum 13: Pembuatan RESTful API & Token Auth Mengekspos data artikel agar bisa dikonsumsi oleh aplikasi eksternal (Frontend/Mobile). Pembuatan API endpoint pada Api/Auth.php. Implementasi keamanan API berbasis Token/JWT menggunakan Filter ApiAuthFilter.php untuk memastikan hanya permintaan terautentikasi yang diizinkan mengambil atau mengubah data.                                                                        
Praktikum 14: Integrasi Frontend dengan Vue.js Memisahkan frontend dari backend (konsep Headless / API-driven). Pembuatan antarmuka pengguna interaktif menggunakan Vue.js (berada di folder lab8_vuejs/). Membangun Single Page Application (SPA) dengan komponen fungsional seperti: Home.js: Halaman utama. Artikel.js: Komponen untuk fetch dan menampilkan data artikel dari API CI4. Login.js: Komponen antarmuka login yang terhubung ke sistem token CI4. About.js: Halaman profil/informasi.                        


 

 


   
   
   




