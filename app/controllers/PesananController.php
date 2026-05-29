<?php
class PesananController extends Controller {
    private function requireFreelancerOrder($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if (($_SESSION['role'] ?? '') !== 'freelancer') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $pesananModel = $this->model('Pesanan');
        $pesanan = $pesananModel->getByIdForFreelancer((int)$id, (int)$_SESSION['user_id']);

        if (!$pesanan) {
            $_SESSION['error'] = 'Pesanan tidak ditemukan atau bukan milik Anda.';
            header('Location: ' . BASE_URL . '/pesanan');
            exit;
        }

        return [$pesananModel, $pesanan];
    }

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
        $pesananModel = $this->model('Pesanan');
        $jasaModel    = $this->model('Jasa');

        $idJasa = $_POST['id_jasa'] ?? null;
        $jasa   = $jasaModel->getById($idJasa);

        if (!$jasa) {
            $_SESSION['error'] = 'Data jasa tidak ditemukan.';
            header('Location: ' . BASE_URL . '/jasa');
            exit;
        }

        $pesananData = [
            'id_client'  => $_SESSION['user_id'],
            'id_jasa'    => $idJasa,
            'harga_awal' => $jasa['harga'] ?? null,
            'deadline'   => $_POST['deadline'] ?? null,
            'catatan'    => $_POST['catatan'] ?? '',
            'status'     => 'pending',
        ];

        if ($pesananModel->create($pesananData)) {
            $_SESSION['success'] = 'Pesanan berhasil dibuat!';
            header('Location: ' . BASE_URL . '/pesanan');
            exit;
        }

