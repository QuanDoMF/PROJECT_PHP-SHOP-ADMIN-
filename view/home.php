<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url('webroot/image/slider/img.jpg');">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 text-center slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h1 class="head-1">Men's</h1>
                                    <h2 class="head-2">Shoes</h2>
                                    <h2 class="head-3">Collection</h2>
                                    <p class="category"><span>New trending shoes</span></p>
                                    <p><a href="#bestSeller" class="btn btn-primary">Bộ sưu tập</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(webroot/image/slider/cover-img-1.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 text-center slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h1 class="head-1">Huge</h1>
                                    <h2 class="head-2">Sale</h2>
                                    <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                    <p class="category"><span>Big sale sandals</span></p>
                                    <p><a href="#bestSeller" class="btn btn-primary">Shop Collection</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(webroot/image/slider/img-2.jpg);">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3 text-center slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <h1 class="head-1">New</h1>
                                    <h2 class="head-2">Arrival</h2>
                                    <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
                                    <p class="category"><span>New stylish shoes for men</span></p>
                                    <p><a href="#bestSeller" class="btn btn-primary">Shop Collection</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
<div class="colorlib-intro">
    <div class="container">

    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div id="bestSeller" class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                <h2>Best Sellers</h2>
            </div>
        </div>
        <div class="row row-pb-md">
            <?php
    $prodcts = productAll();
    while ($row = mysqli_fetch_array($prodcts)) {
        // Check if SoLuong is not equal to 0
        if ($row['SoLuong'] != 0) {
            $price_sale = price_sale($row['MaSP'], $row['DonGia']);
    ?>
            <div class="col-lg-3 mb-4">
                <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>" class="prod-img">
                    <div class=" product-entry border">
                        <div class="card__heart">
                            <div class="product-lable">
                                <?php
                                if ($price_sale < $row['DonGia']) {
                                    echo '<span>Giảm ' . number_format($row['DonGia'] - $price_sale) . 'đ </span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card__cart">
                            <i class='bx bx-heart-alt'></i>
                        </div>
                        <div class="">
                            <img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>" class="img-fluid"
                                alt="Free html5 bootstrap 4 template">
                        </div>
                        <div class=" desc text-center">
                            <h2>
                                <p href="#"><?php echo $row['TenSP']; ?></p>
                            </h2>
                            <span class="price"><?php echo number_format($price_sale, 0) . '₫'; ?></span>
                            <?php
                            if (number_format($row['DonGia']) !== number_format($price_sale)) {
                            ?>
                            <span class="price-old"><?php echo number_format($row['DonGia'], 0) . ' ' . ' ₫'; ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
    }
    ?>
        </div>


        <div class="row">
            <div class="col-md-12 text-center">
                <p><a href="?view=products" class="btn btn-primary btn-lg">Shop All Products</a></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-partner">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>ĐỐI TÁC TIN CẬY</h2>
            </div>
        </div>
        <div class="row">
            <div class="col partner-col text-center">
                <img src="webroot/image/brand/brand-1.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="webroot/image/brand/brand-2.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="webroot/image/brand/brand-3.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="webroot/image/brand/brand-4.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
            <div class="col partner-col text-center">
                <img src="webroot/image/brand/brand-5.jpg" class="img-fluid" alt="Free html4 bootstrap 4 template">
            </div>
        </div>
    </div>
</div>