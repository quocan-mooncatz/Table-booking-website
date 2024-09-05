<?php
include '../include/connect.php';
include '../include/check_session_user.php';

$sdt = $_SESSION['sdt'];

$sql_user = "SELECT * FROM users WHERE sdt='$sdt'";
$result_user = mysqli_query($conn, $sql_user);

// Kiểm tra và lấy giá trị $tenkhach và $mail từ kết quả truy vấn
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $tenkhach = $row_user['tenkhach']; // Lấy giá trị của tên khách hàng từ cơ sở dữ liệu
    $mail = $row_user['mail']; // Lấy giá trị của email từ cơ sở dữ liệu
} else {
    // Xử lý trường hợp không có dữ liệu
    $tenkhach = $mail = ""; // Gán giá trị mặc định hoặc thông báo lỗi
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Lấy dữ liệu từ form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Lấy mật khẩu hiện tại từ cơ sở dữ liệu
    $sql = "SELECT matkhau FROM users WHERE sdt='$sdt'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['matkhau'];

    // Kiểm tra mật khẩu hiện tại
    if (md5($current_password) === $stored_password) {
        // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới có khớp nhau không
        if ($new_password === $confirm_password) {
            // Mã hoá mật khẩu mới bằng MD5
            $hashed_password = md5($new_password);

            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $update_sql = "UPDATE users SET matkhau='$hashed_password' WHERE sdt='$sdt'";
            $result_update = mysqli_query($conn, $update_sql);

            if ($result_update) {
                echo '<script>alert("Thay đổi mật khẩu thành công!!!");</script>';
                exit();
            } else {
                echo '<script>alert("Thay đổi mật khẩu không thành công!!!");</script>';
                exit();
            }
        } else {
            echo '<script>alert("Mật khaảu không khớp!!!");</script>';
        }
    } else {
        echo '<script>alert("Mật khẩu hiện tại không đungs!!!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- My CSS -->
	<link rel="stylesheet" href="..\public\assest\css\admin.css">

	<title>User</title>
</head>
<body>


	<!-- SIDEBAR -->
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../" class="brand">
			<i class='bx bxs-shield'></i>
			<span class="text">Quản Lý</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Thông Tin</span>
				</a>
			</li>
			<li>
				<a href="user_booking.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Đơn Đã Đặt</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../admin/logout.php" class="logout">
					<i class='bx bx-log-out' ></i>
					<span class="text">Đăng xuất</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVIGATION -->
		<nav>
			<i class='bx bx-menu' ></i>
		</nav>

		<!-- MAIN -->
        <div class="container light-style flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-4">
                Chỉnh sửa tài khoản
            </h4>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">Chung</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-change-password">Đổi mật khẩu</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                               
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Họ Và Tên</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $tenkhach;?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input type="nunber" class="form-control" value="<?php echo $sdt;?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $mail;?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label class="form-label">Mật Khẩu Hiện Tại</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Mật Khẩu Mới</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nhập Lại Mật Khẩu Mới</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                    <div class="text-right mt-3">
                                        <input type="submit" class="btn btn-primary" value="Cập Nhật Mật Khẩu Mới"></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
    
        </script>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="..\public\assest\js\admin.js"></script>
</body>
</html>