        $_SESSION['error'] = 'Gagal membuat pesanan, coba lagi.';
    }

    header('Location: ' . BASE_URL . '/jasa');
    exit;
}

    public function batalkanclient($id) {
        if (!isset($_SESSION['user_id'])) {
           header('Location: ' . BASE_URL . '/auth/login');
           exit;
        }

        if (($_SESSION['role'] ?? '') !== 'client') {
           header('Location: ' . BASE_URL . '/dashboard');
           exit;
        }

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $pesananModel = $this->model('Pesanan');
          $pesananList  = $pesananModel->getByClient($_SESSION['user_id']);

          foreach ($pesananList as $pesanan) {
              if ((int)$pesanan['id_pesanan'] === (int)$id && $pesanan['status'] === 'pending') {
                 $pesananModel->updateStatus($id, 'dibatalkan');
                 $_SESSION['success'] = 'Pesanan berhasil dibatalkan.';
                 header('Location: ' . BASE_URL . '/pesanan');
                 exit;
             }
         }

        $_SESSION['error'] = 'Pesanan tidak dapat dibatalkan.';
      }

      header('Location: ' . BASE_URL . '/pesanan');
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

            $allowedStatus = ['pending', 'diskusi', 'menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'selesai', 'dibatalkan'];
            if (!in_array($status, $allowedStatus)) {
                header('Location: ' . BASE_URL . '/pesanan');
                exit;
            }

            $pesananModel->updateStatus($id, $status);
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function mulaiDiskusi($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pesanan['status'] === 'pending') {
            $pesananModel->updateStatus($id, 'diskusi');
            $_SESSION['success'] = 'Pesanan masuk ke tahap diskusi.';
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function submitFinal($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $pesanan['status'] !== 'diskusi') {
            header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
            exit;
        }

        $detailProject = trim($_POST['detail_project_final'] ?? '');
        $hargaFinal = (float)($_POST['harga_final'] ?? 0);
        $waktuPengerjaan = trim($_POST['waktu_pengerjaan'] ?? '');
        $maksimalRevisi = (int)($_POST['maksimal_revisi'] ?? 0);
        $deadlineFinal = $_POST['deadline_final'] ?? null;

        if ($detailProject === '' || $hargaFinal <= 0 || $waktuPengerjaan === '' || $maksimalRevisi < 0 || empty($deadlineFinal)) {
            $_SESSION['error'] = 'Detail final, harga final, waktu pengerjaan, revisi, dan deadline wajib diisi.';
            header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
            exit;
        }

        $pesananModel->updateFinalDetail($id, [
            'detail_project_final' => $detailProject,
            'harga_final'          => $hargaFinal,
            'waktu_pengerjaan'     => $waktuPengerjaan,
            'maksimal_revisi'      => $maksimalRevisi,
            'deadline_final'       => $deadlineFinal,
            'catatan_worker'       => trim($_POST['catatan_worker'] ?? ''),
        ]);

        $transaksiModel = $this->model('Transaksi');
        $transaksiModel->create([
            'id_pesanan'   => $id,
            'total'        => $hargaFinal,
            'id_metode'    => 1,
            'status_bayar' => 'belum lunas'
        ]);

        $_SESSION['success'] = 'Detail final pesanan berhasil dikirim ke client.';
        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function batalkan($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($pesanan['status'], ['pending', 'diskusi', 'menunggu_pembayaran', 'menunggu_verifikasi', 'diproses'])) {
            $reason = trim($_POST['alasan_pembatalan'] ?? '');
            if ($reason === '') {
                $_SESSION['error'] = 'Alasan pembatalan wajib diisi.';
                header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
                exit;
            }

            $pesananModel->cancelByWorker($id, $reason);
            $_SESSION['success'] = 'Pesanan berhasil dibatalkan.';
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function uploadBuktiPembayaran($id) {
        if (!isset($_SESSION['user_id'])) {
           header('Location: ' . BASE_URL . '/auth/login');
           exit;
        }

        if (($_SESSION['role'] ?? '') !== 'client') {
           header('Location: ' . BASE_URL . '/dashboard');
           exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $pesananModel   = $this->model('Pesanan');
           $transaksiModel = $this->model('Transaksi');

          $pesananList = $pesananModel->getByClient($_SESSION['user_id']);
          $isOwned = false;

          foreach ($pesananList as $pesanan) {
              if ((int)$pesanan['id_pesanan'] === (int)$id && $pesanan['status'] === 'menunggu_pembayaran') {
                 $isOwned = true;
                 break;
              }
          }

          if (!$isOwned) {
             $_SESSION['error'] = 'Pesanan tidak dapat mengunggah bukti pembayaran.';
             header('Location: ' . BASE_URL . '/pesanan');
             exit;
          }

          if (!isset($_FILES['bukti_pembayaran']) || $_FILES['bukti_pembayaran']['error'] !== UPLOAD_ERR_OK) {
             $_SESSION['error'] = 'Bukti pembayaran wajib diunggah.';
             header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
             exit;
          }

         $allowedExt = ['jpg', 'jpeg', 'png', 'pdf'];
         $fileName = $_FILES['bukti_pembayaran']['name'];
         $fileTmp  = $_FILES['bukti_pembayaran']['tmp_name'];
         $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

         if (!in_array($fileExt, $allowedExt)) {
             $_SESSION['error'] = 'Format bukti pembayaran harus JPG, PNG, atau PDF.';
             header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
             exit;
         }

         $uploadDir = __DIR__ . '/../../public/assets/images/bukti_pembayaran/';

         if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
         }

         $newFileName = 'bukti_' . $id . '_' . time() . '.' . $fileExt;
         $targetPath = $uploadDir . $newFileName;

         if (!move_uploaded_file($fileTmp, $targetPath)) {
             $_SESSION['error'] = 'Gagal mengunggah bukti pembayaran.';
             header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
             exit;
         }

         $idMetode = $_POST['id_metode'] ?? null;

         $transaksiModel->uploadBuktiPembayaran($id, $newFileName, $idMetode);

         $pesananModel->updateStatus($id, 'menunggu_verifikasi');

         $_SESSION['success'] = 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi freelancer.';
         
         header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
         exit;
        }

        header('Location: ' . BASE_URL . '/pesanan');
        exit;
    }

    public function terimaPembayaran($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pesanan['status'] === 'menunggu_verifikasi') {
            $transaksiModel = $this->model('Transaksi');
            $transaksiModel->updatePaymentAcceptedByPesanan($id);
            $pesananModel->updateStatus($id, 'diproses');
            $_SESSION['success'] = 'Pembayaran diterima. Pesanan masuk tahap diproses.';
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function tolakPembayaran($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pesanan['status'] === 'menunggu_verifikasi') {
            $note = trim($_POST['catatan_verifikasi'] ?? '');
            if ($note === '') {
                $_SESSION['error'] = 'Catatan penolakan pembayaran wajib diisi.';
                header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
                exit;
            }

            $transaksiModel = $this->model('Transaksi');
            $transaksiModel->updatePaymentRejectedByPesanan($id, $note);
            $pesananModel->updateStatus($id, 'menunggu_pembayaran');
            $_SESSION['success'] = 'Pembayaran ditolak dan dikembalikan ke tahap menunggu pembayaran.';
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }

    public function tandaiSelesai($id) {
        [$pesananModel, $pesanan] = $this->requireFreelancerOrder($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pesanan['status'] === 'diproses') {
            $pesananModel->markFinished($id);
            $_SESSION['success'] = 'Pesanan berhasil ditandai selesai.';
        }

        header('Location: ' . BASE_URL . '/pesanan/detail/' . $id);
        exit;
    }
}
