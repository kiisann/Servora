function openEditPengguna(row) {
    const data = JSON.parse(row.dataset.user);
    
    const form = document.getElementById('editForm');
    if (form) {
        const actionTemplate = form.getAttribute('data-action-template');
        if (actionTemplate) {
            form.action = actionTemplate.replace('__ID__', data.id_user);
        }
    }
    
    const namaField = document.getElementById('edit_nama');
    const emailField = document.getElementById('edit_email');
    const roleField = document.getElementById('edit_role');
    const statusField = document.getElementById('edit_status');
    const noHpField = document.getElementById('edit_no_hp');
    const saldoField = document.getElementById('edit_saldo');
    const kampusField = document.getElementById('edit_kampus');
    const bioField = document.getElementById('edit_bio');

    if (namaField) namaField.value = data.nama || '';
    if (emailField) emailField.value = data.email || '';
    if (roleField) roleField.value = data.role || 'client';
    if (statusField) statusField.value = data.status || 'aktif';
    if (noHpField) noHpField.value = data.no_hp || '';
    if (saldoField) saldoField.value = data.saldo || 0;
    if (kampusField) kampusField.value = data.kampus || '';
    if (bioField) bioField.value = data.bio || '';
    
    // Show modal
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.style.display = 'flex';
    }
}

function closeEditPengguna() {
    const editModal = document.getElementById('editModal');
    if (!editModal) {
        console.warn('editModal not found - maybe it was removed from DOM.');
        return;
    }
    editModal.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditPengguna();
            }
        });
    }
});

function openEditJasa(row) {
    // 1. Ambil data satu per satu dari atribut data HTML
    const idJasa = row.dataset.id;
    const namaJasa = row.dataset.nama;
    const idKategori = row.dataset.kategori;
    const harga = row.dataset.harga;
    const status = row.dataset.status;
    const deskripsi = row.dataset.deskripsi;
    const gambarLama = row.dataset.gambar;
    
    // 2. Set action form
    const form = document.getElementById('editForm');
    if (form) {
        const actionTemplate = form.getAttribute('data-action-template');
        if (actionTemplate) {
            form.action = actionTemplate.replace('__ID__', idJasa);
        }
    }
    
    // 3. Isi value ke input modal
    const namaField = document.getElementById('edit_nama_jasa');
    const kategoriField = document.getElementById('edit_kategori');
    const hargaField = document.getElementById('edit_harga');
    const statusField = document.getElementById('edit_status');
    const deskripsiField = document.getElementById('edit_deskripsi');
    const gambarField = document.getElementById('edit_gambar_lama');

    if (namaField) namaField.value = namaJasa;
    if (kategoriField) kategoriField.value = idKategori;
    if (hargaField) hargaField.value = harga;
    if (statusField) statusField.value = status;
    if (deskripsiField) deskripsiField.value = deskripsi;
    if (gambarField) gambarField.value = gambarLama;
    
    // 4. Tampilkan modal
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.style.display = 'flex';
    }
}

function closeEditJasa() {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === this) {
                // panggil penutup yang sesuai halaman aktif
                if (typeof closeEditJasa === 'function' && document.getElementById('edit_nama_jasa')) {
                    closeEditJasa();
                } else if (typeof closeEditPengguna === 'function') {
                    closeEditPengguna();
                }
            }
        });
    }

    const createModal = document.getElementById('createUserModal');
    if (createModal) {
        createModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateUser();
            }
        });
    }
});

function openCreateUser() {
    const modal = document.getElementById('createUserModal');
    if (modal) {
        const form = document.getElementById('createForm');
        if (form) form.reset();
        modal.style.display = 'flex';
    }
}

function closeCreateUser() {
    const modal = document.getElementById('createUserModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function openCreateJasa() {
    const modal = document.getElementById('createJasaModal');
    if (modal) {
        const form = document.getElementById('createForm');
        if (form) form.reset();
        modal.style.display = 'flex';
    }
}

function closeCreateJasa() {
    const modal = document.getElementById('createJasaModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const createModal = document.getElementById('createJasaModal');
    if (createModal) {
        createModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateJasa();
            }
        });
    }
});
