<?php
// memulai session
session_start();
// menghancurkan session
$logout = session_destroy();
if ($logout) {
  // mengarahkan ke halaman login.php
  header("location: /admin/login");
}
