document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen DOM Global ---
    const header = document.querySelector('header');
    const logonav = document.getElementById('logo-nav'); // pastikan ID ini ada di HTML
    const listnav = document.querySelector('.navbar-list'); // sesuaikan selector dengan struktur HTML-mu

    // --- Section Elements ---
    const sectionMakeSure = document.getElementById('section-makesure');
    const sectionForm = document.getElementById('section-form');
    const sections = {
        bio0: document.getElementById('section-form-bio-0'),
        bio1: document.getElementById('section-form-bio-1'),
        pesan0: document.getElementById('section-form-pemesanan-0'),
        pesan1: document.getElementById('section-form-pemesanan-1'),
        pesan2: document.getElementById('section-form-pemesanan-2'),
        pesan3: document.getElementById('section-form-pemesanan-3')
    };

    // --- Button Elements ---
    const buttons = {
        pesan: document.getElementById('btn-pesan'),
        next: {
            bio0: document.getElementById('btn-selanjutnya-1'),
            bio1: document.getElementById('btn-selanjutnya-2'),
            pesan0: document.getElementById('btn-selanjutnya-3'),
            pesan1: document.getElementById('btn-selanjutnya-4'),
            pesan2: document.getElementById('btn-selanjutnya-5')
        },
        back: {
            makeSure: document.getElementById('btn-back-0'),
            bio1: document.getElementById('btn-back-1'),
            pesan0: document.getElementById('btn-back-2'),
            pesan1: document.getElementById('btn-back-3'),
            pesan2: document.getElementById('btn-back-4'),
            pesan3: document.getElementById('btn-back-5')
        }
    };

    // --- Input Fields ---
    const inputs = {
        // Section 1
        nama: document.getElementById('nama'),
        wa: document.getElementById('wa'),
        ig: document.getElementById('instagram'),
        // Section 2
        rekening: document.getElementById('norek'),
        bank: document.getElementById('bank'),
        // Section 3
        tanggal: document.getElementById('tanggal_booking'),
        jam: document.getElementById('jam_booking'),
        orang: document.getElementById('total_orang')
    };

    // --- Helper: Tampilkan SweetAlert error ---
    function showError(message) {
        Swal.fire({
            icon: 'warning',
            title: 'Form Belum Lengkap',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    // --- Helper: Sembunyikan semua section form ---
    function hideAllSections() {
        Object.values(sections).forEach(section => section.classList.add('hidden'));
    }

    // --- Navigasi: ke section tertentu ---
    function showSection(sectionKey) {
        hideAllSections();
        sections[sectionKey].classList.remove('hidden');
    }

    // --- Event: Mulai pemesanan dari section "makesure" ---
    buttons.pesan?.addEventListener('click', () => {
        if (header) header.style.backgroundColor = '#2c4257cb';
        if (logonav) logonav.style.width = '30px';
        if (listnav) {
            listnav.style.alignItems = 'center';
            listnav.style.margin = '15px';
        }
        sectionMakeSure.style.display = 'none';
        sectionForm.classList.remove('hidden');
        showSection('bio0');
        window.headerStatus = true;
    });

    // --- Validasi & Navigasi Maju ---
    buttons.next.bio0?.addEventListener('click', () => {
        const { nama, wa, ig } = inputs;
        if (!nama.value.trim() || !wa.value.trim() || !ig.value.trim()) {
            return showError('Harap lengkapi nama, WhatsApp, dan Instagram.');
        }
        if (wa.value.length < 10) {
            return showError('Nomor WhatsApp minimal 10 digit.');
        }
        if (ig.value.startsWith('@')) {
            return showError('Jangan gunakan tanda "@" di awal username Instagram.');
        }
        showSection('bio1');
    });

    buttons.next.bio1?.addEventListener('click', () => {
        const { rekening, bank } = inputs;
        if (!rekening.value.trim() || !bank.value.trim()) {
            return showError('Harap lengkapi nomor rekening dan nama bank.');
        }
        showSection('pesan0');
    });

    buttons.next.pesan0?.addEventListener('click', () => {
        const { tanggal, jam, orang } = inputs;
        if (!tanggal.value || !jam.value || !orang.value) {
            return showError('Harap lengkapi tanggal, jam, dan jumlah orang.');
        }
        if (parseInt(orang.value) <= 0) {
            return showError('Jumlah orang harus lebih dari 0.');
        }
        showSection('pesan1');
    });

    buttons.next.pesan1?.addEventListener('click', () => {
        showSection('pesan2');
    });

    buttons.next.pesan2?.addEventListener('click', () => {
        showSection('pesan3');
    });

    // --- Navigasi Mundur ---
    buttons.back.makeSure?.addEventListener('click', () => {
        if (header) header.style.backgroundColor = 'transparent';
        if (logonav) logonav.style.width = '60px';
        if (listnav) {
            listnav.style.margin = '20px';
            listnav.style.alignItems = 'normal';
        }
        sectionMakeSure.style.display = 'flex';
        sectionForm.classList.add('hidden');
    });

    buttons.back.bio1?.addEventListener('click', () => showSection('bio0'));
    buttons.back.pesan0?.addEventListener('click', () => showSection('bio1'));
    buttons.back.pesan1?.addEventListener('click', () => showSection('pesan0'));
    buttons.back.pesan2?.addEventListener('click', () => showSection('pesan1'));
    buttons.back.pesan3?.addEventListener('click', () => showSection('pesan2'));
});

// --- Modal Functions ---
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'block';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'none';
}

// --- Tutup modal saat klik di luar konten ---
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal(modal.id);
        }
    });
});