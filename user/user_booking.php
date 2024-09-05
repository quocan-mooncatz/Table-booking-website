<?php
include '../include/check_session_user.php';
include '../include/connect.php';

$sdt = $_SESSION['sdt'];
$sql = "SELECT * FROM bookings WHERE sdt = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $sdt);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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
    <link rel="stylesheet" type="text/css" href="..\public\assest\css\table.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../" class="brand">
			<i class='bx bxs-shield'></i>
			<span class="text">Quản Lý</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="user_booking.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Đơn đặt bàn</span>
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
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main class="table" id="customers_table">
			<section class="table__header">
                <h1>Thông tin người đặt</h1>
                <div class="input-group">
                    <input type="search" placeholder="Search Data...">
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Tên <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Số Điện Thoài <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Ngày đặt <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Giờ Đặt<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Bàn Đặt<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Món ăn<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Trạng thái <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Tổng tiền <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Ghi Chú <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>"; 
                                    echo "<td>" . $row["tenkhachhang"] . "</td>"; 
                                    echo "<td>" . $row["sdt"] . "</td>";
                                    echo "<td>" . $row["ngay"] . "</td>";
                                    echo "<td>" . $row["gio"] . "</td>";
                                    echo "<td>" . $row["bandat"] . "</td>";
                                    echo "<td>" . $row["tenmon"] . "</td>";
                                    echo "<td>" . $row["trangthai"] . "</td>";
                                    echo "<td class='doigia'>" . $row["tonggia"] . "</td>";
                                    echo "<td>" . $row["ghichu"] . "</td>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </section>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

</body>
<script src="..\public\assest\js\order.js"></script>
<script src="..\public\assest\js\doigia.js"></script>
<script src="..\public\assest\js\admin.js"></script>
<script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa đơn này?');
        }
    </script>
</html>