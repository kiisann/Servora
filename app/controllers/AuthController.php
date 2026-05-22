<?php
class AuthController extends Controller {

    public function index() {
        // Jika sudah login, langsung ke dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    public function login() {
        // Jika sudah login, langsung ke dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        $this->view('auth/login');
    }

    public function loginProcess() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email dan password tidak boleh kosong!';
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $authModel = $this->model('Auth');
        $user = $authModel->login($email, $password);

        if ($user) {
            if ($user['status'] !== 'aktif') {
                $_SESSION['error'] = 'Akun Anda sedang ditangguhkan.';
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
            // Set session
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['role']    = $user['role'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['email']   = $user['email'];

            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        } else {
            $_SESSION['error'] = 'Email atau password salah!';
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public function register() {
        // Jika sudah login, langsung ke dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        $this->view('auth/register');
    }

    public function registerProcess() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        $authModel = $this->model('Auth');

        // Cek password match
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['error'] = 'Password dan konfirmasi password tidak sama!';
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        if ($authModel->checkEmailExists($_POST['email'])) {
            $_SESSION['error'] = 'Email sudah terdaftar!';
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        if ($authModel->register($_POST)) {
            $_SESSION['success'] = 'Registrasi berhasil! Silakan login.';
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal melakukan registrasi, coba lagi.';
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
