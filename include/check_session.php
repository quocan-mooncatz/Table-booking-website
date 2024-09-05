<?php
// Bắt đầu hoặc khôi phục session
session_start();

// Kiểm tra xem có session 'sdt' (số điện thoại) không
if (!isset($_SESSION['sdt'])){
    // Nếu không có session, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../view/login.php"); 
    exit();
}

// Lấy số điện thoại từ session
$sdt = $_SESSION['sdt'];

if ($_SESSION['phanquyen'] !== 'admin') {
    // Nếu không, chuyển hướng người dùng đến trang người dùng
    header("Location: ../user/index.php");
    exit;
}
?>
