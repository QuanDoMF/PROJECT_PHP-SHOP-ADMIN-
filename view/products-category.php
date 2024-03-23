<?php
$query_pro = false; // Initialize $query_pro to avoid "Undefined variable" warning
$view = $_GET['view'];
switch ($view) {
    case 'products-category':
        $products = product_category($_GET['id']); 
        break;
    case 'products-search':
        $key = isset($_POST['tukhoa']) ? $_POST['tukhoa'] : '';
        $products = product_search($key);        
        break;
    default:
        # code...
        break;
}


 ?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="?view">Trang Chủ</a></span> / <span>Sản phẩm</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-md">
            <?php
            if ($query_pro || $products) {
                $result_set = $query_pro ? $query_pro : $products;

                while ($row = mysqli_fetch_array($result_set)) {
                    $price_sale = price_sale($row['MaSP'], $row['DonGia']);
                    ?>
            <div class="col-lg-3 mb-4 ">
                <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>" class="prod-img">
                    <div class=" product-entry border">
                        <div class="card__heart">
                            <div class="product-lable">
                                <?php $price_sale=price_sale($row['MaSP'],$row['DonGia']); if($price_sale < $row['DonGia']) { 
                      echo '<span>Giảm '.number_format( $row['DonGia'] - $price_sale).'đ </span>';}?>
                            </div>
                        </div>
                        <div class="card__cart">
                            <i class='bx bx-alt'></i>
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
            <?php }
                    }else {
                        echo "No results found.";
                    }
            ?>
        </div>
    </div>
</div>