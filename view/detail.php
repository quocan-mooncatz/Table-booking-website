<?php
include '../include/connect.php';
include '../include/check_session_user.php';

$sdt = $_SESSION['sdt'];


$sql_user = "SELECT * FROM users WHERE sdt='$sdt'";
$result_user = mysqli_query($conn, $sql_user);

// Kiểm tra và lấy giá trị $tenkhach từ kết quả truy vấn
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $tenkhach = $row_user['tenkhach']; // Lấy giá trị của tên khách hàng từ cơ sở dữ liệu
} else {
    // Xử lý trường hợp không có dữ liệu
    $tenkhach = $giabn = ""; // Gán giá trị mặc định hoặc thông báo lỗi
}

$sql_2 = "SELECT * FROM monan";
$result_2 = mysqli_query($conn, $sql_2);

// Truy vấn cơ sở dữ liệu để lấy thông tin các bàn
$sql_ban = "SELECT * FROM dsban";
$result_ban = mysqli_query($conn, $sql_ban);
$imgban = $tenban = $giamon = $soghe = $mota = ""; // Khởi tạo các biến

$url = 'http://localhost:80/webcsdl/'; // Corrected URL assignment

// Kiểm tra và lấy giá trị $tenban từ kết quả truy vấn
if ($result_ban && mysqli_num_rows($result_ban) > 0) {
    // Khai báo một mảng để lưu trữ thông tin về các bàn
    $ban_array = array();
    while ($row_ban = mysqli_fetch_assoc($result_ban)) {
        // Lấy thông tin về mỗi bàn và lưu vào mảng
        $ban_array[] = $row_ban;
    }
} else {
    // Xử lý trường hợp không có dữ liệu hoặc thông báo lỗi
    // Ở đây, bạn có thể gán giá trị mặc định hoặc thông báo lỗi theo ý muốn
}

