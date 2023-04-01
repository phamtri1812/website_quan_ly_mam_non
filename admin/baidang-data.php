<?php
    require_once("../connect.php");
    session_start();
    #Xem bài đăng 
    if(isset($_POST['link'])){
        if($_POST["theloaixem"]=='Thông báo' || $_POST["theloaixem"]=='Bài viết'){
            echo "<iframe src='".$_POST["link"]."#toolbar=0' width='800px' height='650px'>
            </iframe>";
        }
        else{
            echo "<br><br><p style='text-align: center; font-size: 30; color: red'>".$_POST["tieude"]."</p>";
            echo "<p style='text-align:center;'><img src='".$_POST["link"]."' ></p>";
        }
       
    }

    #Xóa bài đăng
    if(isset($_POST["mabdxoa"])){
        $x=$conn->query("SELECT LINK FROM `baidang` WHERE MABD='".$_POST["mabdxoa"]."'");
        while($r=$x->fetch_assoc()){
            unlink($r["LINK"]);
        }
        $q=$conn->query("DELETE FROM baidang WHERE MABD='".$_POST["mabdxoa"]."'");
    }

   
    #Đăng bài
    if(isset($_FILES['filedang'])){
        $name='../baidang/'.$_FILES['filedang']['name'];
        move_uploaded_file($_FILES['filedang']['tmp_name'],$name );
        $q1="INSERT INTO baidang(TIEUDE,THELOAI,LINK,NGAYDANG,MAGV) VALUES('".$_POST['tieudedang']."',
         '".$_POST['theloaidang']."', '".$name."', now(), '".$_SESSION["Login"]."')";
         $q=$conn->query($q1);
        
    }


    #Liệt kê
    if(isset($_POST["theloai"])){
        echo "<table id='table-baidang'>
                            <tr style='position:sticky; top:0;'>
                                <td id='cot-an'>Mã số</td>
                                <td style='width: 500; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
                                <td id='cot-an'>Link</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Thể Loại</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Ngày đăng</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                            </tr>";
        $sql1= "SELECT*FROM baidang WHERE MAGV='".$_SESSION["Login"]."' AND THELOAI='".$_POST["theloai"]."'";
        $sql2= "SELECT*FROM baidang WHERE MAGV='".$_SESSION["Login"]."'";      
        if($_POST["theloai"]=='Tất cả'){
            $q=$conn->query($sql2);
        }      
        else{
            $q=$conn->query($sql1);
        }
        

        while($row=$q->fetch_assoc()){
            echo "<tr>
                    <td id='cot-an'>".$row["MABD"]."</td>
                    <td style='width: 500;'>".$row["TIEUDE"]."</td>
                    <td id='cot-an'>".$row["LINK"]."</td>
                    <td style='width: 100;'>".$row["THELOAI"]."</td>
                    <td style='width: 100;'>".$row["NGAYDANG"]."</td>
                    <td style='width: 100;'><button id='btn-xem' onclick='xem(this)'><i class='bi bi-eye'></i></button>
                    <button id='btn-xoa'><i class='bi bi-x'></i></button></td>
                </tr>";
            
            }
    echo "</table>";
    }
    #####################################################################################################
    #Liệt kê ảnh
    if(isset($_POST["namimg"])){
        echo "<tr style='position:sticky; top:0;'>
                                <td style='width: 300; background-color: #1386f9; color:aliceblue'>Chủ đề</td>
                                <td style='width: 300; background-color: #1386f9; color:aliceblue'>Địa điểm</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Thời gian </td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                            </tr>";
        if($_POST["namimg"]=='Tất cả'){
            $sql="SELECT DISTINCT CHUDE, DIADIEM, THOIGIAN FROM `anh` WHERE MAGV='".$_SESSION["Login"]."'";
        }            
        else{
            $sql="SELECT DISTINCT CHUDE, DIADIEM, THOIGIAN FROM `anh` WHERE THOIGIAN LIKE '".$_POST["namimg"]."%' AND MAGV='".$_SESSION["Login"]."'";
        }
        $q=$conn->query($sql);
        while($r=$q->fetch_assoc()){
            echo "<tr>
                    <td>".$r["CHUDE"]."</td>
                    <td>".$r["DIADIEM"]."</td>
                    <td>".$r["THOIGIAN"]."</td>
                    <td ><button id='btn-xem' onclick='SeeImg(this)'><i class='bi bi-eye'></i></button>
                    <button id='btn-xoa' onclick='DeleteImg(this)'><i class='bi bi-x'></i></button></td>
                </tr>";
        }
    }

     #Đăng ảnh
     if(isset($_POST["chude"])){
        $name = array();
        $tmp_name = array();
        foreach ($_FILES['file']['name'] as $file) {
            $name[] = $file;
        }
        foreach ($_FILES['file']['tmp_name'] as $file) {
            $tmp_name[] = $file;
        }
        $target=array();
        for($i=0; $i< count($name); $i++){
            $target[]="../anhhoatdong/".basename($name[$i]);
        }
        for($i=0;$i<count($name);$i++)
             move_uploaded_file($tmp_name[$i],$target[$i] );

        for($i=0;$i<count($name);$i++){
            $sql="INSERT INTO anh(MAGV, LINK, CHUDE, THOIGIAN, DIADIEM) VALUES ('".$_SESSION["Login"]."','".$target[$i]."',
                                                            '".$_POST["chude"]."','".$_POST["thoigian"]."','".$_POST["diadiem"]."')";
            $q=$conn->query($sql);
        }
        header("Location:baidang.php");
    }

    #Xóa ảnh
    if(isset($_POST["chudexoa"])){
        $x=$conn->query("SELECT LINK FROM `anh` WHERE CHUDE='".$_POST["chudexoa"]."' AND THOIGIAN='".$_POST["thoigianxoa"]."'");
        while($r=$x->fetch_assoc()){
            unlink($r["LINK"]);
        }
        $q=$conn->query("DELETE FROM anh WHERE CHUDE='".$_POST["chudexoa"]."' AND THOIGIAN='".$_POST["thoigianxoa"]."'");
    }
?>