<?php
    require_once("connect.php");
	echo $_POST["tendn"];
	
	$stid=$conn->query("SELECT * FROM gv WHERE TENDN='".$_POST['tendn']."' AND MATKHAU='".$_POST['mk']."'");
	while($row=$stid->fetch_assoc()){
        $DN=$row["TENDN"];
		$ID= $row["MSGV"];
		error_reporting(0); 
		session_start();
       
		if($ID!=null){
            if($DN=="mnmattroinho"){
                header("Location:admin/admin.php");
            }
			else
			    header("Location:giaovien/giaovien.php");
            
            $_SESSION['Login']=$ID;
		}
	}
?>