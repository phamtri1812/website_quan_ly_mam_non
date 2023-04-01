<?php 
    require_once("../connect.php");
    if(isset($_POST["ms"])){
        $sql="DELETE FROM hocsinh WHERE MAHS=".$_POST["ms"];
        $q=$conn->query($sql);
        echo "Đã xóa học sinh!";

    }
?>