<?php
class RiwayatController extends Controller {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $role   = $_SESSION['role'] ?? 'client';
        $userId = $_SESSION['user_id'];

        $data['role'] = $role;
        $data['nama'] = $_SESSION['nama'];

        $pesananModel = $this->model('Pesanan');

        if ($role === 'freelancer') {
            // Freelancer: semua pesanan yang pernah dikerjakan (status selesai / dibatalkan)
            $semua = $pesananModel->getByFreelancer($userId);
            $data['riwayat'] = array_filter($semua, function($p) {
                return in_array($p['status'], ['selesai', 'dibatalkan']);
            });
            $data['riwayat'] = array_values($data['riwayat']);
            $this->view('worker/riwayat', $data);

        } else {
            // Client: semua pesanan yang pernah dibuat (status selesai / dibatalkan)
            $semua = $pesananModel->getByClient($userId);
            $data['riwayat'] = array_filter($semua, function($p) {
                return in_array($p['status'], ['selesai', 'dibatalkan']);
            });
            $data['riwayat'] = array_values($data['riwayat']);
            $this->view('user/riwayat', $data);
        }
    }
}
