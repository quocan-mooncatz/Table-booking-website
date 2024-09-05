<?php
include '../include/check_session.php';
include '../include/connect.php';
if (isset($_GET['idmon'])) {
    $idmon = $_GET['idmon'];
    $sql = "DELETE FROM monan WHERE idmon=$idmon";

    if ($conn->query($sql) === TRUE) {
        header("Location: food.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
