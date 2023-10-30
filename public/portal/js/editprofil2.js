var informasi0 = document.getElementById("edit-profil");
var informasi1 = document.getElementById("edit-password");
var informasi2 = document.getElementById("edit-foto");

var links = document.querySelectorAll(".kelompok a");

window.addEventListener("hashchange", function () {
    var currentHash = window.location.hash.substr(1); // Menghapus karakter "#" dari hash
    var elemen = document.getElementById(currentHash);
    informasi0.classList.add("hide");
    informasi1.classList.add("hide");
    informasi2.classList.add("hide");
    elemen.classList.remove("hide");
    var elemen = document.getElementById(currentHash);
    // Menghapus kelas "info-active" dari semua elemen dengan kelas "info"
    var infoElements = document.querySelectorAll(".kelompok .btneditprof");
    infoElements.forEach(function (element) {
        element.classList.remove("btneditprof");
    });

    // Menambahkan kelas "info-active" pada elemen yang sesuai dengan hash yang aktif
    for (var i = 0; i < links.length; i++) {
        if (links[i].getAttribute("href").substr(1) === currentHash) {
            links[i].querySelector(".info").classList.add("btneditprof");
            history.replaceState(
                null,
                "",
                window.location.pathname + window.location.search
            );
        }
    }
});

if (window.location.href.indexOf("#edit-password") === -1) {
    window.location.href = "/profil/edit#edit-profil";
}
if (window.location.href.indexOf("#edit-password") !== -1) {
    const passwordLi = document.getElementById("password");
    if (passwordLi) {
        passwordLi.classList.add("btneditprof");
    }
    informasi0.classList.add("hide");
    window.location.href = "/profil/edit#edit-password";
    history.replaceState(
        null,
        "",
        window.location.pathname + window.location.search
    );
}
