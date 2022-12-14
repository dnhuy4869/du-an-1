<?php
include "../models/pdo.php";

session_start();

if (isset($_POST["login"])) {
    $isError = false;
    $tenTK = $_POST["tenTK"];
    $matKhau = $_POST["matKhau"];

    if (empty($tenTK) && !$isError) {
        $isError = true;
        $thongBao = "Vui lòng nhập tên tài khoản";
    }
    
    if (empty($matKhau) && !$isError) {
        $isError = true;
        $thongBao = "Vui lòng nhập mật khẩu";
    }

    if (!$isError) {
        $result = pdo_query_one("select * from nguoidung where tenTaiKhoan='$tenTK' and matKhau='$matKhau' limit 1");
        if (!$result) {
            $thongBao = "Đăng nhập thất bại.";
        } else {
            $_SESSION["user"] = $result;

            echo ("<script>location.href = '../index.php?act=trangChu';</script>");
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center mb-2">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Đăng nhập</h3>
                        <form action="login.php" class="login-form" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" name="tenTK"
                                    placeholder="Tên đăng nhập">
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="matKhau"
                                    placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login"
                                    class="form-control btn btn-primary rounded submit px-3" value="Login"></input>
                            </div>
                            <?php
                            if (isset($thongBao)) {
                                echo '<div class="alert alert-danger" role="alert">
                                ' . $thongBao . '
                              </div>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>