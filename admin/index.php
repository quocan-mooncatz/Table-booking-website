<?php
include '../include/check_session.php';
include '../include/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="..\public\assest\css\admin.css">
	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../" class="brand">
			<i class='bx bxs-shield'></i>
			<span class="text">AdminPage</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="booking.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Đơn đặt bàn</span>
				</a>
			</li>
			<li>
				<a href="user.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Khách Hàng</span>
				</a>
			</li>
			<li>
				<a href="table.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Bàn</span>
				</a>
			</li>
			<li>
				<a href="food.php">
					<i class='bx bxs-basket' ></i>
					<span class="text">Món Ăn</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
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
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
				</div>
			</div>
    <!--3 BOX-->
			<ul class="box-info">
				<li>
					<i class='bx bxs-time'></i>
					<span class="text">
						<h3>1</h3>
						<p>Đơn đặt mới</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2</h3>
						<p>Người xem</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$25</h3>
						<p>Tổng thu nhập</p>
					</span>
				</li>
			</ul>
    <!--END 3 BOX-->
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3></h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
                                <th>Mã đơn</th>
								<th>Tên</th>
								<th>Số điện thoại</th>
                                <th>Loại bàn</th>
								<th>Tình trạng</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                                <td>1</td>
								<td>
									<p>An</p>
								</td>
								<td>027537274236</td>
                                <td>4 người</td>
								<td>
								<select>
									<span class="status completed">Hoàn thành</span>
									<span class="status pending">Đang chờ</span>
									<span class="status process">Đang xử lý</span>
								</select>
									</td>
							</tr>
							<tr>
                                <td>2</td>
								<td>
									<p>Hoàng</p>
								</td>
								<td>072374672</td>
                                <td>4 người</td>
								<td><span class="status pending">Đang chờ</span></td>
							</tr>
							<tr>
                                <td>3</td>
								<td>							
									<p>Vũ</p>
								</td>
								<td>09234626326</td>
                                <td>4 người</td>
								<td><span class="status process">Đang xử lý</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Ghi chú</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Ghi chú</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Ghi chú</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Ghi chú</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="..\public\assest\js\admin.js"></script>
</body>
</html>