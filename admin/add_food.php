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
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="mamon">Mã Món</label>
                <input type="text" class="form-control" id="mamon" name="mamon" required>
            </div>
            <div class="form-group">
                <label for="tenmon">Tên Món</label>
                <input type="text" class="form-control" id="tenmon" name="tenmon" required>
            </div>
            <div class="form-group">
                <label for="giamon">Giá Món</label>
                <input type="number" class="form-control" id="giamon" name="giamon" required>
            </div>
            <div class="form-group">
                <label for="mota">Mô Tả Món</label>
                <textarea class="form-control" id="mota" rows="3" name="mota" required></textarea>
            </div>
            <div class="form-group">
                <label for="img">IMG</label>
                <input type="file" class="form-control-file" name="img" required>
            </div>
            <div class="form-group">
                <label for="icon">ICON</label>
                <input type="file" class="form-control-file" name="icon" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
            <a href="food.php" class="btn btn-danger">Quay Lại</a>
        </form>
    </div>
</body>
</html>
<?php
include '../include/check_session.php';
include '../include/connect.php';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Lấy dữ liệu từ form
    $mamon = $_POST["mamon"];
    $tenmon = $_POST["tenmon"];
    $giamon = $_POST["giamon"];
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

    // Tương tự, kiểm tra xem trường 'icon' có tồn tại trong mảng $_FILES hay không
    if (isset($_FILES['icon'])) {
        $icon_name = $_FILES['icon']['name'];
        $icon_temp = $_FILES['icon']['tmp_name'];
        $icon_path = "/public/icon/" . $icon_name;
    } else {
        echo "Không có tệp tin biểu tượng được tải lên.";
        exit; // Thoát khỏi mã PHP vì không có tệp tin biểu tượng
    }

    if (move_uploaded_file($img_temp, "../" . $img_path) && move_uploaded_file($icon_temp, "../" . $icon_path)) {
        // Chuẩn bị câu lệnh SQL INSERT INTO
        $sql = "INSERT INTO monan (mamon, tenmon, giamon, mota, img, icon) VALUES ('$mamon', '$tenmon', '$giamon', '$mota', '$img_path', '$icon_path')";

        // Thực thi câu lệnh SQL và kiểm tra kết quả
        if ($conn->query($sql) === TRUE) {
            header("Location: food.php");
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
        }
    } else {
        echo "Lỗi tải lên hình đại diện.";
    }
}
?>
