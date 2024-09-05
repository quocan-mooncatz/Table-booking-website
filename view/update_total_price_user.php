<?php
include '../include/connect.php';

// Lấy dữ liệu từ yêu cầu POST
$bandat = $_POST['bandat'];
$tenmon_array = isset($_POST['tenmon']) ? $_POST['tenmon'] : array();

// Khởi tạo biến tổng giá
$tonggiaban = 0;
$tonggiamon = 0;

// Tính tổng giá từ bàn đặt
$sql_ban = "SELECT giaban FROM dsban WHERE tenban = '$bandat'";
$result_ban = mysqli_query($conn, $sql_ban);
if (mysqli_num_rows($result_ban) > 0) {
    $row_ban = mysqli_fetch_assoc($result_ban);
    $tonggiaban = $row_ban['giaban'];
}

// Tính tổng giá từ các món ăn được chọn
foreach ($tenmon_array as $tenmon) {
    $sql_mon = "SELECT giamon FROM monan WHERE tenmon = '$tenmon'";
    $result_mon = mysqli_query($conn, $sql_mon);
    if (mysqli_num_rows($result_mon) > 0) {
        $row_mon = mysqli_fetch_assoc($result_mon);
        $tonggiamon += $row_mon['giamon'];
    }
}

// Tổng giá tổng cộng
$tonggia = $tonggiaban + $tonggiamon;

// Trả về tổng giá dưới dạng văn bản
echo $tonggia;
?>
