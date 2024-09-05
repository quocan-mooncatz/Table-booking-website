<?php
include '../include/check_session.php';
include '../include/connect.php';

$sql = "SELECT * FROM dsban";
$result = mysqli_query($conn, $sql);

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
            <span class="text">AdminPage</span>
        </a>
        <ul class="side-menu top">
            <li>
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
            <li class="active">
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

        <!-- MAIN -->
        <main  class="table" id="customers_table">
            <section class="table__header">
                <h1>Thông tin người đặt</h1>
                <div class="input-group">
                    <input type="search" placeholder="Search Data...">
                </div>
                <div>
                    <a href="add_table.php" class="btn btn-outline-success">Thêm</a>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Tên bàn <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Số người <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Tổng tiền <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Ảnh Bàn <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Mô Tả Bàn <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Hành Động <span></span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["tenban"] . "</td>"; 
                                echo "<td>" . $row["soghe"] . "</td>";
                                echo "<td class='doigia'>" . $row["giaban"] . "</td>";
                                echo "<td>" . $row["img"] . "</td>";
                                echo "<td>" . $row["mota"] . "</td>";
                                echo "<td class='btn-form'>
                                        <a class='btn btn-outline-primary' href='update_table.php?idban=" . $row["idban"] . "'>Sửa</a>
                                        <a class='btn btn-outline-danger' onclick='return confirmDelete()' href='delete_table.php?idban=" . $row["idban"] . "'>Xóa</a>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    
    <script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa bàn này?');
        }
    </script>
<script src="..\public\assest\js\order.js"></script>
<script src="..\public\assest\js\doigia.js"></script>
<script src="..\public\assest\js\admin.js"></script>
</body>
</html>
