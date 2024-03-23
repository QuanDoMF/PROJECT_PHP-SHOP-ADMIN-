<?php
    if (isset($_GET['id'])==false) {header('Location:?view'); }
    $id = $_GET['id'];
    if ( product($id)==false) { header('Location:?view');}
    $product=mysqli_fetch_array(product($id));  
    $price_sale=price_sale($product['MaSP'],$product['DonGia']);
    $product_detail_size=product_detail_size($id);
    $product_detail_color=product_detail_color($id);
    $product_review=product_review($id);
    if(product_detail_image($id)==false){$product_detail_image=array('Anh1'=>'loader.gif','Anh2'=>'loader.gif','Anh3'=>'loader.gif','Anh4'=>'loader.gif'); }else{ $product_detail_image=mysqli_fetch_array(product_detail_image($id));}


?>
<style>
.color-wrap {
    display: none;
}
</style>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="?view">Trang chủ</a></span> / <span>Chi tiết sản phẩm<menu
                            type="context"></menu></span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg product-detail-wrap">
            <div class="col-sm-8">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh1'] ?>"
                                    class="img-fluid" alt="Quân Code">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh2'] ?>"
                                    class="img-fluid" alt="Quân Code">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh3'] ?>"
                                    class="img-fluid" alt="Quân Code">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh4'] ?>"
                                    class="img-fluid" alt="Quân Code">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form class="col-sm-4" action="?view=addtocart" method="post" id="form1">
                <div class="product-desc">
                    <h3><?php echo $product['TenSP']; ?></h3>
                    <p class="price">
                        <span><?php echo number_format($price_sale,0).'₫'; ?></span>
                        <?php if(number_format($product['DonGia']) !== number_format($price_sale)){ ?>
                        <span class="price-old"><?php echo  number_format($product['DonGia'], 0 ).' '.' ₫' ; ?></span>
                        <?php } ?>
                        <span class="rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </p>
                </div>
                <div class="size-wrap">
                    <div class="block-26 mb-2">
                        <h4 id="quantity-info-label">Size</h4>
                        <?php 
                        $productDetailSize = product_detail_size($id);

                        if ($productDetailSize !== false) {
                            while ($sizeRow = mysqli_fetch_assoc($productDetailSize)) {
                                $maSize = $sizeRow['MaSize'];
                                $soLuong = $sizeRow['SoLuong'];
                        ?>
                        <div class="box-size">
                            <input type="radio" class="custom-control-input size-radio" id="<?php echo $maSize; ?>"
                                name="size" value="<?php echo $maSize; ?>" required
                                onclick="updateSelectedSize('<?php echo $maSize; ?>')"
                                <?php echo ($soLuong == 0) ? 'disabled' : ''; ?>>

                            <label class="custom-control-label" for="<?php echo $maSize; ?>">
                                <h6><?php echo $maSize; ?></h6>
                            </label>
                            <span class="quantity-info" data-size="<?php echo $maSize; ?>"
                                style="display:none;"><?php echo $soLuong; ?></span>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>



                <div class="color-wrap">
                    <div class="size-wrap">
                        <div class="block-26 mb-2">
                            <h4>Màu</h4>
                            <?php while ($row = (mysqli_fetch_array($product_detail_color))) { ?>
                            <div class="box-mau">
                                <input type="radio" class="custom-control-input" id="<?php echo $row['MaMau']; ?>"
                                    name="mau" value="<?php echo $row['MaMau']; ?>" required
                                    onclick="updateSelectedColor('<?php echo $row['MaMau']; ?>')">

                                <label class="custom-control-label" for="<?php echo $row['MaMau']; ?>">
                                    <h6><?php echo $row['MaMau']; ?></h6>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>




                <div class="input-group mb-4">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn" id="tru"><i
                                class="fas fa-minus"></i></button>
                    </span>
                    <input type="text" id="soluong" name="soluong" id="soluong" class="form-control input-number"
                        value="1" min="1">
                    <span class="input-group-btn ml-1">
                        <button type="button" class="quantity-right-plus btn" id="cong"> <i
                                class="fas fa-plus"></i></button>
                    </span>
                </div>

                <input type="hidden" name="idproduct" form="form1" value='<?php echo $product['MaSP'] ?>'>
                <input type="hidden" name="dongia" form="form1" value='<?php echo number_format($price_sale) ?>'>
                <div class="col-sm-12 text-center">
                    <p class="addtocart"><button type="submit" form="form1" name='addtocart'
                            class="btn col-sm-12 btn-primary" onclick="return validateForm()">
                            Thêm vào giỏ hàng
                        </button>
                    </p>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill"
                                        href="#pills-description" role="tab" aria-controls="pills-description"
                                        aria-expanded="true">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review"
                                        role="tab" aria-controls="pills-review" aria-expanded="true">Đánh giá</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane border fade show active" id="pills-description" role="tabpanel"
                                    aria-labelledby="pills-description-tab">
                                    <p><?php echo $product['MoTa'] ?></p>
                                </div>
                                <div class="tab-pane border fade" id="pills-review" role="tabpanel"
                                    aria-labelledby="pills-review-tab">
                                    <div class="cmt-box">
                                        <form action="?view=addtoreview" method="post" id='form2'>
                                            <textarea name="noidung" id="noidung"
                                                placeholder="Viết đánh giá  ..."></textarea>
                                            <input type="hidden" name="masp" form="form2"
                                                value='<?php echo $product['MaSP'] ?>'>
                                            <button form='form2' name="action" value="binhluan" type="submit"
                                                class="btn btn-primary alert-danger">Đánh giá</button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="head">
                                                <?php if($product_review==false){ echo "Chưa có đánh giá nào~~~";}else{ echo mysqli_num_rows($product_review) .' Đánh giá'  ;?>
                                            </h3>
                                            <?php while($row=mysqli_fetch_array($product_review))  { $rowkh=selectKH($row['MaKH']) ?>
                                            <div class="review">
                                                <div class="user-img"
                                                    style="background-image: url('webroot/image/logo/user.png')"></div>
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left"><?php echo $rowkh['TenKH'] ?></span>
                                                        <span class="text-right"><?php echo $row['ThoiGian'] ?></span>
                                                    </h4>
                                                    <p class="star">
                                                        <span>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </span>

                                                    </p>
                                                    <p><?php echo $row['NoiDung'] ?></p>
                                                </div>
                                            </div>
                                            <?php } }?>




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_GET['alert'])){ ?>
<div id="alertDiv" class="alert alert-success alert-dismissible fade custom-alert " role="alert">
    <strong> <?php if($_GET['alert']!==''){ echo ' '.$_GET['alert'];} ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php  }
?>

<script>
var selectedSize = '';
var selectedColor = '';

function updateSelectedSize(size) {
    selectedSize = size;

}

function updateSelectedColor(color) {
    selectedColor = color;

}


document.addEventListener('DOMContentLoaded', function() {
    var soluongInput = document.getElementById('soluong');
    var quantityLeftMinusBtn = document.getElementById('tru');
    var quantityRightPlusBtn = document.getElementById('cong');

    // Assuming variationQuantity is the available quantity, replace it with the actual value
    var variationQuantity = parseInt(document.querySelector('.quantity-info').innerText) || 1;

    quantityLeftMinusBtn.addEventListener('click', function() {
        updateQuantity(-1);
    });

    soluongInput.addEventListener('input', function() {
        validateQuantity();
    });

    function updateQuantity(change) {
        var currentValue = parseInt(soluongInput.value) || 1;
        var newValue = currentValue + change;

        soluongInput.value = Math.min(Math.max(newValue, 1), variationQuantity);

        validateQuantity();
    }

    function validateQuantity() {
        soluongInput.value = soluongInput.value.replace(/\D/g, ''); // Remove non-numeric characters
        var numericValue = parseInt(soluongInput.value) || 1;

        soluongInput.value = Math.min(Math.max(numericValue, 1), variationQuantity);
    }
});


document.addEventListener('DOMContentLoaded', function() {
    var sizeRadios = document.querySelectorAll('.size-radio');
    var quantityInfoLabel = document.getElementById('quantity-info-label');

    sizeRadios.forEach(function(radio) {
        radio.addEventListener('click', function() {
            var selectedSize = this.value;
            var quantityInfo = document.querySelector('.quantity-info[data-size="' +
                selectedSize + '"]');

            if (quantityInfo) {
                quantityInfoLabel.innerText = 'Size: ' + selectedSize +
                    ', Số lượng: ' + quantityInfo.innerText;
            }
        });
    });
});





document.addEventListener('DOMContentLoaded', function() {
    var sizeRadios = document.querySelectorAll('.size-radio');
    var colorRadios = document.querySelectorAll('.custom-control-input[name="mau"]');

    sizeRadios.forEach(function(sizeRadio) {
        sizeRadio.addEventListener('click', function() {
            var selectedSize = this.value;

            // Disable color options with quantity 0 for the selected size
            colorRadios.forEach(function(colorRadio) {
                var quantity = colorRadio.getAttribute('data-quantity');
                colorRadio.disabled = (quantity === '0');

                // Add a class to make the disabled colors less prominent
                if (colorRadio.disabled) {
                    colorRadio.parentNode.classList.add('disabled-color');
                } else {
                    colorRadio.parentNode.classList.remove('disabled-color');
                }
            });
        });
    });
});



// function updateMauOptions() {
//     var selectedSize = document.getElementById("maSizeSelect").value;
//     var colorRadios = document.querySelectorAll('.custom-control-input[name="mau"]');

//     colorRadios.forEach(function(colorRadio) {
//         var mauSize = colorRadio.value.split('_'); // Giả sử giá trị MaMau có dạng "MaMau_MaSize"
//         var mau = mauSize[0];
//         var size = mauSize[1];

//         // Kiểm tra nếu MaSize không khớp hoặc SoLuong là 0, thì disable radio button đó
//         if (size !== selectedSize || colorRadio.getAttribute('data-quantity') === '0') {
//             colorRadio.disabled = true;
//             colorRadio.parentNode.classList.add('disabled-color');
//         } else {
//             colorRadio.disabled = false;
//             colorRadio.parentNode.classList.remove('disabled-color');
//         }
//     });
// }

// Gọi hàm updateMauOptions lần đầu khi trang load
document.addEventListener('DOMContentLoaded', function() {
    updateMauOptions();
});




function validateForm() {
    var sizeRadios = document.getElementsByName('size');
    var mauRadios = document.getElementsByName('mau');

    // Check if a size is selected
    var sizeSelected = false;
    for (var i = 0; i < sizeRadios.length; i++) {
        if (sizeRadios[i].checked) {
            sizeSelected = true;
            break;
        }
    }

    // Check if a color is selected
    var mauSelected = false;
    for (var i = 0; i < mauRadios.length; i++) {
        if (mauRadios[i].checked) {
            mauSelected = true;
            break;
        }
    }

    // Display an alert if size or color is not selected
    if (!sizeSelected) {
        alert('Vui lòng chọn kích cỡ trước khi thêm vào giỏ hàng.');
        return false; // Prevent form submission
    }


    return true; // Allow form submission
}



document.addEventListener("DOMContentLoaded", function() {
    // Select the first color option when the page loads
    var firstColorOption = document.querySelector('.color-wrap input[type="radio"]');
    if (firstColorOption) {
        firstColorOption.checked = true;
        // Optionally, you can trigger the updateSelectedColor function
        // assuming you have it defined for handling color changes
        updateSelectedColor(firstColorOption.value);
    }
});
</script>