// Bây giờ bạn có thể sử dụng mảng $ban_array để lấy thông tin về các bàn
// Ví dụ:
foreach ($ban_array as $row_ban) {
    $imgban = $row_ban['img'];
    $tenban = $row_ban['tenban'];
    $giaban = $row_ban['giaban'];
    $soghe = $row_ban['soghe'];
    $mota = $row_ban['mota'];

    // Thực hiện xử lý hoặc hiển thị thông tin về các bàn ở đây
}



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
    VALUES ('$tenkhachhang', '$sdt', '$ngay', '$gio', '$tonggia', '$bandat', '$tenmon', 'Chưa xác nhận', '$ghichu')";


    // Thực thi câu lệnh SQL và kiểm tra kết quả
    if ($conn->query($sql) === TRUE) {
        header("Location: ../");
    } else {
        echo "<div class='alert alert-danger mt-3' role='alert'>Lỗi: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Product Card/Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../public/assest/css/detail.css">
<link rel="stylesheet" href="../public/assest/css/checkbox.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
<div class="container" id="blur">
<header>
    <a href="main.html" class="logo"><i class="fas fa-utensils"></i>Food</a>

    <div id="menu-bar" class="fas fa-bars"></div>

    <nav class="navbar">
            <a href="#home">Trang chủ</a>
            <a href="#speciality">Danh mục</a>
            <a href="#popular">Nổi bật</a>
            <a href="#order">Đặt bàn</a>
            <a href="../view/login.php">Account</a>
        </nav>
</header>

<div class = "card-wrapper">
  <div class = "card">
    <!-- card left -->
    <div class = "product-imgs">
      <div class = "img-select">
        <div class = "img-item">
          <a href = "#" data-id = "1">
            <?php
              echo '<img class="image" src="'. $url . $imgban . '" alt="">;';
            ?>
          </a>
        </div>
      </div>
    </div>
    <!-- card right -->
    <div class = "product-content">
      <h2 class = "product-title"><?php echo $tenban; ?></h2>
      <a href = "main.html" class = "product-link">Trang chủ</a>
      <div class = "product-rating">
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star"></i>
        <i class = "fas fa-star-half-alt"></i>
        <span>4.7(21)</span>
      </div>

      <div class = "product-price">
      <p class='new-price'>Giá: <span><?php echo $giaban;?>.VND</span></p>        
      </div>

      <div class = "product-detail">
        <h2>Mô tả: </h2>
        <P><?php echo $mota; ?></P>
        <ul>
          <li>Số Ghế: <span><?php echo $soghe; ?></span></li>
          <li>Tình trạng: <span>Còn bàn</span></li>
        </ul>
      </div>

      <div class = "purchase-info">
        <button type = "button" class = "btn" onclick="toggle()">
          Đặt ngay 
        </button>
      </div>
    </div>
  </div>
</div>
</div>

<div>
<section class="order" id="order">
  <h1 class="heading"><span>Đặt bàn</span> ngay </h1>
  <div class="row">
  <form action="" method="post">
    <div class="inputBox">
        <input type="text" value="<?php echo $tenkhach; ?>" name="tenkhachhang" readonly>
        <input type="tel" value="<?php echo $sdt; ?>" name="sdt" readonly>
        <input type="date" name="dateInput" placeholder="Ngày hẹn">
        <input type="time" name="timeInput" placeholder="Giờ">
    </div>
    <div class="inputBox">
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
                while ($row = mysqli_fetch_assoc($result_2)) {
                    // Sử dụng ID của món ăn làm ID của checkbox
                    $mamon = $row['idmon'];
                    // Sử dụng tên món ăn làm giá trị và nhãn của checkbox
                    $tenmon = $row['tenmon'];
                    $giamon = $row['giamon'];

                    // Kiểm tra xem món ăn có trong danh sách đã chọn hay không
                    $checked = in_array($tenmon, $selected_monan) ? 'checked' : '';

                    echo "<input type='checkbox' id='$mamon' name='tenmon[]' value='$tenmon' $checked />";
                    echo "<label for='$mamon'>$tenmon - $giamon.VND</label>";

                    if ($checked) {
                        $tonggiamon += $giamon; // Tính tổng giá món ăn
                    }
                }
            }
            ?>
        </div>
        <?php
// Trong phần xử lý form
$tonggiaban = 0;
if (isset($_GET['idban'])) {
    // Lấy giá trị của idban từ URL
    $idban = $_GET['idban'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin của bàn dựa trên idban
    $sql = "SELECT * FROM dsban WHERE idban = $idban";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra xem có bàn nào tương ứng với idban không
    if (mysqli_num_rows($result) > 0) {
        // Lặp qua các hàng kết quả
        while ($row_ban = mysqli_fetch_assoc($result)) {
            $tenban = $row_ban['tenban'];
            $giaban = $row_ban['giaban'];

            // Hiển thị thông tin của bàn
            echo "<input type='text' id='bandat' name='bandat' value='$tenban' readonly>";

            // Tính tổng giá các bàn
            $tonggiaban += $giaban;
        }
    } else {
        echo "Không tìm thấy thông tin cho idban: $idban";
    }
} else {
    // Nếu không có idban trong URL, hiển thị thông báo
    echo "Không có idban được cung cấp trong URL.";
}
?>


        <?php
        // Tính tổng giá
        $tonggia = $tonggiaban + $tonggiamon;
        ?>
        <input type="number" id="tonggia" name="tonggia" value="<?php echo $tonggia?>" readonly>
    </div>
    <textarea placeholder="Ghi chú" name="ghichu" id="ghichu" cols="30" rows="10"></textarea>
    <input type="submit" class="btn btn-outline-danger" name="submit" value="Đặt ngay">
    <button type="button" class="btn btn-outline-danger" onclick="toggle()">Hủy</button>
</form>
</div>
</section>
</div>
</body>
<script src="../public/assest/js/detail.js"></script>
<script src="../public/assest/js/update_total_price_user.js"></script>
</html>
