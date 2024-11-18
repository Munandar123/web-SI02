<?php
// register_process.php

// Mengaktifkan error reporting untuk debugging (pastikan nonaktifkan di produksi)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $name = isset($_POST['name']) ? clean_input($_POST['name']) : '';
    $username = isset($_POST['username']) ? clean_input($_POST['username']) : '';
    $email = isset($_POST['email']) ? clean_input($_POST['email']) : '';
    $gender = isset($_POST['gender']) ? clean_input($_POST['gender']) : '';
    $address = isset($_POST['address']) ? clean_input($_POST['address']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Password di-hash, tidak perlu dibersihkan

    // Validasi dasar
    $errors = [];

    if (empty($name)) {
        $errors[] = "Nama lengkap harus diisi.";
    }

    if (empty($username)) {
        $errors[] = "Username harus diisi.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $errors[] = "Username harus terdiri dari 3-20 karakter alfanumerik atau underscore.";
    }

    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($gender)) {
        $errors[] = "Jenis kelamin harus dipilih.";
    } elseif (!in_array($gender, ['male', 'female'])) {
        $errors[] = "Jenis kelamin tidak valid.";
    }

    if (empty($address)) {
        $errors[] = "Alamat harus diisi.";
    }

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal terdiri dari 6 karakter.";
    }

    // Cek apakah username atau email sudah digunakan
    if (empty($errors)) {
        // Cek username
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Username sudah digunakan. Silakan pilih yang lain.";
        }

        $stmt->close();

        // Cek email
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email sudah terdaftar. Silakan gunakan email lain.";
        }

        $stmt->close();
    }

    // Jika tidak ada error, lanjutkan proses registrasi
    if (empty($errors)) {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Siapkan pernyataan SQL untuk memasukkan data
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, gender, address, password) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        // Mengatur role dan status_user secara otomatis
        $role = 'user';
        $status_user = 'aktif';

        $stmt->bind_param("ssssss", $name, $username, $email, $gender, $address, $password_hash);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            // Registrasi berhasil, set notifikasi dan redirect ke login.php
            $_SESSION['success_message'] = "Pendaftaran berhasil! Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
        }

        $stmt->close();
    }

    // Jika ada error, simpan di session dan redirect kembali ke form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: register.php");
        exit();
    }
} else {
    // Jika tidak ada form yang disubmit, redirect ke form registrasi
    header("Location: register.php");
    exit();
}
