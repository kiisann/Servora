<?php
require_once __DIR__ . '/../core/Database.php';

class Pesanan {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client 
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user";
        $result = mysqli_query($this->conn, $query);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getById($id) {
        $query = "SELECT p.*, j.nama_jasa, j.harga as harga_jasa, u.nama as nama_client, u.no_hp as no_hp_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  WHERE p.id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $query = "INSERT INTO pesanan (id_client, id_jasa, harga_awal, status, deadline, catatan) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        
        $status = $data['status'] ?? 'pending';
        $hargaAwal = $data['harga_awal'] ?? null;
        
        mysqli_stmt_bind_param($stmt, "iidsss", 
            $data['id_client'], $data['id_jasa'], $hargaAwal, $status, 
            $data['deadline'], $data['catatan']
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getByClient($clientId) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_freelancer
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON j.id_user = u.id_user
                  WHERE p.id_client = ?
                  ORDER BY p.created_at DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getByFreelancer($freelancerId) {
        $query = "SELECT p.*, j.nama_jasa, j.harga as harga_jasa,
                         u.nama as nama_client, u.no_hp as no_hp_client,
                         t.id_transaksi, t.total as total_bayar, t.status_bayar,
                         t.bukti_pembayaran, t.tanggal_upload_bukti, t.tanggal_bayar,
                         t.catatan_verifikasi, t.diverifikasi_at,
                         m.metode as metode_pembayaran
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  LEFT JOIN transaksi t ON t.id_pesanan = p.id_pesanan
                  LEFT JOIN metode_pembayaran m ON t.id_metode = m.id_metode
                  WHERE j.id_user = ?
                  ORDER BY p.created_at DESC";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $freelancerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE pesanan SET status=? WHERE id_pesanan=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function getByIdForFreelancer($id, $freelancerId) {
        $query = "SELECT p.*, j.id_user as id_freelancer
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  WHERE p.id_pesanan = ? AND j.id_user = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $id, $freelancerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function updateFinalDetail($id, $data) {
        $query = "UPDATE pesanan
                  SET detail_project_final = ?,
                      harga_final = ?,
                      waktu_pengerjaan = ?,
                      maksimal_revisi = ?,
                      deadline_final = ?,
                      catatan_worker = ?,
                      status = 'menunggu_pembayaran'
                  WHERE id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sdsissi",
            $data['detail_project_final'],
            $data['harga_final'],
            $data['waktu_pengerjaan'],
            $data['maksimal_revisi'],
            $data['deadline_final'],
            $data['catatan_worker'],
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    public function cancelByWorker($id, $reason) {
        $query = "UPDATE pesanan
                  SET status = 'dibatalkan',
                      alasan_pembatalan = ?,
                      dibatalkan_oleh = 'worker',
                      dibatalkan_at = NOW()
                  WHERE id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $reason, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function markFinished($id) {
        $query = "UPDATE pesanan SET status = 'selesai', selesai_at = NOW() WHERE id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    public function delete($id) {
        $query = "DELETE FROM pesanan WHERE id_pesanan = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    /** Hitung pesanan client berdasarkan status */
    public function countByClientStatus($clientId, $status) {
        $query = "SELECT COUNT(*) as total FROM pesanan WHERE id_client = ? AND status = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $clientId, $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Hitung pesanan freelancer berdasarkan status */
    public function countByFreelancerStatus($freelancerId, $status) {
        $query = "SELECT COUNT(*) as total 
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  WHERE j.id_user = ? AND p.status = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $freelancerId, $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Pesanan terbaru milik client (limit 5) */
    public function getRecentByClient($clientId, $limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_freelancer
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON j.id_user = u.id_user
                  WHERE p.id_client = ?
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $clientId, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /** Pesanan terbaru masuk ke freelancer (limit 5) */
    public function getRecentByFreelancer($freelancerId, $limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  WHERE j.id_user = ?
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $freelancerId, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /** Total semua pesanan (admin) */
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM pesanan";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    /** Pesanan terbaru untuk admin (limit 5) */
    public function getRecentAll($limit = 5) {
        $query = "SELECT p.*, j.nama_jasa, u.nama as nama_client
                  FROM pesanan p
                  JOIN jasa j ON p.id_jasa = j.id_jasa
                  JOIN users u ON p.id_client = u.id_user
                  ORDER BY p.created_at DESC
                  LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

