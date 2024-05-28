// JS untuk responsive navbar

const icon = document.querySelector('.icon');
const ul = document.querySelector('nav ul');

icon.addEventListener('click', () => {
    ul.classList.toggle('show');
});

// Temukan tombol "Sewa Lapangan"
const dropdownButton = document.querySelector('.dropdown > a');

// Temukan sub-menu yang terkait dengannya
const dropdownContent = document.querySelector('.dropdown-content');

// Tambahkan event listener untuk menampilkan sub-menu saat tombol di klik
dropdownButton.addEventListener('click', function (event) {
    event.preventDefault(); // Hindari navigasi ke halaman baru jika link adalah anchor
    dropdownContent.classList.toggle('show'); // Toggle tampilan sub-menu
});

// Sembunyikan sub-menu saat klik di luar sub-menu
window.addEventListener('click', function (event) {
    if (!event.target.matches('.dropdown > a')) {
        dropdownContent.classList.remove('show');
    }
});


// JS untuk pop up login dan register
function showPopup(popupId) {
    event.preventDefault();
    const popup = document.getElementById(popupId);
    popup.style.display = "block";
}

function hidePopup(popupId) {
    const popup = document.getElementById(popupId);
    popup.style.display = "none";
}

