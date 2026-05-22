<?php
class DashboardController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role    = $_SESSION['role'];
        $userId  = $_SESSION['user_id'];

        $data['role']    = $role;
        $data['nama']    = $_SESSION['nama'];
        $data['email']   = $_SESSION['email'] ?? '';
        $data['user_id'] = $userId;

        $pesananModel = $this->model('Pesanan');

        if ($role === 'admin') {
            $userModel  = $this->model('User');
            $jasaModel  = $this->model('Jasa');

            $data['total_pengguna'] = $userModel->countAll();
            $data['total_jasa']     = count($jasaModel->getAllAdmin());
            $data['total_pesanan']  = $pesananModel->countAll();
            $data['recent_pesanan'] = $pesananModel->getRecentAll(5);
            $data['recent_users']   = $userModel->getRecent(5);

        } elseif ($role === 'freelancer') {
            $jasaModel = $this->model('Jasa');

            $data['pesanan_baru']     = $pesananModel->countByFreelancerStatus($userId, 'pending');
            $data['pesanan_selesai']  = $pesananModel->countByFreelancerStatus($userId, 'selesai');
            $data['pesanan_berjalan'] = $pesananModel->countByFreelancerStatus($userId, 'diproses');
            $data['total_jasa']       = $jasaModel->countByUser($userId);
            $data['recent_pesanan']   = $pesananModel->getRecentByFreelancer($userId, 5);
            $data['jasa_saya']        = $jasaModel->getByUser($userId);

        } else {
            // client
            $data['total_pesanan']    = count($pesananModel->getByClient($userId));
            $data['pesanan_berjalan'] = $pesananModel->countByClientStatus($userId, 'diproses');
            $data['pesanan_selesai']  = $pesananModel->countByClientStatus($userId, 'selesai');
            $data['recent_pesanan']   = $pesananModel->getRecentByClient($userId, 5);
        }

        $this->view('dashboard/index', $data);
    }
}
