<?php
include_once('../../model/database.php');

// Thêm màu
if (isset($_GET['themmau'])) {
    $mamau = $_GET['mamau'];
    $sql = "INSERT INTO `mau` (`MaMau`) VALUES (N'$mamau')";
    $rs = mysqli_query($conn, $sql);
    if (isset($rs)) {
        header('location:../index.php?action=mau&view=themmau&thongbao=them');
    } else {
        header('location:../index.php?action=mau&view=themmau&thongbao=loi');
    }
}

// Cập nhật
if (isset($_GET['suamau'])) {
    $id = $_GET['id'];
    $mamau = $_GET['mamau'];
    
    // Cập nhật trong bảng mau
    $sqlMau = "UPDATE `mau` SET `MaMau` = N'$mamau' WHERE `MaMau` = '$id'";
    $rsMau = mysqli_query($conn, $sqlMau);

    // Cập nhật trong bảng chitietsanpham
    $sqlChitietSanpham = "UPDATE `chitietsanpham` SET `MaMau` = N'$mamau' WHERE `MaMau` = '$id'";
    $rsChitietSanpham = mysqli_query($conn, $sqlChitietSanpham);

    // Cập nhật trong bảng chitiethoadon
    $sqlChitietHoadon = "UPDATE `chitiethoadon` SET `MaMau` = N'$mamau' WHERE `MaMau` = '$id'";
    $rsChitietHoadon = mysqli_query($conn, $sqlChitietHoadon);

    // Cập nhật trong bảng phieuxuat
    $sqlPhieuxuat = "UPDATE `phieuxuat` SET `MaMau` = N'$mamau' WHERE `MaMau` = '$id'";
    $rsPhieuxuat = mysqli_query($conn, $sqlPhieuxuat);

    if (isset($rsMau) && isset($rsChitietSanpham) && isset($rsChitietHoadon) && isset($rsPhieuxuat)) {
        header('location:../index.php?action=mau&view=themmau&thongbao=sua');
    } else {
        header('location:../index.php?action=mau&view=themmau&thongbao=loi');
    }
}

// Xóa màu
if (isset($_GET['xoa'])) {
    $mamau = $_GET['mamau'];

    // Xóa trong bảng mau
    $sqlMau = "DELETE FROM `mau` WHERE `MaMau` = '$mamau'";
    $rsMau = mysqli_query($conn, $sqlMau);

    // Xóa trong bảng chitietsanpham
    $sqlChitietSanpham = "UPDATE `chitietsanpham` SET `MaMau` = 'none' WHERE `MaMau` = '$mamau'";
    $rsChitietSanpham = mysqli_query($conn, $sqlChitietSanpham);

    // Xóa trong bảng chitiethoadon
    $sqlChitietHoadon = "UPDATE `chitiethoadon` SET `MaMau` = 'none' WHERE `MaMau` = '$mamau'";
    $rsChitietHoadon = mysqli_query($conn, $sqlChitietHoadon);

    // Xóa trong bảng phieuxuat
    $sqlPhieuxuat = "UPDATE `phieuxuat` SET `MaMau` = 'none' WHERE `MaMau` = '$mamau'";
    $rsPhieuxuat = mysqli_query($conn, $sqlPhieuxuat);

    if (isset($rsMau) && isset($rsChitietSanpham) && isset($rsChitietHoadon) && isset($rsPhieuxuat)) {
        header('location:../index.php?action=mau&view=themmau&thongbao=xoa');
    } else {
        header('location:../index.php?action=mau&view=themmau&thongbao=loi');
    }
}
?>