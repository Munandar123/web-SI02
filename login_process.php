<?php
// login_process.php

// Mengaktifkan error reporting untuk debugging (pastikan nonaktifkan di produksi)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

// Sertakan file koneksi database
include 'config.php';

// Fungsi untuk membersihkan input
function clean_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil dan membersihkan data dari form
    $username = isset($_POST['username']) ? clean_input($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Password di-hash, tidak perlu dibersihkan

    // Validasi dasar
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username harus diisi.";
    }

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    }

    // Jika tidak ada error, lanjutkan proses login
    if (empty($errors)) {
        // Cari pengguna berdasarkan username
        $stmt = $conn->prepare("SELECT id, name, username, email, gender, address, password, role, status_user FROM users WHERE username = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Cek apakah status user aktif
            if ($user['status_user'] !== 'aktif') {
                $errors[] = "Akun Anda tidak aktif. Silakan hubungi administrator.";
            } else {
                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Password benar, set session dan redirect
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_role'] = $user['role'];

                    // Redirect berdasarkan role
                    if ($user['role'] === 'admin') {
                        header("Location: dashboard/index.php");
                    } else {
                        header("Location: index.php");
                    }
                    exit();
                } else {
                    $errors[] = "Password salah.";
                }
            }
        } else {
            $errors[] = "Username tidak ditemukan.";
        }

        $stmt->close();
    }

    // Jika ada error, simpan di session dan redirect kembali ke login
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
        exit();
    }
} else {
    // Jika tidak ada form yang disubmit, redirect ke form login
    header("Location: login.php");
    exit();
}
