<?php
class Logger {
    public static function write($id_user,$pengguna, $deskripsi, $tipe = 'info') {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO log_aktivitas (id_user, pengguna, deskripsi, tipe) VALUES (?, ?, ?, ?)");

        $stmt->bind_param(
            "isss",
            $id_user,
            $pengguna,
            $deskripsi,
            $tipe
        );
        $stmt->execute();
    }
}