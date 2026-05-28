<?php
class PesananController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role         = $_SESSION['role'] ?? 'client';
        $userId       = $_SESSION['user_id'];
        $pesananModel = $this->model('Pesanan');

        if ($role === 'admin') {
            $data['pesanan']      = $pesananModel->getAll();
            $data['role']         = $role;
            $data['nama']         = $_SESSION['nama'];
            $data['selected_id']  = null;
            $this->view('admin/kelola_pesanan', $data);

        } elseif ($role === 'freelancer') {
            $data['pesanan']      = $pesananModel->getByFreelancer($userId);
            $data['role']         = $role;
            $data['nama']         = $_SESSION['nama'];
            $data['selected_id']  = null;
            $this->view('worker/pesanan_masuk', $data);

        } else {
            $data['pesanan']      = $pesananModel->getByClient($userId);
            $data['role']         = $role;
            $data['nama']         = $_SESSION['nama'];
            $data['selected_id']  = null;
            $this->view('user/pesanan', $data);
        }
    }

    /**
     * Detail pesanan ditampilkan via popup JS di halaman yang sama.
     * Controller mengirim $selected_id agar view bisa auto-open popup.
     */
    public function detail($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role         = $_SESSION['role'] ?? 'client';
        $userId       = $_SESSION['user_id'];
        $pesananModel = $this->model('Pesanan');

        $data['selected_id'] = (int)$id;
        $data['role']        = $role;
        $data['nama']        = $_SESSION['nama'];

        if ($role === 'admin') {
            $data['pesanan'] = $pesananModel->getAll();
            $this->view('admin/kelola_pesanan', $data);

        } elseif ($role === 'freelancer') {
            $data['pesanan'] = $pesananModel->getByFreelancer($userId);
            $this->view('worker/pesanan_masuk', $data);

        } else {
            $data['pesanan'] = $pesananModel->getByClient($userId);
            $this->view('user/pesanan', $data);
        }
    }

    public function order() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pesananModel  = $this->model('Pesanan');
        $transaksiModel = $this->model('Transaksi');
        $jasaModel = $this->model('Jasa');

        $idJasa = $_POST['id_jasa'] ?? null;
        $idMetode = $_POST['id_metode'] ?? null;

        $jasa = $jasaModel->getById($idJasa);

        if (!$jasa || empty($idMetode)) {
            $_SESSION['error'] = 'Data pesanan belum lengkap.';
            header('Location: ' . BASE_URL . '/jasa');
            exit;
        }

        $pesananData = [
            'id_client' => $_SESSION['user_id'],
            'id_jasa'   => $idJasa,
            'deadline'  => $_POST['deadline'] ?? null,
            'catatan'   => $_POST['catatan'] ?? '',
            'status'    => 'pending',
        ];

        $idPesanan = $pesananModel->create($pesananData);

        if ($idPesanan) {
            $transaksiData = [
                'id_pesanan'   => $idPesanan,
                'total'        => $jasa['harga'],
                'id_metode'    => $idMetode,
                'status_bayar' => 'belum lunas',
            ];

            $transaksiModel->create($transaksiData);

            $_SESSION['success'] = 'Pesanan berhasil dibuat!';
            header('Location: ' . BASE_URL . '/pesanan');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal membuat pesanan, coba lagi.';
        }
    }

    header('Location: ' . BASE_URL . '/jasa');
    exit;
}

    public function updateStatus($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pesananModel = $this->model('Pesanan');
            $status       = $_POST['status'] ?? '';

            $allowedStatus = ['pending', 'diproses', 'selesai', 'dibatalkan'];
            if (!in_array($status, $allowedStatus)) {
                header('Location: ' . BASE_URL . '/pesanan');
                exit;
            }

            $pesananModel->updateStatus($id, $status);
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }
}
