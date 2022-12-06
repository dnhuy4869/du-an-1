<?php

if (!isset($_GET["idSP"])) {
    header("location: shop.php?tab=2");
}

if (!isset($_SESSION["vuaMoiXem"])) {
    $_SESSION["vuaMoiXem"] = [];
}

include "../models/pdo.php";
include "../models/sanPham.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sản phẩm</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="admin/assets/images/favicon.png" rel="shortcut icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        .btn-addtocart {
            background: none;
            border: none;
            outline: none;
        }

        .btn-addtocart:hover {
            background: none;
            border: none;
            outline: none;
            color: #D19C97;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">C</span>Cake</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <?php
    include "../models/loaiHang.php";
    include "sidebar.php";

    $idSP = $_GET["idSP"];

    sanPham_tangLuotXem($idSP);

    ?>
    <!-- Navbar Start -->
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Cake Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Chi tiết sản phẩm</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->

            <!-- Shop Sidebar End -->

            <?php

            $currSP = sanPham_loadOne($idSP);

            $imgPath = "../images/sanPham/" . $currSP["hinh"];
            ?>

            <div class="container-fluid py-5">
                <div class="row px-xl-5">
                    <div class="col-lg-6 pb-5" style="height: 600px;">
                        <img class="img-fluid w-100 h-100" src="<?php echo $imgPath; ?>" alt="Image">
                    </div>

                    <div class="col-lg-6 pb-5">
                        <h3 class="font-weight-semi-bold">
                            <?php echo $currSP["tenSanPham"]; ?>
                        </h3>
                        <div class="d-flex mb-3">
                            <small class="pt-1">(50 Đánh giá)</small>
                        </div>
                        <h3 class="font-weight-semi-bold mb-4">$
                            <?php echo $currSP["gia"]; ?>
                        </h3>
                        <?php
                        $string = $currSP["moTa"];
                        if (strlen($string) > 500) {

                            // truncate string
                            $stringCut = substr($string, 0, 500);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                        }
                        echo '<p class="mb-4">' . $string . '</p>';
                        ?>
                        <form class="d-flex align-items-center mb-4 pt-2" action="cart.php?tab=4&act=themSP"
                            method="post">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <input type="number" name="soLuong" min="1"
                                    class="form-control bg-secondary text-center" value="1">
                            </div>

                            <input type="hidden" name="id" value="<?= $idSP ?>">
                            <input type="hidden" name="tenSP" value="<?= $currSP["tenSanPham"] ?>">
                            <input type="hidden" name="hinh" value="<?= $currSP["hinh"] ?>">
                            <input type="hidden" name="gia" value="<?= $currSP["gia"] ?>">
                            <button type="submit" name="themSP" class="btn btn-primary px-3"><i
                                    class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng </button>

                        </form>
                        <div class="d-flex pt-2">
                            <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô tả</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh giá (0)</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Mô tả</h4>
                                <p>
                                    <?php echo $currSP["moTa"]; ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-4">1 review for "
                                            <?php echo $currSP["tenSanPham"]; ?>"
                                        </h4>
                                        <div class="media mb-4">
                                            <img src="../img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                                style="width: 45px;">
                                            <div class="media-body">
                                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam
                                                    ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod
                                                    ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Your email address will not be published. Required fields are marked
                                            *</small>
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Your Rating * :</p>
                                            <div class="text-primary">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" cols="30" rows="5"
                                                    class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Your Review"
                                                    class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Có Thể Bạn Cũng Thích</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php
                $listSP = sanPham_loadLienQuan($currSP["idLoaiHang"], 5);
                foreach ($listSP as $sp) {
                    $img = "../images/sanPham/" . $sp["hinh"];
                    echo '<div class="card product-item border-0">
                    <a href="detail.php?idSP=' . $sp["id"] . '" class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" style="height: 300px;" src="' . $img . '" alt="">
                    </a>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">' . $sp["tenSanPham"] . '</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$' . $sp["gia"] . '</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="detail.php?tab=3&idSP=' . $sp["id"] . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Chi tiết</a>
                                    <form action="cart.php?tab=4&act=themSP" class="btn btn-sm text-dark p-0" method="post">
                                    <input type="hidden" name="id" value="' . $sp["id"] . '">
                                    <input type="hidden" name="tenSP" value="' . $sp["tenSanPham"] . '">
                                    <input type="hidden" name="hinh" value="' . $sp["hinh"] . '">
                                    <input type="hidden" name="gia" value="' . $sp["gia"] . '">
                                    <input type="hidden" name="soLuong" value="1">
                                    <button type="submit" name="themSP" class="btn-addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                </div>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php
    include "footer.php";
    ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../mail/jqBootstrapValidation.min.js"></script>
    <script src="../mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>