let passwordInput = document.getElementById("password-lama-input");
let passwordInput2 = document.getElementById("password-baru-input");
let passwordInput3 = document.getElementById("password-konfigurasi-input");
let eyeIcon = document.getElementById("eye-icon");
let eyeIcon2 = document.getElementById("eye-icon2");
let eyeIcon3 = document.getElementById("eye-icon3");

function togglePasswordVisibility() {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}

function togglePasswordbaruVisibility() {
    if (passwordInput2.type === "password") {
        passwordInput2.type = "text";
        eyeIcon2.classList.remove("fa-eye");
        eyeIcon2.classList.add("fa-eye-slash");
    } else {
        passwordInput2.type = "password";
        eyeIcon2.classList.remove("fa-eye-slash");
        eyeIcon2.classList.add("fa-eye");
    }
}

function togglePasswordkonfigurasiVisibility() {
    if (passwordInput3.type === "password") {
        passwordInput3.type = "text";
        eyeIcon3.classList.remove("fa-eye");
        eyeIcon3.classList.add("fa-eye-slash");
    } else {
        passwordInput3.type = "password";
        eyeIcon3.classList.remove("fa-eye-slash");
        eyeIcon3.classList.add("fa-eye");
    }
}
