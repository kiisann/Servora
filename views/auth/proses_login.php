<?php
session_start();

include "../../config/config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

$data = mysqli_fetch_assoc($query);

if ($data) {

    if ($password == $data['password']) {

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {

            header("Location: ../admin/dashboard.php");

        } elseif ($data['role'] == 'freelancer') {

            header("Location: ../worker/dashboard.php");

        } elseif ($data['role'] == 'client') {

            header("Location: ../user/dashboard.php");

        }

    } else {

        echo "Password salah!";

    }

} else {

    echo "Email tidak ditemukan!";

}
?>