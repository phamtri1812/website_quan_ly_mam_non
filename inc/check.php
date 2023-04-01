<?php
if(isset($_POST['name_user']) && isset($_POST['pass_user'])){
    require_once("../connect.php");
	$stid = $conn->query('SELECT * FROM gv');
    $check='ten';
	while ($row = $stid->fetch_assoc()) {	
		if($_POST['name_user']== $row["TENDN"]){
            $check='mk';
		}
		if($_POST['pass_user']==$row["MATKHAU"]){
			$check='yes';
			break;
		}
	}
    echo $check;
}
?>