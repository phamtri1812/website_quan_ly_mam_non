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
       
        $a=date_create($_POST["ngaysinh"]);
        date_format($a,'d-m-Y');
        $NGAYSINH=$a->format("Y-m-d"); 

        $a=date_create($_POST["ngaynhaphoc"]);
        date_format($a,'d-m-Y');
        $NGAYNHAPHOC=$a->format("Y-m-d");

        $sql1="UPDATE hocsinh SET HOTENHS='".$_POST["hotenhs"]."', NGAYSINH='".$NGAYSINH."', GIOITINH='".$_POST["gioitinh"].
        "',DIACHI='".$_POST["diachi"]."', NGAYNHAPHOC='".$NGAYNHAPHOC."',HOTENCHA='".$_POST["hotencha"]."', 
        SDTCHA='".$_POST["sdtcha"]."', HOTENME='".$_POST["hotenme"]."', SDTME='".$_POST["sdtme"]."', ANHHS='".$namehs."', 
        ANHCHA='".$namecha."',ANHME='".$nameme."' WHERE MAHS=".$_POST["mahs"];

        $sql2="UPDATE hocsinh SET HOTENHS='".$_POST["hotenhs"]."', NGAYSINH='".$NGAYSINH."', GIOITINH='".$_POST["gioitinh"].
        "',DIACHI='".$_POST["diachi"]."', NGAYNHAPHOC='".$NGAYNHAPHOC."',HOTENCHA='".$_POST["hotencha"]."', 
        SDTCHA='".$_POST["sdtcha"]."', HOTENME='".$_POST["hotenme"]."', SDTME='".$_POST["sdtme"]."' WHERE MAHS=".$_POST["mahs"];
        if($namecha==' '|| $namehs==' ' || $nameme==' '){
              $q1=$conn->query($sql2);
              
        
        }
        else{
                $q1=$conn->query($sql1);
                
                
        }
        
      
?>