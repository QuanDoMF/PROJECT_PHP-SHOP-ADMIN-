<?php
include_once('../../model/database.php');
	// Thêm Sản Phẩm
		if(isset($_POST['xlthem'])){
			$tensp=$_POST['tensp'];
			$madm=$_POST['madm'];
			$mancc=$_POST['mancc'];
			$dongia=$_POST['dongia'];
			$anhnen=$_FILES['anhnen']['name'];
			$AnhSP_tmp=$_FILES['anhnen']['tmp_name'];
			move_uploaded_file($AnhSP_tmp,'../../webroot/image/sanpham/'.$anhnen);
			$size=$_POST['size'];
			$mau=$_POST['mau'];
			if(isset($_POST['mota'])){$mota=$_POST['mota'];}else{$mota=NULL;}
     		$sql_them=" INSERT INTO `sanpham`(`MaSP`, `TenSP`, `MaDM`, `MaNCC`, `MoTa`, `DonGia`, `AnhNen`) VALUES (NULL,'$tensp',$madm,$mancc,'$mota',$dongia,'$anhnen')";
			$rs_them=mysqli_query($conn,$sql_them);
				if(isset($rs_them)){
					$sql_masp="select MaSP from sanpham where TenSP='$tensp' ORDER BY MaSP DESC";
					$sr=mysqli_query($conn,$sql_masp);$qk=mysqli_fetch_array($sr);	
					if(isset($qk)){
						(int) $so =$qk['MaSP'];
						 foreach ($size as $key1 => $values1){
						 	foreach ($mau as $key => $values) {
								$sql_ctsp="insert into chitietsanpham(MaSP,MaSize,MaMau) values('$so','$values1','$values')";
								$rs_ctsp=mysqli_query($conn, $sql_ctsp);
						 	}
						}$dem=1;
						$sql_addanhsp="INSERT INTO `anhsp`(`MaSP`) VALUES ('$so') ";
						mysqli_query($conn,$sql_addanhsp);
						foreach($_FILES['anhsp']['name'] as $key=>$value) {
							$anhsp=$_FILES['anhsp']['name'][$key];
							$anh_tmp=$_FILES['anhsp']['tmp_name'][$key];
							$rs_anhsp = move_uploaded_file($anh_tmp,'../../webroot/image/sanpham/'.$anhsp);
							$sql_upanhsp="UPDATE `anhsp` SET `Anh$dem` = '$anhsp' where `MaSP` = '$so' ";
							mysqli_query($conn,$sql_upanhsp);
							$dem++; 
						}
						 header('location:../index.php?action=sanpham&view=themsp&thongbao=them');
					}else{
					header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
				}	
			}

		}
	//-----------------------------------------------------------------------------------------	
			// cập nhập Sản Phẩm
