<?php
include '../include/check_session.php';
include '../include/connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: booking.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
