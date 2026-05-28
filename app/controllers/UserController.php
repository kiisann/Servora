<?php
class UserController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Hanya admin yang boleh akses halaman kelola pengguna
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $userModel         = $this->model('User');
        $data['pengguna']  = $userModel->getAll();
        $data['role']      = $_SESSION['role'];
        $data['nama']      = $_SESSION['nama'];

        $this->view('admin/kelola_pengguna', $data);
    }

    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');

            $userData = [
                'nama'   => $_POST['nama']   ?? '',
                'no_hp'  => $_POST['no_hp']  ?? '',
                'kampus' => $_POST['kampus'] ?? '',
                'bio'    => $_POST['bio']    ?? '',
                'foto'   => null, // implementasi upload nanti
            ];

            if ($userModel->update($id, $userData)) {
                header('Location: ' . BASE_URL . '/user');
                exit;
            }
        }

        header('Location: ' . BASE_URL . '/user');
        exit;
    }

    public function delete($id){
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $userModel = $this->model('User');
        if ($userModel->delete($id)) {
            header('Location: ' . BASE_URL . '/user');
            exit;
        }
        header('Location: ' . BASE_URL . '/user');
        exit;
    }

    public function updateAdmin($id) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userModel = $this->model('User');
        $userData = [
            'nama'   => $_POST['nama'] ?? '',
            'email'  => $_POST['email'] ?? '',
            'role'   => $_POST['role'] ?? 'client',
            'status' => $_POST['status'] ?? 'aktif',
            'no_hp'  => $_POST['no_hp'] ?? '',
            'kampus' => $_POST['kampus'] ?? '',
            'bio'    => $_POST['bio'] ?? '',
            'saldo'  => (double)($_POST['saldo'] ?? 0.00)
        ];
        if ($userModel->updateByAdmin($id, $userData)) {
            $_SESSION['success'] = 'Data pengguna berhasil diperbarui!';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui data pengguna.';
        }
    }
    header('Location: ' . BASE_URL . '/user');
    exit;
    }
}
