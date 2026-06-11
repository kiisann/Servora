<?php
require_once '../app/core/Logger.php';
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

        $userModel   = $this->model('User');
        $currentUser = $userModel->getById($id);

        // ── Proses upload foto profil ────────────────────────────────────────
        $fotoFilename = $currentUser['foto'] ?? null; // tetap pakai foto lama jika tidak upload baru

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file     = $_FILES['foto'];
            $maxSize  = 2 * 1024 * 1024; // 2 MB
            $allowed  = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowed)) {
                $_SESSION['error'] = 'Format foto tidak didukung. Gunakan JPG, PNG, atau WEBP.';
                header('Location: ' . BASE_URL . '/profile');
                exit;
            }

            if ($file['size'] > $maxSize) {
                $_SESSION['error'] = 'Ukuran foto maksimal 2 MB.';
                header('Location: ' . BASE_URL . '/profile');
                exit;
            }

            $ext          = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFilename  = 'user_' . $id . '_' . time() . '.' . strtolower($ext);
            $uploadDir    = __DIR__ . '/../../public/assets/images/foto_profil/';
            $uploadPath   = $uploadDir . $newFilename;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Hapus foto lama jika bukan default
                if (!empty($fotoFilename)) {
                    $oldPath = $uploadDir . $fotoFilename;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $fotoFilename = $newFilename;
            } else {
                $_SESSION['error'] = 'Gagal mengunggah foto. Coba lagi.';
                header('Location: ' . BASE_URL . '/profile');
                exit;
            }
        }

        $userData = [
            'nama'   => trim($_POST['nama']   ?? ''),
            'no_hp'  => trim($_POST['no_hp']  ?? ''),
            'kampus' => trim($_POST['kampus'] ?? ''),
            'bio'    => trim($_POST['bio']    ?? ''),
            'foto'   => $fotoFilename,
        ];

        if ($userModel->update($id, $userData)) {
            Logger::write($_SESSION['user_id'], $_SESSION['nama'], 'Memperbarui profil akun', 'info');
            // Perbarui session nama & foto jika berubah
            if (!empty($userData['nama'])) {
                $_SESSION['nama'] = $userData['nama'];
            }
            if (!empty($fotoFilename)) {
                $_SESSION['foto'] = $fotoFilename;
            }
            $_SESSION['success'] = 'Profil berhasil diperbarui!';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui profil, coba lagi.';
        }

        header('Location: ' . BASE_URL . '/profile');
        exit;
    }
}
