<?php
include '../include/check_session.php';
include '../include/connect.php';
if (isset($_GET['idban'])) {
    $idban = $_GET['idban'];
    $sql = "DELETE FROM dsban WHERE idban=$idban";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
