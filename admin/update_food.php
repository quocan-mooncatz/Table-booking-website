<?php
include '../include/check_session.php';
include '../include/connect.php';
$tenmon = $mamon = $giamon = $mota = $img = $icon = "";

// Kiểm tra nếu có tham số 'idmon' truyền từ URL
if (isset($_GET['idmon'])) {
    $idmon = $_GET['idmon'];
    
    // Truy vấn dữ liệu của món ăn cần cập nhật
    $sql = "SELECT * FROM monan WHERE idmon=$idmon";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenmon = $row["tenmon"];
        $mamon = $row["mamon"];
        $giamon = $row["giamon"];
        $mota = $row["mota"];
        $img = $row["img"];
        $icon = $row["icon"];
    }
}

// Xử lý khi form cập nhật được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $tenmon = $_POST["tenmon"];
    $mamon = $_POST["mamon"];
    $giamon = $_POST["giamon"];
    $mota = $_POST["mota"];

    // Kiểm tra xem trường 'img' có tồn tại trong mảng $_FILES hay không
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

    // Tương tự, kiểm tra xem trường 'icon' có tồn tại trong mảng $_FILES hay không
    if (isset($_FILES['icon'])) {
        $icon_name = $_FILES['icon']['name'];
        $icon_temp = $_FILES['icon']['tmp_name'];
        $icon_path = "/public/icon/" . $icon_name;

        // Di chuyển tệp tin biểu tượng vào thư mục đích
        if (move_uploaded_file($icon_temp, "../" . $icon_path)) {
            // Nếu tải lên thành công, cập nhật đường dẫn biểu tượng
            $icon = $icon_path;
        }
    }

    // Chuẩn bị câu lệnh SQL UPDATE
    $sql = "UPDATE monan SET tenmon='$tenmon', mamon='$mamon', giamon='$giamon', mota='$mota', img='$img', icon='$icon' WHERE idmon=$idmon";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if ($conn->query($sql) === TRUE) {
        header("Location: food.php");
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
    <title>Cập Nhật Món</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Cập Nhật Bàn</h2>
        <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
                <label for="mamon">Mã Món</label>
                <input type="text" class="form-control" id="mamon" name="mamon" value="<?php echo $mamon; ?>">
            </div>
            <div class="form-group">
                <label for="tenmon">Tên Món</label>
                <input type="text" class="form-control" id="tenmon" name="tenmon" value="<?php echo $tenmon; ?>">
            </div>
            <div class="form-group">
                <label for="giamon">Giá Món</label>
                <input type="number" class="form-control" id="giamon" name="giamon" value="<?php echo $giamon; ?>">
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Mô Tả Món</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="mota"><?php echo $mota;?></textarea>
            </div>
            <div class="form-group">
                <label for="img">IMG</label>
                <input type="file" class="form-control-file" name="img">
            </div>
            <div class="form-group">
                <label for="icon">ICON</label>
                <input type="file" class="form-control-file" name="icon" value="<?php echo $icon;?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Cập Nhật</button>
            <a href="food.php" class="btn btn-danger" >Quay Lại</a>
        </form>
    </div>
</body>
</html>
