<?php
include './include/connect.php';

function monan($result) {
    while($row = $result->fetch_assoc()) {
        $icon = $row['icon']; // Assuming you have a column named 'icon'
        $imgmon = $row['img']; // Assuming you have a column named 'img'
        $tenmon = $row['tenmon']; // Assuming you have a column named 'tenmon'
        $mota = $row['mota']; // Assuming you have a column named 'tenmon'
        $url = 'http://localhost:80/webcsdl/'; // Corrected URL assignment

        echo '<div class="box">
                <img class="image" src="'. $url . $imgmon . '" alt="">
                <div class="content">
                    <img src="'. $url . $icon . '" alt="">
                    <h3>'. $tenmon . '</h3>
                    <p>' . $mota . '</p>
                </div>
              </div>';
    }
}

function ban($result) {
    while($row = $result->fetch_assoc()) {
        $imgban = $row['img']; // Assuming you have a column named 'img'
        $tenban = $row['tenban']; // Assuming you have a column named 'tenban'
        $url = 'http://localhost:80/webcsdl/'; // Corrected URL assignment

        echo '<div class="box">
        <img src="'. $url . $imgban . '" alt="">
        <h3>' . $tenban . '</h3>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            </div>
            <form action="view/detail.php" method="get">
                <input type="hidden" name="idban" value="' . $row['idban'] . '">
                <button type="submit" class="btn">Xem</button>
            </form>
        </div>';

    }
}

function myIndex(){
    global $conn; // Assuming $conn is defined in connect.php
    $sql_food = "SELECT * FROM monan";
    $result_food = mysqli_query($conn, $sql_food);

    $sql_table = "SELECT * FROM dsban";
    $result_table = mysqli_query($conn, $sql_table);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./public/assest/css/main.css">
    <title>Home</title>
</head>
<body>
    <!--header section start-->
    <header>
        <a href="#" class="logo"><i class="fas fa-utensils"></i>Food</a>

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="#home">Trang chủ</a>
            <a href="#speciality">Danh mục</a>
            <a href="#popular">Nổi bật</a>
            <a href="#order">Đặt bàn</a>
            <a href="view/login.php">Account</a>
        </nav>
    </header>
    <!-- header section end-->

    <!--Home section start-->
    <section class="home" id="home">
        <div class="content">
            <h3>Carameldanso</h3>
            <p>Dịch vụ đặt bàn</p>
            <a href="#" class="btn">Đặt bàn ngay</a>
        </div>
        <div class="image">
            <img src="./public/img/Fast-food-design-Premium-vector-PNG.png" alt="">
        </div>
    </section>
    <!--Home section end-->

    <!--Speciality section start-->
    <section class="speciality" id="speciality">
        <h1 class="heading"><span>Món</span></h1>
        <div class="box-container">
            <?php
            if ($result_food->num_rows > 0) {
                monan($result_food);
            } else {
                echo "<div class='box'><p>Không có dữ liệu</p></div>";
            }
            ?>
        </div>
    </section>
    <!--Speciality section end-->
            
    <!--Popular section start-->
    <section class="popular" id="popular">
        <h1 class="heading">Đặt<span> bàn </span></h1>
        <div class="box-container">
            <?php
            if ($result_table->num_rows > 0) {
                ban($result_table);
            } else {
                echo "<div class='box'><p>Không có dữ liệu</p></div>";
            }
            ?>
        </div>
    </section>
    <!--Popular section end-->

    <!--Footer section start-->
    <section class="footer">
        <div class="share">
            <a href="" class="btn">facebook</a>
            <a href="" class="btn">twitter</a>
            <a href="" class="btn">instagram</a>
        </div>
        <h1 class="credit">Design by <span>Quoc "Hyuk" An</span> | Back-end By <span>Huy Hoàng</span> </br> all right reserved!</h1>
    </section>
    <!--Footer section end-->

    <!--Scroll top button-->
    <a href="#home" class="fas fa-angle-up" id="scroll-top"></a>

    <!--Loader-->
    <div class="loader-container">
        <img src="public/img/Rotating-Pizza-Slice-Preloader.gif"  alt="" />
    </div>

    <!--JavaScript-->
    <script src="public/assest/js/main.js"></script>
</body>
</html>
<?php
}
?>
