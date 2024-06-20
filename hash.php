<?php
// Password yang akan di-hash
$password = "adminanjay";

// Membuat password hash menggunakan bcrypt
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Menampilkan password hash
echo "Password Hash: " . $hashed_password;
