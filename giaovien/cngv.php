<?php require_once("../connect.php");
    session_start();
    if(isset($_POST["hotengv"])){
        $a=date_create($_POST["ngaysinh"]);
        date_format($a,'d-m-Y');
        $ns=$a->format("Y-m-d");

        $a=date_create($_POST["ngayvaolam"]);
        date_format($a,'d-m-Y');
        $nvl=$a->format("Y-m-d");

        $sql=("UPDATE gv SET HOTENGV='".$_POST["hotengv"]."', GIOITINH='".$_POST["gioitinh"]."',
                                        NGAYSINH='".$ns."', DIACHI='".$_POST["diachi"]."', 
                                        CMNDCCCD='".$_POST["cmnd"]."', SDT='".$_POST["sdt"]."', 
                                        NGAYVAOLAM='".$nvl."', TRINHDO='".$_POST["trinhdo"]."', NANGKHIEU='".$_POST["nangkhieu"]."'  WHERE MSGV='".$_SESSION["Login"]."'");
        $q1=$conn->query($sql);
        echo "Thành công";

    }

    if($_FILES["filegv"]){
        $q=$conn->query("SELECT ANHGV FROM gv WHERE MSGV='".$_SESSION["Login"]."'");
        while($r=$q->fetch_assoc()){
            $anh=$r["ANHGV"];
        }
        if(!is_null($anh)){
            unlink($anh);
        }
        $name='../anhgv/'.$_FILES['filegv']['name'];
        move_uploaded_file($_FILES['filegv']['tmp_name'],$name );
        $q2=$conn->query("UPDATE gv SET ANHGV='".$name."' WHERE MSGV='".$_SESSION["Login"]."'");
    }
?>