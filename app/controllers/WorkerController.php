<?php
require_once '../app/core/Logger.php';
class WorkerController extends Controller {
    private function uploadGambarJasa(string $redirectUrl, ?string $currentImage = null): ?string {
        if (empty($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
            return $currentImage;
        }

        if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = 'Gagal mengupload gambar jasa.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
            $_SESSION['error'] = 'Ukuran gambar maksimal 2MB.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        $tmpPath = $_FILES['gambar']['tmp_name'];
        $mime = mime_content_type($tmpPath);
        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];

        if (!isset($allowedTypes[$mime])) {
            $_SESSION['error'] = 'Format gambar harus JPG, PNG, atau WebP.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        $uploadDir = dirname(__DIR__, 2) . '/public/assets/images/upload';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $fileName = 'jasa-' . $_SESSION['user_id'] . '-' . bin2hex(random_bytes(8)) . '.' . $allowedTypes[$mime];
        $targetPath = $uploadDir . '/' . $fileName;

        if (!move_uploaded_file($tmpPath, $targetPath)) {
            $_SESSION['error'] = 'Gagal menyimpan gambar jasa.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        return 'assets/images/upload/' . $fileName;
    }

    public function jasa() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SESSION['role'] !== 'freelancer') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $jasaModel    = $this->model('Jasa');
        $data['jasa'] = $jasaModel->getByUser($_SESSION['user_id']);
        $data['role'] = $_SESSION['role'];
        $data['nama'] = $_SESSION['nama'];

        $this->view('worker/kelola_jasa', $data);
    }

    public function detailJasa($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SESSION['role'] !== 'freelancer') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $jasaModel = $this->model('Jasa');
        $reviewModel = $this->model('Review');
        $jasa = $jasaModel->getById($id);

        if (!$jasa || (int)$jasa['id_user'] !== (int)$_SESSION['user_id']) {
            $_SESSION['error'] = 'Jasa tidak ditemukan atau bukan milik Anda.';
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        $data['jasa_item'] = $jasa;
        $data['reviews'] = $reviewModel->getByJasa($id);
        $data['review_summary'] = $reviewModel->getSummaryByJasa($id);
        $data['role'] = $_SESSION['role'];
        $data['nama'] = $_SESSION['nama'];

        $this->view('worker/detail_jasa', $data);
    }

    public function tambah() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SESSION['role'] !== 'freelancer') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $kategoriModel    = $this->model('KategoriJasa');
        $data['kategori'] = $kategoriModel->getAll();
        $data['role']     = $_SESSION['role'];
        $data['nama']     = $_SESSION['nama'];
        $this->view('worker/tambah_jasa', $data);
    }

    public function simpan() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        $namaJasa  = trim($_POST['nama_jasa'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $harga     = $_POST['harga'] ?? 0;

        if (empty($namaJasa) || empty($deskripsi) || empty($harga)) {
            $_SESSION['error'] = 'Nama jasa, deskripsi, dan harga wajib diisi.';
            header('Location: ' . BASE_URL . '/worker/tambah');
            exit;
        }

        $jasaModel = $this->model('Jasa');
        $gambar = $this->uploadGambarJasa(BASE_URL . '/worker/tambah');

        $jasaData = [
            'id_user'     => $_SESSION['user_id'],
            'id_kategori' => $_POST['id_kategori'] ?? null,
            'nama_jasa'   => $namaJasa,
            'deskripsi'   => $deskripsi,
            'harga'       => (float)$harga,
            'gambar'      => $gambar,
            'status'      => 'aktif',
        ];

        if ($jasaModel->create($jasaData)) {
            Logger::write($_SESSION['user_id'],$_SESSION['nama'],'Menambahkan jasa: ' . $namaJasa);
            $_SESSION['success'] = 'Jasa berhasil ditambahkan!';
        } else {
            $_SESSION['error'] = 'Gagal menambahkan jasa, coba lagi.';
        }

        header('Location: ' . BASE_URL . '/worker/jasa');
        exit;
    }

    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SESSION['role'] !== 'freelancer') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $jasaModel         = $this->model('Jasa');
        $kategoriModel     = $this->model('KategoriJasa');

        $data['jasa_item'] = $jasaModel->getById($id);
        $data['jasa']      = $jasaModel->getByUser($_SESSION['user_id']); // list semua jasa milik sendiri
        $data['kategori']  = $kategoriModel->getAll();
        $data['role']      = $_SESSION['role'];
        $data['nama']      = $_SESSION['nama'];

        // Pastikan jasa ini milik freelancer yang login
        if (!$data['jasa_item'] || (int)$data['jasa_item']['id_user'] !== (int)$_SESSION['user_id']) {
            $_SESSION['error'] = 'Jasa tidak ditemukan atau bukan milik Anda.';
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        $this->view('worker/tambah_jasa', $data);
    }
    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        $namaJasa  = trim($_POST['nama_jasa'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $harga     = $_POST['harga'] ?? 0;

        if (empty($namaJasa) || empty($deskripsi) || empty($harga)) {
            $_SESSION['error'] = 'Nama jasa, deskripsi, dan harga wajib diisi.';
            header('Location: ' . BASE_URL . '/worker/edit/' . $id);
            exit;
        }

        $jasaModel = $this->model('Jasa');

        // Pastikan jasa milik freelancer yang login
        $jasa = $jasaModel->getById($id);
        if (!$jasa || (int)$jasa['id_user'] !== (int)$_SESSION['user_id']) {
            $_SESSION['error'] = 'Aksi tidak diizinkan.';
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        $gambar = $this->uploadGambarJasa(BASE_URL . '/worker/edit/' . $id, $jasa['gambar']);

        $jasaData = [
            'id_kategori' => $_POST['id_kategori'] ?? $jasa['id_kategori'],
            'nama_jasa'   => $namaJasa,
            'deskripsi'   => $deskripsi,
            'harga'       => (float)$harga,
            'gambar'      => $gambar,
            'status'      => $_POST['status'] ?? $jasa['status'],
        ];

        if ($jasaModel->update($id, $jasaData)) {
            Logger::write($_SESSION['user_id'],$_SESSION['nama'],'Mengubah jasa: ' . $namaJasa);
            $_SESSION['success'] = 'Jasa berhasil diperbarui!';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui jasa, coba lagi.';
        }

        header('Location: ' . BASE_URL . '/worker/jasa');
        exit;
    }

    public function hapus($id) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    if ($_SESSION['role'] !== 'freelancer') {
        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/worker/jasa');
        exit;
    }

    $jasaModel = $this->model('Jasa');

    // Pastikan jasa milik freelancer yang login
    $jasa = $jasaModel->getById($id);
    if (!$jasa || (int)$jasa['id_user'] !== (int)$_SESSION['user_id']) {
        $_SESSION['error'] = 'Aksi tidak diizinkan.';
        header('Location: ' . BASE_URL . '/worker/jasa');
        exit;
    }

    $result = $jasaModel->deleteByWorker($id, $_SESSION['user_id']);

    if ($result['success']) {
        Logger::write($_SESSION['user_id'],$_SESSION['nama'],'Menghapus jasa: ' . $jasa['nama_jasa'],'warning');
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header('Location: ' . BASE_URL . '/worker/jasa');
    exit;
}
}