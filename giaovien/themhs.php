<?php
    require_once('../connect.php');
    $namecha=" ";
    $namehs=" ";
    $nameme=" ";
   if (isset($_FILES['anhcha']))
        {
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($_FILES['anhcha']['error'] > 0)
            {
                echo 'File Upload ảnh cha Bị Lỗi';
            }
            else{
                // Upload file
                $namecha='../anhcha/'.$_FILES['anhcha']['name'];
                move_uploaded_file($_FILES['anhcha']['tmp_name'],$namecha );
            }
        }

        if (isset($_FILES['anhhs']))
        {
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($_FILES['anhhs']['error'] > 0)
            {
                echo 'File Upload ảnh học sinh Bị Lỗi';
            }
            else{
                // Upload file
                $namehs='../anhhs/'.$_FILES['anhhs']['name'];
                move_uploaded_file($_FILES['anhhs']['tmp_name'],$namehs );
            }
        }

        if (isset($_FILES['anhme']))
        {
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($_FILES['anhme']['error'] > 0)
            {
                echo 'File Upload  ảnh mẹ Bị Lỗi';
            }
            else{
                // Upload file
                $nameme='../anhme/'.$_FILES['anhme']['name'];
                move_uploaded_file($_FILES['anhme']['tmp_name'],$nameme );
            }
        }
       

        $sql="INSERT INTO hocsinh(HOTENHS,NGAYSINH,GIOITINH,DIACHI,MSLOP,NGAYNHAPHOC,HOTENCHA,SDTCHA,HOTENME,SDTME,ANHHS,ANHCHA,ANHME) 
                        VALUES('".$_POST["hotenhs"]."', '".$_POST["ngaysinh"]."', '".$_POST["gioitinh"]."', '".$_POST["diachi"]."',
                        '".$_POST["malop"]."', '".$_POST["ngaynhaphoc"]."', '".$_POST["hotencha"]."', '".$_POST["sdtcha"]."',
                        '".$_POST["hotenme"]."', '".$_POST["sdtme"]."', '".$namehs."', '".$namecha."','".$nameme."')";
        $q1=$conn->query($sql);
        

     
?>