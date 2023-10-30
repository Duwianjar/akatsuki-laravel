// Mengambil elemen dengan id "profile" dan "informasi"
var profile = document.getElementById("profile");
var informasi = document.getElementById("edit-profil");

// Memastikan elemen-elemen ada sebelum memprosesnya
if (profile && informasi) {
    // Mengukur tinggi elemen "profile" dan "informasi"
    var profileHeight = profile.clientHeight;
    var informasiHeight = informasi.clientHeight;

    // Membandingkan tinggi kedua elemen
    if (profileHeight > informasiHeight) {
        // Jika "profile" lebih tinggi, atur tinggi "informasi" sama dengan "profile"
        informasi.style.height = profileHeight + "px";
    } else if (profileHeight < informasiHeight) {
        // Jika "informasi" lebih tinggi, atur tinggi "profile" sama dengan "informasi"
        profile.style.height = informasiHeight + "px";
    }
}

function addRowClass() {
    const addRowDiv = document.getElementById("add-row");
    var infor = document.getElementById("edit-profil");
    var infor2 = document.getElementById("edit-password");
    var infor3 = document.getElementById("edit-foto");
    if (window.innerWidth <= 991) {
        addRowDiv.classList.add("row");
        const profileDiv = document.getElementById("profile");
        profileDiv.classList.remove("col-md-4");
        profileDiv.classList.add("col-12");
        infor.classList.remove("col-md-8");
        infor.classList.add("col-md-12");
        infor2.classList.remove("col-md-8");
        infor2.classList.add("col-md-12");
        infor3.classList.remove("col-md-8");
        infor3.classList.add("col-md-12");
    } else {
        addRowDiv.classList.remove("row");
        const profileDiv = document.getElementById("profile");
        profileDiv.classList.add("col-md-4");
        profileDiv.classList.remove("col-12");
        infor.classList.add("col-md-8");
        infor.classList.remove("col-md-12");
        infor2.classList.add("col-md-8");
        infor2.classList.remove("col-md-12");
        infor3.classList.add("col-md-8");
        infor3.classList.remove("col-md-12");
    }
}

// Panggil fungsi addRowClass saat halaman dimuat ulang dan saat ukuran layar berubah
window.addEventListener("load", addRowClass);
window.addEventListener("resize", addRowClass);

function konfirmasiBatal() {
    var konfirmasi = confirm(
        "Data belum disimpan apakah anda yakin ingin kembali ?"
    );

    if (konfirmasi) {
        // Jika pengguna mengklik "OK", arahkan ke halaman profil
        window.location.href = "/profil";
    }
}
