<?php
include '../include/check_session.php';
include '../include/connect.php';
$tenban = $soghe = $giaban = $img = $mota = "";

// Kiểm tra nếu có tham số 'idban' truyền từ URL
if (isset($_GET['idban'])) {
    $idban = $_GET['idban'];
    
    // Truy vấn dữ liệu của bàn cần cập nhật
    $sql = "SELECT * FROM dsban WHERE idban=$idban";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenban = $row["tenban"];
        $soghe = $row["soghe"];
        $giaban = $row["giaban"];
        $mota = $row["mota"];
        $img = $row["img"];
    } else {
        echo "Không tìm thấy dữ liệu";
    }
}

// Xử lý khi form cập nhật được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $tenban = $_POST["tenban"];
    $soghe = $_POST["soghe"];
    $giaban = $_POST["giaban"];
    $mota = $_POST["mota"];

    if (isset($_FILES['img'])) {
        $img_name = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_path = "/public/img/" . $img_name;

        // Di chuyển tệp tin hình ảnh vào thư mục đích
        if (move_uploaded_file($img_temp, "../" . $img_path)) {
            // Nếu tải lên thành công, cập nhật đường dẫn hình ảnh
            $img = $img_path;
        }
    }

    // Chuẩn bị câu lệnh SQL UPDATE
    $sql = "UPDATE dsban SET tenban='$tenban', soghe='$soghe', giaban='$giaban', mota='$mota', img='$img' WHERE idban=$idban";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
    } else {
        echo "<div class='alert alert-danger mt-3' role='alert'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Bàn Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Cập Nhật Bàn</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tenban">Tên bàn:</label>
                <input type="text" class="form-control" id="tenban" name="tenban" value="<?php echo $tenban; ?>">
            </div>
            <div class="form-group">
                <label for="soghe">Số ghế</label>
                <input type="number" class="form-control" id="soghe" name="soghe" value="<?php echo $soghe; ?>">
            </div>
            <div class="form-group">
                <label for="giaban">Giá bàn</label>
                <input type="text" class="form-control" id="giaban" name="giaban" value="<?php echo $giaban; ?>">
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Mô Tả bàn</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="mota"><?php echo $mota;?></textarea>
            </div>
            <div class="form-group">
                <label for="img">IMG</label>
                <input type="file" class="form-control-file" name="img">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Cập Nhật</button>
            <a href="table.php" class="btn btn-danger" >Quay Lại</a>
        </form>
    </div>
</body>
</html>
