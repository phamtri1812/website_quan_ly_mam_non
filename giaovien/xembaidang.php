<?php 
    require_once("../connect.php");
    #Xem bài đăng
    if(isset($_POST['link'])){
            echo "<iframe src='".$_POST["link"]."#toolbar=0' width='800px' height='650px'>
            </iframe>";
       
    }


        #Xem ảnh
        if(isset($_POST["chude"])){
            echo "<br><br><p style='text-align: center; font-size: 30; color: red'>".$_POST["chude"]."</p>";
            $q=$conn->query("SELECT*FROM anh WHERE CHUDE='".$_POST["chude"]."' AND THOIGIAN='".$_POST["thoigian"]."'");
            while($r=$q->fetch_assoc()){
                echo "<p style='text-align:center;'><img src='".$r["LINK"]."' style='width: 500px;' ></p><br><br>";
            }
        }
?>