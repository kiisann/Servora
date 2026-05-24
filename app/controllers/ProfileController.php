<?php
class ProfileController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userModel    = $this->model('User');
        $data['user'] = $userModel->getById($_SESSION['user_id']);
        $data['role'] = $_SESSION['role'];
        $data['nama'] = $_SESSION['nama'];

        $this->view('profile/index', $data);
    }

    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Pastikan user hanya bisa edit profil milik sendiri
        if ((int)$id !== (int)$_SESSION['user_id']) {
            header('Location: ' . BASE_URL . '/profile');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/profile');
            exit;
        }

        $userModel = $this->model('User');

        $userData = [
            'nama'   => trim($_POST['nama']   ?? ''),
            'no_hp'  => trim($_POST['no_hp']  ?? ''),
            'kampus' => trim($_POST['kampus'] ?? ''),
            'bio'    => trim($_POST['bio']    ?? ''),
            'foto'   => null, // implementasi upload nanti
        ];

        if ($userModel->update($id, $userData)) {
            // Perbarui session nama jika berubah
            if (!empty($userData['nama'])) {
                $_SESSION['nama'] = $userData['nama'];
            }
            $_SESSION['success'] = 'Profil berhasil diperbarui!';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui profil, coba lagi.';
        }

        header('Location: ' . BASE_URL . '/profile');
        exit;
    }
}
