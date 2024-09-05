<?php
include '../include/check_session.php';
include '../include/connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])){
    $tenkhach = $_POST['tenkhach'];
    $sdt = $_POST['sdt'];
    $mail = $_POST['mail'];
    $matkhau = md5($_POST['matkhau']);

    // Kiểm tra xem sdt đã tồn tại trong cơ sở dữ liệu hay chưa
    $check_sql = "SELECT * FROM users WHERE sdt = '$sdt' AND mail = '$mail'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Nếu sdt không tồn tại, thêm người dùng mới
        $sql = "INSERT INTO users (tenkhach, sdt, mail, matkhau, phanquyen, ngaytao) 
                VALUES ('$tenkhach', '$sdt', '$mail', '$matkhau', 'user', NOW())";

        if($conn->query($sql) === TRUE){
            header("Location: user.php");
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Số Điện Thoại Hoặc Email Đã Tồn Tại')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Bàn</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="tenkhach">Tên Khách:</label>
                <input type="text" class="form-control" id="tenkhach" name="tenkhach" required>
            </div>
            <div class="form-group">
                <label for="sdt">Số Điện Thoại:</label>
                <input type="text" class="form-control" id="sdt" name="sdt" required>
            </div>
            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="text" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="matkhau">Mật Khẩu</label>
                <input type="text" class="form-control" id="matkhau" name="matkhau" required>
            </div>
            <button type="submit" class="btn btn-primary" name="signup">Thêm</button>
            <a href="user.php" class="btn btn-danger" >Quay Lại</a>
        </form>
    </div>
</body>
</html>


