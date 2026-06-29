const Logout = {
    template: `<div>Sedang proses logout...</div>`,
    created() {
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('userToken');
        // Arahkan ke login setelah selesai
        this.$router.push('/login');
    }
};