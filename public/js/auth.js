document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Proses login di sini (misalnya, kirim data ke server)
        // ...

        // Redirect ke halaman setelah login
        window.location.href = "dashboard.html";
    });
});
