<?php
// Bắt đầu hoặc khôi phục session
session_start();

// Kiểm tra xem có session 'sdt' (số điện thoại) không
if (!isset($_SESSION['sdt'])){
    // Nếu không có session, chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../view/login.php"); 
    exit();
}

?>
