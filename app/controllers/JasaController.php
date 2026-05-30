<?php
class JasaController extends Controller {
    private function uploadGambarJasa($redirectUrl, $currentImage = null) {
        if (empty($_FILES['gambar']['name'])) {
            return $currentImage;
        }

        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExt = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExt)) {
            $_SESSION['error'] = 'Format gambar harus JPG, PNG, atau WebP.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        $uploadDir = dirname(__DIR__, 2) . '/public/assets/images/upload';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $namaFile = 'jasa-admin-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $fileExt;
        $targetPath = $uploadDir . '/' . $namaFile;

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
            $_SESSION['error'] = 'Gagal mengupload gambar jasa.';
            header('Location: ' . $redirectUrl);
            exit;
        }

        return 'assets/images/upload/' . $namaFile;
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role = $_SESSION['role'] ?? 'client';

        // Freelancer yang mengakses /jasa diarahkan ke halaman kelola jasa mereka sendiri
        if ($role === 'freelancer') {
            header('Location: ' . BASE_URL . '/worker/jasa');
            exit;
        }

        if ($role === 'admin') {
            $jasaModel    = $this->model('Jasa');
            $kategoriModel = $this->model('KategoriJasa');
            $data['jasa'] = $jasaModel->getAllAdmin();
            $data['kategori'] = $kategoriModel->getAll();
            $data['role'] = $role;
            $data['nama'] = $_SESSION['nama'];
            $this->view('admin/kelola_jasa', $data);

        } else {
            // Client: cari jasa
            $jasaModel       = $this->model('Jasa');
            $kategoriModel   = $this->model('KategoriJasa');
            $data['jasa']    = $jasaModel->getAll();
            $data['kategori']= $kategoriModel->getAll();
            $data['role']    = $role;
            $data['nama']    = $_SESSION['nama'];
            $this->view('user/cari_jasa', $data);
        }
    }

    public function detail($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role        = $_SESSION['role'] ?? 'client';
        $jasaModel   = $this->model('Jasa');
        $reviewModel = $this->model('Review');

        $jasa = $jasaModel->getById($id);
        if (!$jasa) {
            header('Location: ' . BASE_URL . '/jasa');
            exit;
        }
        $data['jasa']    = $jasa;
        $data['reviews'] = $reviewModel->getByJasa($id);
        $data['role']    = $role;
        $data['nama']    = $_SESSION['nama'];

        if ($role === 'freelancer') {
            // Freelancer melihat detail jasanya sendiri — tampilkan form edit
            header('Location: ' . BASE_URL . '/worker/jasa/detail/' . $id);
            exit;
        } else {
            $this->view('user/detail_jasa', $data);
        }
    }

    public function create() {
        if (
            !isset($_SESSION['user_id']) ||
            !in_array($_SESSION['role'], ['admin', 'freelancer'])
        ) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jasaModel = $this->model('Jasa');
            $gambar = $this->uploadGambarJasa(BASE_URL . '/jasa');

            $jasaData = [
                'id_user'     => $_SESSION['user_id'],
                'id_kategori' => $_POST['id_kategori'] ?? null,
                'nama_jasa'   => trim($_POST['nama_jasa'] ?? ''),
                'deskripsi'   => trim($_POST['deskripsi'] ?? ''),
                'harga'       => $_POST['harga'] ?? 0,
                'gambar'      => $gambar,
                'status'      => 'aktif',
            ];
            if (
                empty($jasaData['nama_jasa']) ||
                empty($jasaData['id_kategori'])
            ) {
                $_SESSION['error'] =
                    'Nama jasa dan kategori wajib diisi';
                header('Location: ' . BASE_URL . '/jasa');
                exit;
            }
            if ($jasaModel->create($jasaData)) {
                $_SESSION['success'] =
                    'Jasa berhasil ditambahkan';
            } else {
                $_SESSION['error'] =
                    'Gagal menambahkan jasa';
            }
            header('Location: ' . BASE_URL . '/jasa');
            exit;
        }
        header('Location: ' . BASE_URL . '/jasa');
        exit;
    }

public function update($id){
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    $jasaModel = $this->model('Jasa');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gambar = $_POST['gambar_lama'];
        $gambar = $this->uploadGambarJasa(BASE_URL . '/jasa', $gambar);

        // data update
        $data = [
            'id_kategori' => $_POST['id_kategori'],
            'nama_jasa'   => trim($_POST['nama_jasa']),
            'deskripsi'   => trim($_POST['deskripsi']),
            'harga'       => $_POST['harga'],
            'gambar'      => $gambar,
            'status'      => $_POST['status']
        ];

        // update database
        $jasaModel->updateByAdmin($id, $data);

        // redirect
        header('Location: ' . BASE_URL . '/jasa');
        exit;
    }

    header('Location: ' . BASE_URL . '/jasa');
    exit;
}

    public function delete($id){
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $jasaModel = $this->model('Jasa');
        if($jasaModel->delete($id)){
            header('Location: ' . BASE_URL . '/jasa');
            exit;
        }

        header('Location: ' . BASE_URL . '/jasa');
        exit;
    }
}

