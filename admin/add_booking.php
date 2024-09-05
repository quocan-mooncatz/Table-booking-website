<?php
// Include file kết nối đến cơ sở dữ liệu
include '../include/check_session.php';
include '../include/connect.php';
$sql_2 = "SELECT * FROM monan";
$result_2 = mysqli_query($conn, $sql_2);

// Truy vấn cơ sở dữ liệu để lấy danh sách các bàn
$sql_ban = "SELECT * FROM dsban";
$result_ban = mysqli_query($conn, $sql_ban);

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Lấy dữ liệu từ form
    $tenkhachhang = $_POST["tenkhachhang"];
    $sdt = $_POST["sdt"];
    $ngay = $_POST["dateInput"];
    $gio = $_POST["timeInput"];
    $tonggia = $_POST["tonggia"];
    $bandat = $_POST["bandat"];
    $trangthai = $_POST["trangthai"];
    $ghichu = $_POST["ghichu"];

    // Lấy danh sách các món ăn đã chọn từ form
    if(isset($_POST['tenmon']) && is_array($_POST['tenmon'])) {
        $tenmon_array = $_POST['tenmon'];
        // Chuyển danh sách món ăn thành một chuỗi, cách nhau bởi dấu phẩy
        $tenmon = implode(", ", $tenmon_array);
    } else {
        // Nếu không có món ăn nào được chọn, gán giá trị mặc định
        $tenmon = "";
    }

    // Chuẩn bị câu lệnh SQL INSERT INTO
    $sql = "INSERT INTO bookings (tenkhachhang, sdt, ngay, gio, tonggia, bandat, tenmon, trangthai, ghichu) 
            VALUES ('$tenkhachhang', '$sdt', '$ngay', '$gio', '$tonggia', '$bandat', '$tenmon', '$trangthai', '$ghichu')";

    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if ($conn->query($sql) === TRUE) {
        header("Location: booking.php");
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
    <title>Thêm Đơn</title>
    	<link rel="stylesheet" href="..\public\assest\css\checkbox.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Đơn</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="tenkhachhang">Tên Khách Hàng:</label>
                <input type="text" class="form-control" id="tenkhachhang" name="tenkhachhang" required>
            </div>
            <div class="form-group">
                <label for="sdt">Số Điện Thoại</label>
                <input type="number" class="form-control" id="sdt" name="sdt" required>
            </div>
            <div class="form-group">
                <label for="dateInput">Chọn Ngày:</label>
                <input type="date" class="form-control" id="dateInput" name="dateInput" required>
            </div>
            <div class="form-group">
                <label for="timeInput">Chọn Giờ:</label>
                <input type="time" class="form-control" id="timeInput" name="timeInput" required>
            </div>
            <div class="form-group">
                <label for="bandat">Bàn Đặt:</label>
                <select class="form-control" id="bandat" name="bandat">
                <?php
                    // Hiển thị danh sách các bàn dưới dạng các lựa chọn
                    $tonggiaban = 0; // Khởi tạo biến tổng giá
                    while ($row_ban = mysqli_fetch_assoc($result_ban)) {
                        $tenban = $row_ban['tenban'];
                        $giaban = $row_ban['giaban'];
                        $selected = ($bandat == $tenban) ? 'selected' : ''; // Kiểm tra xem bàn có được chọn không

                        // Tính tổng giá nếu bàn được chọn
                        if ($selected) {
                            $tonggiaban += $giaban;
                        }

                        echo "<option value='$tenban' $selected>$tenban - $giaban.VND</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="select-size">
                <?php
                $tonggiamon = 0;
                $tenmon = ""; // Khởi tạo biến $tenmon với giá trị mặc định là chuỗi trống

            if (isset($_POST['tenmon']) && is_array($_POST['tenmon'])) {
                $tenmon_array = $_POST['tenmon'];
                // Chuyển danh sách món ăn thành một chuỗi, cách nhau bởi dấu phẩy
                $tenmon = implode(", ", $tenmon_array);
            }
                // Tạo một mảng để lưu trữ tên các món ăn đã được chọn từ dữ liệu đơn hàng
                $selected_monan = explode(", ", $tenmon);
                // Check if there are any rows returned
                if (mysqli_num_rows($result_2) > 0) {
                    while($row = mysqli_fetch_assoc($result_2)) {
                        // Sử dụng ID của món ăn làm ID của checkbox
                        $mamon = $row['idmon'];
                        // Sử dụng tên món ăn làm giá trị và nhãn của checkbox
                        $tenmon = $row['tenmon'];
                        $giamon = $row['giamon'];

                        // Kiểm tra xem món ăn có trong danh sách đã chọn hay không
                        $checked = in_array($tenmon,$selected_monan)? 'checked' : '';

                        echo "<input type='checkbox' id='$mamon' name='tenmon[]' value='$tenmon' $checked />";
                        echo "<label for='$mamon'>$tenmon - $giamon.VND</label>";
                        
                        if ($checked) {
                            $tonggiamon += $giamon; // Tính tổng giá món ăn
                        }
                    }
                }
                ?>
            </div>

            <div class="form-group">
                <label for="trangthai">Trạng thái:</label>
                <select class="form-control" id="trangthai" name="trangthai">
                    <option value="Chưa xác nhận">Chưa Xác Nhận</option>
                    <option value="Đã xác nhận">Đã Xác Nhận</option>
                    <option value="Đã hoàn thành">Hoàn Thành</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tonggia">Tổng giá</label>
                <?php
                //tinh tonggia
                    $tonggia = $tonggiaban + $tonggiamon
                ?>
                <input type="number" class="form-control" id="tonggia" name="tonggia" value="<?php echo $tonggia; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Ghi Chú</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="ghichu" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
            <a href="bookings.php" class="btn btn-danger" >Quay Lại</a>
        </form>
    </div>
</body>
<script src="../public/assest/js/update_total_price.js"></script>
</html>
