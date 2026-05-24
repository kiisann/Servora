<?php
class Controller {
    public function view(string $view, array $data = []) {
        extract($data);
        $viewPath = dirname(__DIR__) . '/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die('View tidak ditemukan: ' . htmlspecialchars($viewPath));
        }
    }

    public function model(string $model) {
        $modelPath = dirname(__DIR__) . '/models/' . $model . '.php';
        require_once $modelPath;
        return new $model();
    }
}