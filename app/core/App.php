<?php

class App {

    /**
     * Explicit route table.
     * Format: 'url_path' => ['controller' => 'ControllerName', 'method' => 'methodName']
     * :id   → parameter dinamis (integer)
     */
    private $routes = [
        // ── Home (landing page) ──────────────────────────────────────────────
        ''               => ['controller' => 'HomeController',       'method' => 'index'],
        'auth/login'     => ['controller' => 'AuthController',       'method' => 'login'],
        'auth/loginProcess'  => ['controller' => 'AuthController',   'method' => 'loginProcess'],
        'auth/register'  => ['controller' => 'AuthController',       'method' => 'register'],
        'auth/registerProcess' => ['controller' => 'AuthController', 'method' => 'registerProcess'],
        'auth/logout'    => ['controller' => 'AuthController',       'method' => 'logout'],

        // ── Dashboard (shared, role-based view di dalam controller) ──
        'dashboard'      => ['controller' => 'DashboardController',  'method' => 'index'],

        // ── Jasa (role-based: admin → kelola_jasa, client → cari_jasa) ──
        'jasa'           => ['controller' => 'JasaController',       'method' => 'index'],
        'jasa/detail/:id'=> ['controller' => 'JasaController',       'method' => 'detail'],
        'jasa/create'    => ['controller' => 'JasaController',       'method' => 'create'],
        'jasa/update/:id'=> ['controller' => 'JasaController',       'method' => 'update'],
        'jasa/delete/:id'=> ['controller' => 'JasaController',       'method' => 'delete'],

        // ── Pesanan (role-based: client → pesanan, freelancer → pesanan_masuk) ──
        'pesanan'              => ['controller' => 'PesananController', 'method' => 'index'],
        'pesanan/detail/:id'   => ['controller' => 'PesananController', 'method' => 'detail'],
        'pesanan/order'        => ['controller' => 'PesananController', 'method' => 'order'],
        'pesanan/updateStatus/:id' => ['controller' => 'PesananController', 'method' => 'updateStatus'],
        'pesanan/mulaiDiskusi/:id' => ['controller' => 'PesananController', 'method' => 'mulaiDiskusi'],
        'pesanan/submitFinal/:id' => ['controller' => 'PesananController', 'method' => 'submitFinal'],
        'pesanan/batalkan/:id' => ['controller' => 'PesananController', 'method' => 'batalkan'],
        'pesanan/uploadBuktiPembayaran/:id' => ['controller' => 'PesananController', 'method' => 'uploadBuktiPembayaran'],
        'pesanan/terimaPembayaran/:id' => ['controller' => 'PesananController', 'method' => 'terimaPembayaran'],
        'pesanan/tolakPembayaran/:id' => ['controller' => 'PesananController', 'method' => 'tolakPembayaran'],
        'pesanan/tandaiSelesai/:id' => ['controller' => 'PesananController', 'method' => 'tandaiSelesai'],

        // ── Riwayat (role-based: client → riwayat, freelancer → riwayat) ──
        'riwayat'        => ['controller' => 'RiwayatController',    'method' => 'index'],

        // ── Monitoring (admin only) ──
        'monitoring'     => ['controller' => 'MonitoringController', 'method' => 'index'],

        // ── User / Kelola Pengguna (admin only) ──
        'user'                  => ['controller' => 'UserController', 'method' => 'index'],
        'user/update/:id'       => ['controller' => 'UserController', 'method' => 'update'],
        'user/updateAdmin/:id'  => ['controller' => 'UserController', 'method' => 'updateAdmin'],
        'user/delete/:id'       => ['controller' => 'UserController', 'method' => 'delete'],
        'user/store'            => ['controller' => 'UserController', 'method' => 'store'],

        // ── Worker / Kelola Jasa Freelancer ──
        'worker/jasa'         => ['controller' => 'WorkerController', 'method' => 'jasa'],
        'worker/jasa/detail/:id' => ['controller' => 'WorkerController', 'method' => 'detailJasa'],
        'worker/tambah'       => ['controller' => 'WorkerController', 'method' => 'tambah'],
        'worker/simpan'       => ['controller' => 'WorkerController', 'method' => 'simpan'],
        'worker/edit/:id'     => ['controller' => 'WorkerController', 'method' => 'edit'],
        'worker/update/:id'   => ['controller' => 'WorkerController', 'method' => 'update'],
        'worker/hapus/:id'    => ['controller' => 'WorkerController', 'method' => 'hapus'],

        // ── Profile ──
        'profile'             => ['controller' => 'ProfileController', 'method' => 'index'],
        'profile/update/:id'  => ['controller' => 'ProfileController', 'method' => 'update'],

        // ── Home (landing page) ──
        'home'           => ['controller' => 'HomeController',       'method' => 'index'],

        // ── Review (admin only) ──
        'review'                => ['controller' => 'ReviewController', 'method' => 'index'],
        'review/delete/:id'     => ['controller' => 'ReviewController', 'method' => 'delete'],
    ];

    public function __construct() {
        $rawUrl = $this->parseURL();
        $this->dispatch($rawUrl);
    }

    private function dispatch(string $rawUrl): void {
        $params = [];
        $matched = null;

        // Cari kecocokan route — cek exact match dulu, lalu pattern dengan :id
        foreach ($this->routes as $pattern => $route) {
            if ($pattern === $rawUrl) {
                $matched = $route;
                break;
            }

            // Ganti :id dengan regex untuk parameter dinamis
            $regex = '@^' . preg_replace('/:([a-z_]+)/', '([^/]+)', $pattern) . '$@';
            if (preg_match($regex, $rawUrl, $matches)) {
                array_shift($matches); // buang full match
                $params  = $matches;
                $matched = $route;
                break;
            }
        }

        if (!$matched) {
            // Fallback ke HomeController jika tidak ada route yang cocok
            $matched = ['controller' => 'HomeController', 'method' => 'index'];
        }

        $controllerName = $matched['controller'];
        $method         = $matched['method'];

        $controllerFile = '../app/controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            die('Controller tidak ditemukan: ' . htmlspecialchars($controllerName));
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            die('Class tidak ditemukan: ' . htmlspecialchars($controllerName));
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die('Method tidak ditemukan: ' . htmlspecialchars($controllerName . '::' . $method . '()'));
        }

        call_user_func_array([$controller, $method], $params);
    }

    private function parseURL(): string {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            return filter_var($url, FILTER_SANITIZE_URL);
        }
        return '';
    }
}
