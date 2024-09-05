<?php
include '../include/check_session.php';
include '../include/connect.php';
if (isset($_GET['idkhachhang'])) {
    $idkhachhang = $_GET['idkhachhang'];
    $sql = "DELETE FROM users WHERE idkhachhang=$idkhachhang";

    if ($conn->query($sql) === TRUE) {
        header("Location: user.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
