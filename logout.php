<?php
// logout.php

session_start();

// Hapus semua variabel session
session_unset();

// Atur pesan logout berhasil menggunakan cookie karena session telah dihapus
setcookie('logout_success', 'Anda telah berhasil logout.', time() + 5, "/");

// Hancurkan session
session_destroy();

// Redirect ke login.php
header("Location: login.php");
exit();
