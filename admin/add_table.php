<?php
include '../include/check_session.php';
include '../include/connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Lấy dữ liệu từ form
    $tenban = $_POST["tenban"];
    $soghe = $_POST["soghe"];
    $giaban = $_POST["giaban"];
    $mota = $_POST["mota"];

    // Kiểm tra xem trường 'img' có tồn tại trong mảng $_FILES hay không
    if (isset($_FILES['img'])) {
        $img_name = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_path = "/public/img/" . $img_name;
    } else {
        echo "Không có tệp tin hình ảnh được tải lên.";
        exit; // Thoát khỏi mã PHP vì không có tệp tin hình ảnh
    }

    // Di chuyển tệp tin hình ảnh vào thư mục đích
    if (move_uploaded_file($img_temp, "../" . $img_path)) {
        // Chuẩn bị câu lệnh SQL INSERT INTO
        $sql = "INSERT INTO dsban (tenban, soghe, giaban, mota, img) VALUES ('$tenban', '$soghe', '$giaban', '$mota', '$img_path')";

        // Thực thi câu lệnh SQL và kiểm tra kết quả
        if ($conn->query($sql) === TRUE) {
            header("Location: table.php");
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
        }
    } else {
        echo "Lỗi tải lên hình đại diện.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bàn Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Bàn</h2>
        <form method="post" action="" enctype="multipart/form-data"> <!-- Thêm enctype="multipart/form-data" để có thể tải lên tệp tin -->
            <div class="form-group">
                <label for="tenban">Tên bàn:</label>
                <input type="text" class="form-control" id="tenban" name="tenban" required>
            </div>
            <div class="form-group">
                <label for="soghe">Số ghế</label>
                <input type="number" class="form-control" id="soghe" name="soghe" required>
            </div>
            <div class="form-group">
                <label for="giaban">Giá bàn</label>
                <input type="number" class="form-control" id="giaban" name="giaban" required>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Mô Tả Bàn</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="mota" required></textarea>
            </div>
            <div class="form-group">
                <label for="img">IMG</label>
                <input type="file" class="form-control-file" name="img" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
            <a href="table.php" class="btn btn-danger">Quay Lại</a>
        </form>
    </div>
</body>
</html>
