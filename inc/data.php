<?php
    require_once("../connect.php");
    #Xem ảnh
    if(isset($_POST["cd"])){
        if($_POST["cd"]=='Tất cả'){
            if($_POST["nam"]=='Tất cả'){ 
                 $q2=$conn->query("SELECT*FROM anh ");
            }
            else{
                $q2=$conn->query("SELECT*FROM anh WHERE THOIGIAN LIKE '".$_POST["nam"]."%'");
            }
        }
        else{
            if($_POST["nam"]=='Tất cả'){
                $q2=$conn->query("SELECT * FROM `anh` WHERE CHUDE='".$_POST["cd"]."'");
            }
            else{
                $q2=$conn->query("SELECT * FROM `anh` WHERE CHUDE='".$_POST["cd"]."' AND THOIGIAN LIKE '".$_POST["nam"]."%'");
            }
            
        }
       echo "<ul id='listimg'>";
        while($r2=$q2->fetch_assoc()){
            echo "<li><div id='frame-img'><p style='text-align: center; color: red; font-size: 20px'><img src='".$r2["LINK"]."' style='width:200px; height: 170px;'><br>".$r2["CHUDE"]."</p></div></li>";
        }
        echo "</ul>";
    }
    ##################################################################################
    #Xem tin tức
    if(isset($_POST["namtt"])){
        if($_POST["namtt"]=='Tất cả'){
            $q2=$conn->query("SELECT*FROM baidang WHERE THELOAI='Bài viết'");
        }
        else{
            $q2=$conn->query("SELECT*FROM baidang WHERE THELOAI='Bài viết' AND NGAYDANG LIKE '".$_POST["namtt"]."%'");
        }
        
        echo "<ul id='listimg'>";
        while($r2=$q2->fetch_assoc()){
            echo "<li><div id='frame-img'><img src='../css/huongduong.png' style='width: 50px; height: 50px; border-radius: 50%'>
                    <a href='".$r2["LINK"]."';>".$r2["TIEUDE"]."</a></div></li>";
        }
        echo "</ul>";
    }

    #####################################################################################
    #Xem thông báo
    if(isset($_POST["namtb"])){
        if($_POST["namtb"]=='Tất cả'){
            $q2=$conn->query("SELECT*FROM baidang WHERE THELOAI='Thông báo'");
        }
        else{
            $q2=$conn->query("SELECT*FROM baidang WHERE THELOAI='Thông báo' AND NGAYDANG LIKE '".$_POST["namtb"]."%'");
        }
        
        echo "<ul id='listimg'>";
        while($r2=$q2->fetch_assoc()){
            echo "<li><div id='frame-img'><img src='../css/huongduong.png' style='width: 50px; height: 50px; border-radius: 50%'>
                    <a href='".$r2["LINK"]."';>".$r2["TIEUDE"]."</a></div></li>";
        }
        echo "</ul>";
    }
    ################################################################3
    #Xem chương trình học
    if(isset($_POST["namct"])){
        if($_POST["namct"]=='Tất cả'){
            if($_POST["khoict"]=='Tất cả'){ 
                 $q2=$conn->query("SELECT*FROM chuongtrinhhoc");
            }
            else{
                $q2=$conn->query("SELECT*FROM chuongtrinhhoc WHERE MAKHOI='".$_POST["khoict"]."'");
            }
        }
        else{
            if($_POST["khoict"]=='Tất cả'){
                $q2=$conn->query("SELECT * FROM chuongtrinhhoc WHERE NAMHOC='".$_POST["namct"]."'");
            }
            else{
                $q2=$conn->query("SELECT * FROM chuongtrinhhoc WHERE MAKHOI='".$_POST["khoict"]."' AND NAMHOC='".$_POST["namct"]."'");
            }
            
        }

        echo "<ul id='listimg'>";
        while($r2=$q2->fetch_assoc()){
            echo "<li><div id='frame-img'><img src='../css/huongduong.png' style='width: 50px; height: 50px; border-radius: 50%'>
                    <a href='".$r2["LINK"]."';>".$r2["TIEUDE"]."</a></div></li>";
        }
        echo "</ul>";
    }

    ################################################################3
    #Xem thực đơn
    if(isset($_POST["namtd"])){
        if($_POST["namtd"]=='Tất cả'){
            if($_POST["thang"]=='Tất cả'){ 
                 $sql="SELECT*FROM thucdon";
            }
            else{
                $sql="SELECT*FROM thucdon WHERE THANG='".$_POST["thang"]."'";
            }
        }
        else{
            if($_POST["thang"]=='Tất cả'){
                $sql="SELECT * FROM thucdon WHERE NAM='".$_POST["namtd"]."'";
            }
            else{
                $sql="SELECT * FROM thucdon WHERE THANG='".$_POST["thang"]."' AND NAM='".$_POST["namtd"]."'";
            }
            
        }
       
        $q2=$conn->query($sql);
        echo "<ul id='listimg'>";
        while($r2=$q2->fetch_assoc()){
            echo "<li><div id='frame-img'><img src='../css/huongduong.png' style='width: 50px; height: 50px; border-radius: 50%'>
                    <a href='".$r2["LINK"]."';>".$r2["TIEUDE"]."</a></div></li>";
        }
        echo "</ul>";
    }

?>