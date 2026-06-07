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

    // Search Pengguna
    const searchPengguna = document.getElementById('searchPengguna');
    if (searchPengguna) {
        searchPengguna.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('tbody tr');
            let foundAny = false;
            
            rows.forEach(row => {
                if (row.classList.contains('no-results-row') || row.querySelector('td[colspan]')) {
                    if (row.classList.contains('no-results-row')) return;
                    if (row.textContent.includes('Belum ada')) return; // ignore empty placeholders
                }
                
                const userAttr = row.getAttribute('data-user');
                let match = false;
                
                if (userAttr) {
                    try {
                        const user = JSON.parse(userAttr);
                        const nama = (user.nama || '').toLowerCase();
                        const email = (user.email || '').toLowerCase();
                        const role = (user.role || '').toLowerCase();
                        const kampus = (user.kampus || '').toLowerCase();
                        const status = (user.status || '').toLowerCase();
                        
                        match = nama.includes(query) || 
                                email.includes(query) || 
                                role.includes(query) || 
                                kampus.includes(query) || 
                                status.includes(query);
                    } catch (e) {
                        match = row.textContent.toLowerCase().includes(query);
                    }
                } else {
                    match = row.textContent.toLowerCase().includes(query);
                }
                
                row.style.display = match ? '' : 'none';
                if (match) foundAny = true;
            });
            
            let noResultsRow = document.querySelector('.no-results-row');
            if (!foundAny) {
                if (!noResultsRow) {
                    const tbody = document.querySelector('tbody');
                    if (tbody) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.className = 'no-results-row';
                        noResultsRow.innerHTML = `<td colspan="7" style="padding:40px;text-align:center;color:#94a3b8;">
                            <div style="font-size:24px;margin-bottom:8px;">🔍</div>
                            Tidak ada pengguna yang cocok dengan pencarian.
                        </td>`;
                        tbody.appendChild(noResultsRow);
                    }
                } else {
                    noResultsRow.style.display = '';
                }
            } else if (noResultsRow) {
                noResultsRow.style.display = 'none';
            }
        });
    }

    // Search Jasa
    const searchJasa = document.getElementById('searchJasa');
    if (searchJasa) {
        searchJasa.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('tbody tr');
            let foundAny = false;
            
            rows.forEach(row => {
                if (row.classList.contains('no-results-row') || row.querySelector('td[colspan]')) {
                    if (row.classList.contains('no-results-row')) return;
                    if (row.textContent.includes('Belum ada')) return; // ignore empty placeholders
                }
                
                const nama = (row.dataset.nama || '').toLowerCase();
                const freelancer = (row.dataset.freelancer || '').toLowerCase();
                const kategori = (row.dataset.namaKategori || '').toLowerCase();
                const status = (row.dataset.status || '').toLowerCase();
                
                const match = nama.includes(query) || 
                              freelancer.includes(query) || 
                              kategori.includes(query) || 
                              status.includes(query);
                              
                row.style.display = match ? '' : 'none';
                if (match) foundAny = true;
            });
            
            let noResultsRow = document.querySelector('.no-results-row');
            if (!foundAny) {
                if (!noResultsRow) {
                    const tbody = document.querySelector('tbody');
                    if (tbody) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.className = 'no-results-row';
                        noResultsRow.innerHTML = `<td colspan="6" style="padding:40px;text-align:center;color:#94a3b8;">
                            <div style="font-size:24px;margin-bottom:8px;">🔍</div>
                            Tidak ada jasa yang cocok dengan pencarian.
                        </td>`;
                        tbody.appendChild(noResultsRow);
                    }
                } else {
                    noResultsRow.style.display = '';
                }
            } else if (noResultsRow) {
                noResultsRow.style.display = 'none';
            }
        });
    }

    const detailModal = document.getElementById('detailModal');
    if (detailModal) {
        detailModal.addEventListener('click', e => { 
            if (e.target === e.currentTarget) closeDetail(); 
        });
    }
});

// Kelola Pesanan
let activeTab = 'semua';

function setTab(btn, tab) {
    activeTab = tab;
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#ordersBody tr[data-status]').forEach(row => {
        const show = activeTab === 'semua' || row.dataset.status === activeTab;
        row.style.display = show ? '' : 'none';
    });
}

function openDetail(row) {
    const data = JSON.parse(row.dataset.pesanan);
    document.getElementById('modalTitle').textContent = 'Detail Pesanan #' + data.id_pesanan;
    const statusMap = {pending:'Menunggu',diproses:'Berlangsung',selesai:'Selesai',dibatalkan:'Dibatalkan'};
    document.getElementById('modalContent').innerHTML = `
        <table style="width:100%;font-size:14px;border-collapse:collapse;">
            <tr><td style="padding:8px 0;color:#64748b;width:40%;">Jasa</td><td style="padding:8px 0;font-weight:600;">${data.nama_jasa}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Client</td><td style="padding:8px 0;">${data.nama_client||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Freelancer</td><td style="padding:8px 0;">${data.nama_freelancer||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Tanggal</td><td style="padding:8px 0;">${data.created_at||'-'}</td></tr>
            <tr><td style="padding:8px 0;color:#64748b;">Status</td><td style="padding:8px 0;font-weight:600;">${statusMap[data.status]||data.status}</td></tr>
        </table>`;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetail() { 
    const modal = document.getElementById('detailModal');
    if (modal) modal.style.display = 'none'; 
}
