const Login = {
    template: `
    <div class="login-page-container">
        <div class="login-card">
            <h2>Form Login Admin</h2>
            <form @submit.prevent="handleLogin">
                <div class="input-group">
                    <label>Username / Email</label>
                    <input type="text" v-model="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" v-model="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">Masuk Aplikasi</button>
            </form>
            <p v-if="errorMessage" style="color:red; margin-top:15px; text-align:center;">
                {{ errorMessage }}
            </p>
        </div>
    </div>
    `,
    data() {
        return {
            username: '',
            password: '',
            errorMessage: ''
        }
    },
    methods: {
        handleLogin() {
            const loginUrl = 'http://localhost:8081/api/login'; 
            axios.post(loginUrl, {
                username: this.username,
                password: this.password
            })
            .then(response => {
                const res = response.data;
                if (res.status === 200 && res.data && res.data.token) {
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('userToken', res.data.token);
                    this.$root.isLoggedIn = true;
                    this.$router.push('/artikel');
                } else {
                    this.errorMessage = res.message || 'Login gagal, periksa kembali kredensial.';
                }
            })
            .catch(error => {
                this.errorMessage = error.response?.data?.message || 'Gagal terhubung ke server.';
            });
        }
    }
};