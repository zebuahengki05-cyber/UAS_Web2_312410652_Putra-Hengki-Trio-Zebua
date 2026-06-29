const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

// 1. Buat Instance Axios (Penting agar Interceptor stabil)
const apiClient = axios.create({
    baseURL: 'http://localhost:8081' // Sesuaikan dengan URL backend-mu
});

// 2. Pasang Interceptor (Otomatis sisipkan token ke header)
apiClient.interceptors.request.use(
    config => {
        const token = localStorage.getItem('userToken');
        if (token) {
            config.headers.Authorization = 'Bearer ' + token;
        }
        return config;
    },
    error => Promise.reject(error)
);

// 3. Router
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/login', component: Login },
        { path: '/artikel', component: Artikel, meta: { requiresAuth: true } },
        { path: '/about', component: About, meta: { requiresAuth: true } }
    ]
});

// Guard untuk proteksi halaman
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';
    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        alert('Akses Ditolak! Silakan login terlebih dahulu.');
        next('/login');
    } else {
        next();
    }
});

const app = createApp({
    data() { return { isLoggedIn: false } },
    mounted() { this.checkAuth(); },
    methods: {
        checkAuth() { this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'; },
        logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('userToken');
                this.isLoggedIn = false;
                this.$router.push('/login');
            }
        }
    }
});

// Daftarkan apiClient ke global properties agar bisa dipanggil dengan 'this.$http'
app.config.globalProperties.$http = apiClient;
app.use(router);
app.mount('#app');