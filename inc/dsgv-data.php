<?php
    require_once("../connect.php");
    if(isset($_POST["makhoi"])){
        $date=getdate();
        $n1=$date['year'];
        $n2=$date['year']+1;
        $namhoc=$n1."-".$n2;
        if($_POST["makhoi"]=='Tất cả'){
            $q=$conn->query("SELECT gv.HOTENGV, SDT, TENLOP, ANHGV  FROM gv, lop, phanconggd 
                                            WHERE gv.MSGV=phanconggd.MAGV AND lop.MSLOP=phanconggd.MSLOP AND NAMHOC='".$namhoc."'");
        }
        else{
            $q=$conn->query("SELECT gv.HOTENGV, SDT, TENLOP, ANHGV  FROM gv, lop, phanconggd 
            WHERE gv.MSGV=phanconggd.MAGV AND lop.MSLOP=phanconggd.MSLOP AND NAMHOC='".$namhoc."' AND lop.MAKHOI='".$_POST["makhoi"]."'");
        }

        echo "<table style='margin-left: 100px'>";
        while($r=$q->fetch_assoc()){
            echo "<tr>
                <td style='width: 150px; height: 120px; padding-top: 10px;'><img src='".$r["ANHGV"]."' style='width: 100px; height: 100px;'></td>
                <td><b>Giáo viên: ".$r["HOTENGV"]."</b><br>
                        Lớp: ".$r["TENLOP"]."<br>
                        Số điện thoại: ".$r["SDT"]."</td>

            </tr>";
        }
        echo "</table>";
    }
?>