if(isset($_POST['xlsua'])){
	$masp=$_POST['masp'];
	$tensp=$_POST['tensp'];
	$madm=$_POST['madm'];
	$mancc=$_POST['mancc'];
	$dongia=$_POST['dongia'];
	if(isset($_FILES['anhnen'])){
		$anhnen=$_FILES['anhnen']['name'];
		$AnhSP_tmp=$_FILES['anhnen']['tmp_name'];
		move_uploaded_file($AnhSP_tmp,'../../webroot/image/sanpham/'.$anhnen);}else{$anhnen=false;}
	$size=$_POST['size'];
	$mau=$_POST['mau'];
	if(isset($_POST['mota'])){$mota=$_POST['mota'];}else{$mota=NULL;}
	if($anhnen){
		$sql_them=" UPDATE `sanpham` SET `TenSP`='$tensp',`MaDM`='$madm',`MaNCC`='$mancc',`MoTa`='$mota',`DonGia`='$dongia',`AnhNen`='$anhnen' WHERE `MaSP`='$masp'";
	}else{
		$sql_them=" UPDATE `sanpham` SET `TenSP`='$tensp',`MaDM`='$madm',`MaNCC`='$mancc',`MoTa`='$mota',`DonGia`='$dongia' WHERE `MaSP`='$masp'";
	}
	$rs_them=mysqli_query($conn,$sql_them);
	if(isset($rs_them)){
		$sql_xoa="DELETE FROM `chitietsanpham` WHERE MaSP='$masp'";	$sr2=mysqli_query($conn,$sql_xoa);
		if(isset($sr2)){
			$sql_masp="select MaSP from sanpham where TenSP='$tensp' ORDER BY MaSP DESC";
			$sr=mysqli_query($conn,$sql_masp);$qk=mysqli_fetch_array($sr);	
			if(isset($qk)){
				(int) $so =$qk['MaSP'];
						foreach ($size as $key1 => $values1){
							foreach ($mau as $key => $values) {
								$sql_ctsp="insert into chitietsanpham(MaSP,MaSize,MaMau) values('$so','$values1','$values')";
								$rs_ctsp=mysqli_query($conn, $sql_ctsp);
							}
						}
						$dem=1;
						if (isset($_FILES['anhsp'])) {
							if(empty($_FILES['anhsp']['name'][0])){echo 'ok1'; 
								header('location:../index.php?action=sanpham&view=themsp&thongbao=sua'); 
							}else{ 
								foreach($_FILES['anhsp']['name'] as $key=>$value) {
									$sql_anhcu="SELECT * FROM `anhsp` WHERE MaSP = $so";
									$rs_anhcu=mysqli_query($conn, $sql_anhcu);
									$row_anhcu=mysqli_fetch_array($rs_anhcu);
									$file='../../webroot/image/sanpham/'.$row_anhcu['Anh'.$dem];
									if(unlink($file)){
										$anhsp=$_FILES['anhsp']['name'][$key];
										$anh_tmp=$_FILES['anhsp']['tmp_name'][$key];
										$rs_anhsp = move_uploaded_file($anh_tmp,'../../webroot/image/sanpham/'.$anhsp);
										$sql_upanhsp="UPDATE `anhsp` SET `Anh$dem` = '$anhsp' where `MaSP` = '$so' ";
										mysqli_query($conn,$sql_upanhsp);
										$dem++;
									};	
						 			
									
								}
								header('location:../index.php?action=sanpham&view=themsp&thongbao=sua');
							}
				}else{
					header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
				}
			
			}
			
		}
		
	}
}
			

			

		

//-----------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------	
if(isset($_GET['xoa'])){
    $masp = $_GET['masp'];

    // Delete from phieuxuat table
    $delete4 = "DELETE FROM `phieuxuat` WHERE MaSP = $masp";
    $rs_d4 = mysqli_query($conn, $delete4);

    if($rs_d4){
        // Delete from sanphamkhuyenmai table
        $delete5 = "DELETE FROM `sanphamkhuyenmai` WHERE MaSP = $masp";
        $rs_d5 = mysqli_query($conn, $delete5);

        // Delete from chitietsanpham table
        $delete = "DELETE FROM `chitietsanpham` WHERE MaSP = $masp";
        $rs_d = mysqli_query($conn, $delete);

        if($rs_d){
            // Delete from phieunhap table
            $delete_phieunhap = "DELETE FROM `phieunhap` WHERE MaSP = $masp";
            $rs_phieunhap = mysqli_query($conn, $delete_phieunhap);

            if($rs_phieunhap){
                // Delete from anhsp table
                $delete3 = "DELETE FROM `anhsp` WHERE MaSP = $masp";
                $rs_d3 = mysqli_query($conn, $delete3);

                if($rs_d3){
                    // Delete from sanpham table
                    $delete2 = "DELETE FROM `sanpham` WHERE MaSP = $masp";
                    $rs_d2 = mysqli_query($conn, $delete2);

                    if($rs_d2){
                        header('location:../index.php?action=sanpham&thongbao=xoa');
                    } else {
                        header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
                    }
                } else {
                    header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
                }
            } else {
                header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
            }
        } else {
            header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
        }
    } else {
        header('location:../index.php?action=sanpham&view=themsp&thongbao=loi');
    }
}



	

		//-----------------------------------------------------------------------------------------	
		// Thêm màu 
		
		 ?>