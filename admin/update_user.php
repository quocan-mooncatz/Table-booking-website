<?php
include '../include/check_session.php';
include '../include/connect.php';

$tenkhach = $sdt = $mail = "";

// Kiểm tra nếu có tham số 'idkhachhang' truyền từ URL
if (isset($_GET['idkhachhang'])) {
    $idkhachhang = $_GET['idkhachhang'];
    
    // Truy vấn dữ liệu của bàn cần cập nhật
    $sql = "SELECT * FROM users WHERE idkhachhang=$idkhachhang";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenkhach = $row["tenkhach"];
        $sdt = $row["sdt"];
        $mail = $row["mail"];
    } else {
        echo "Không tìm thấy dữ liệu";
    }
}

// Xử lý khi form cập nhật được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $tenkhach = $_POST["tenkhach"];
    $sdt = $_POST["sdt"];
    $mail = $_POST["mail"];

    // Chuẩn bị câu lệnh SQL UPDATE
    $sql = "UPDATE users SET tenkhach='$tenkhach', sdt='$sdt', mail='$mail' WHERE idkhachhang=$idkhachhang";

    if ($conn->query($sql) === TRUE) {
        header("Location: user.php");
    } else {
        echo "<div class='alert alert-danger mt-3' role='alert'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contenkhacht="width=device-width, initial-scale=1.0">
    <title>Thêm Khách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Bàn</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="tenkhachkhach">Tên Khách:</label>
                <input type="text" class="form-control" id="tenkhachkhach" name="tenkhachkhach" value="<?php echo $tenkhach; ?>">
            </div>
            <div class="form-group">
                <label for="sdt">Số Điện Thoại:</label>
                <input type="text" class="form-control" id="sdt" name="sdt" value="<?php echo $sdt; ?>">
            </div>
            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="update">Thêm</button>
            <a href="user.php" class="btn btn-danger" >Quay Lại</a>
        </form>
    </div>
</body>
</html>