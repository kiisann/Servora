function openEdit(row) {
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

function closeEdit() {
    const editModal = document.getElementById('editModal');
    if (!editModal) {
        console.warn('editModal not found - maybe it was removed from DOM.');
        return;
    }
    editModal.style.display = 'none';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if(modal) modal.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEdit();
            }
        });
    }
});
