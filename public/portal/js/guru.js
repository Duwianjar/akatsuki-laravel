// Mengambil elemen dengan id "profile" dan "informasi"
var profile = document.getElementById("profile");
var informasi0 = document.getElementById("jadwal-mengajar");
var informasi1 = document.getElementById("mengajar-praktek");
var informasi2 = document.getElementById("jaga-uts-uas");

// Memastikan elemen-elemen ada sebelum memprosesnya
if (profile && informasi0) {
    // Mengukur tinggi elemen "profile" dan "informasi"
    var profileHeight = profile.clientHeight;
    var informasiHeight = informasi0.clientHeight;

    // Membandingkan tinggi kedua elemen
    if (profileHeight > informasiHeight) {
        // Jika "profile" lebih tinggi, atur tinggi "informasi" sama dengan "profile"
        informasi0.style.height = profileHeight + "px";
        informasi1.style.height = profileHeight + "px";
        informasi2.style.height = profileHeight + "px";
    } else if (profileHeight < informasiHeight) {
        // Jika "informasi" lebih tinggi, atur tinggi "profile" sama dengan "informasi"
        profile.style.height = informasiHeight + "px";
    }
}

var links = document.querySelectorAll(".kelompok a");

// Mendeteksi perubahan hash dalam URL
window.addEventListener("hashchange", function () {
    var currentHash = window.location.hash.substr(1); // Menghapus karakter "#" dari hash
    var elemen = document.getElementById(currentHash);
    informasi0.classList.add("hide");
    informasi1.classList.add("hide");
    informasi2.classList.add("hide");
    elemen.classList.remove("hide");
    // Menghapus kelas "info-active" dari semua elemen dengan kelas "info"
    var infoElements = document.querySelectorAll(".kelompok .info-active");
    infoElements.forEach(function (element) {
        element.classList.remove("info-active");
    });

    // Menambahkan kelas "info-active" pada elemen yang sesuai dengan hash yang aktif
    for (var i = 0; i < links.length; i++) {
        if (links[i].getAttribute("href").substr(1) === currentHash) {
            links[i].querySelector(".info").classList.add("info-active");
            history.replaceState(
                null,
                "",
                window.location.pathname + window.location.search
            );
        }
    }
});

function addRowClass() {
    const addRowDiv = document.getElementById("add-row");
    var infor = [
        document.getElementById("jadwal-mengajar"),
        document.getElementById("mengajar-praktek"),
        document.getElementById("aga-uts-uas"),
    ];
    if (window.innerWidth <= 991) {
        addRowDiv.classList.add("row");
        const profileDiv = document.getElementById("profile");
        profileDiv.classList.remove("col-md-4");
        profileDiv.classList.add("col-12");
        for (var i = 0; i < infor.length; i++) {
            var element = infor[i];
            element.classList.remove("col-md-8");
            element.classList.add("col-md-12");
        }
    } else {
        addRowDiv.classList.remove("row");
        const profileDiv = document.getElementById("profile");
        profileDiv.classList.add("col-md-4");
        profileDiv.classList.remove("col-12");
        for (var i = 0; i < infor.length; i++) {
            var element = infor[i];
            element.classList.add("col-md-8");
            element.classList.remove("col-md-12");
        }
    }
}

// Panggil fungsi addRowClass saat halaman dimuat ulang dan saat ukuran layar berubah
window.addEventListener("load", addRowClass);
window.addEventListener("resize", addRowClass);

window.location.href = "/profil#jadwal-mengajar";
