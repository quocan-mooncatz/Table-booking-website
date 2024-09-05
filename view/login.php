<?php
include '../include/connect.php';
session_start();
if (isset($_SESSION['sdt'])){
  if ($_SESSION['phanquyen'] == 'admin') {
    // Nếu không, chuyển hướng người dùng đến trang người dùng
    header("Location: ../admin/index.php");
    exit;
  }
  // Nếu không có session, chuyển hướng người dùng đến trang đăng nhập
  header("Location: ../user/index.php"); 
  exit();
}

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $sdt = $_POST['sdt'];
        $matkhau = $_POST['matkhau'];
    
        // Kiểm tra tên đăng nhập và mật khẩu
        $sql = "SELECT * FROM users WHERE sdt=?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $sdt);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if ($user && $user['matkhau'] == md5($matkhau)) {
            session_start();
            $_SESSION['sdt'] = $sdt;
            $_SESSION['phanquyen'] = $user['phanquyen'];
            if ($user['phanquyen'] == 'admin') {
                header("Location: ../admin/index.php"); // Sử dụng URL tương đối
                exit();
            } elseif ($user['phanquyen'] == 'user') {
                header("Location: ../user/index.php"); // Sử dụng URL tương đối
                exit();
            }
        } else {
            echo "<script>alert('Số Điện Thoại hoặc mật khẩu không đúng')</script>";
        }
    }

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
            echo "<script>alert('Đăng ký thành công')</script>";
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
        <script src="https://kit.fontawesome.com/981b25ecf7.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../public/assest/css/login.css">
        <title>Main</title>
    </head>
    <body>
        <div class="container">
            <div class="forms-container">
              <div class="signin-signup">
                   <!-- Form Đăng Nhập-->
                <form action="" method="POST" class="sign-in-form">
                  <h2 class="title">Đăng Nhập</h2>
                  <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="tel" placeholder="Số Điện Thoại" name="sdt"/>
                  </div>
                  <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Mật khẩu" name="matkhau"/>
                  </div>
                  <input type="submit" value="Đăng Nhập" class="btn solid" name="login"/>
                  <p class="social-text">Or Sign in with social platforms</p>
                  <div class="social-media">
                    <a href="#" class="social-icon">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-google"></i>
                    </a>
                  </div>
                </form>
                <!-- Form Đăng ký-->
                <form action="" method="POST" class="sign-up-form">
                  <h2 class="title">Đăng Ký</h2>
                  <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Họ và tên" name="tenkhach" required />
                  </div>
                  <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="tel" placeholder="Sô điện thoại" name="sdt" required />
                  </div>
                  <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="mail" required/>
                  </div>
                  <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Mật khẩu" name="matkhau" required/>
                  </div>
                  <input type="submit" class="btn" value="Đăng ký" name="signup"/>
                  <p class="social-text">Or Sign up with social platforms</p>
                  <div class="social-media">
                    <a href="#" class="social-icon">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-google"></i>
                    </a>
                  </div>
                </form>
              </div>
            </div>
               <!-- Chữ Nổi Switch form-->
            <div class="panels-container">
              <div class="panel left-panel">
                <div class="content">
                  <h3>Những vị khách mới ư ?</h3>
                  <p>
                    Ấn vào đây để đăng kí tài khoản và đặt bàn ngay
                  </p>
                  <button class="btn transparent" id="sign-up-btn">
                    Đăng ký
                  </button>
                </div>
                <img src="../public/img/undraw_conversation_re_c26v.svg" class="image" alt="" />
              </div>
              <div class="panel right-panel">
                <div class="content">
                  <h3>Đã có tài khoản ?</h3>
                  <p>
                    Đăng nhập để sử dụng dịch vụ đặt bàn!
                  </p>
                  <button class="btn transparent" id="sign-in-btn">
                    Đăng nhập
                  </button>
                </div>
                <img src="../img/undraw_studying_re_deca.svg" class="image" alt="" />
              </div>
            </div>
          </div>
          <script src="../public/assest/js/login.js"></script>
    </body>
    </html>
