<?php
class JasaController extends Controller {

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
            $data['jasa'] = $jasaModel->getAllAdmin();
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
            $kategoriModel    = $this->model('KategoriJasa');
            $data['kategori'] = $kategoriModel->getAll();
            $data['jasa_item'] = $data['jasa'];
            $this->view('worker/kelola_jasa', $data);
        } else {
            $this->view('user/detail_jasa', $data);
        }
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jasaModel = $this->model('Jasa');

            $jasaData = [
                'id_user'     => $_SESSION['user_id'],
                'id_kategori' => $_POST['id_kategori'] ?? null,
                'nama_jasa'   => trim($_POST['nama_jasa'] ?? ''),
                'deskripsi'   => trim($_POST['deskripsi'] ?? ''),
                'harga'       => $_POST['harga'] ?? 0,
                'gambar'      => null,
                'status'      => 'aktif',
            ];

            if ($jasaModel->create($jasaData)) {
                header('Location: ' . BASE_URL . '/worker/jasa');
                exit;
            }
        }

        $kategoriModel    = $this->model('KategoriJasa');
        $data['kategori'] = $kategoriModel->getAll();
        $data['role']     = $_SESSION['role'] ?? 'freelancer';
        $data['nama']     = $_SESSION['nama'];
        $this->view('worker/tambah_jasa', $data);
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

