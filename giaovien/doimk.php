<?php require_once("../connect.php");
    session_start();
    if(isset($_POST["mkcu"])&&isset($_POST["mkmoi"])){
        $q1=$conn->query("SELECT*FROM gv WHERE MSGV='".$_SESSION["Login"]."'");
        while($row=$q1->fetch_assoc()){
            $mk=$row["MATKHAU"];
        }
       if($mk==$_POST["mkcu"])
            $res="yes";
        else 
            $res="no";

        if($res=="yes"){
            $q2=$conn->query("UPDATE gv SET MATKHAU='".$_POST["mkmoi"]."' WHERE MSGV='".$_SESSION["Login"]."'");
        }
        echo $res;
    }
?>