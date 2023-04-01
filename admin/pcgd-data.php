<?php
    require_once("../connect.php");
    if(isset($_POST["magv"])){
        echo "<table>
            <tr style='position: sticky; top:0;'>
                <td style='width: 200; text-align: center; background-color: blue; color: white'>Lớp học</td>
                <td style='width: 250; text-align: center; background-color: blue; color: white'>Năm học</td>
            </tr>";

        $q=$conn->query("SELECT * FROM phanconggd, lop WHERE phanconggd.MAGV='".$_POST["magv"]."' AND phanconggd.MSLOP=lop.MSLOP");
        while($row=$q->fetch_assoc()){
            echo "<tr>
                    <td>".$row["TENLOP"]."</td>
                    <td>".$row["NAMHOC"]."</td>
                  </tr>";
        }
        echo "</table>";
    }

    #Liệt kê
    if(isset($_POST["namhoc"])){
        echo "<table id='table-cth'>
                <tr style='position:sticky; top: 0;'>
                    <td style='width: 80; background-color: #1386f9; color:aliceblue'>Mã số </td>
                    <td style='width: 300; background-color: #1386f9; color:aliceblue'>Họ tên</td>
                    <td style='width: 80; background-color: #1386f9; color:aliceblue'>Lớp</td>
                    <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm học</td>
                    <td style='width: 80; background-color: #1386f9; color:aliceblue'>Lịch sử</td>
                    <td style='width: 80; background-color: #1386f9; color:aliceblue'>Xóa</td>
                </tr>";
        if($_POST["namhoc"]=='Tất cả'){
            $sql="SELECT MAGV, HOTENGV, TENLOP, NAMHOC FROM phanconggd, lop, gv WHERE phanconggd.MAGV=gv.MSGV AND
                                                                                 phanconggd.MSLOP= lop.MSLOP";
        }
        else{
            $sql="SELECT MAGV, HOTENGV, TENLOP, NAMHOC FROM phanconggd, lop, gv WHERE phanconggd.MAGV=gv.MSGV AND
            phanconggd.MSLOP= lop.MSLOP AND
            NAMHOC='".$_POST["namhoc"]."'";
        }
      
        $q=$conn->query($sql);
        while($row=$q->fetch_assoc()){
                echo"<tr>
                    <td>".$row["MAGV"]."</td>
                    <td>".$row["HOTENGV"]."</td>
                    <td>".$row["TENLOP"]."</td>
                    <td>".$row["NAMHOC"]."</td>
                    <td style='width: 80;'><button id='btn-xem' onclick='xem(this)'><i class='bi bi-eye'></i></button></td>
                    <td style='width: 80;'><button id='btn-xoa' onclick='xoa(this)'><i class='bi bi-x'></i></button></td>
                </tr>";
        }
        echo "</table>";
    }

    #Xóa pcgd
    if(isset($_POST["magvxoa"])){
        $q=$conn->query("DELETE FROM phanconggd WHERE MAGV='".$_POST["magvxoa"]."' AND NAMHOC='".$_POST["namhocxoa"]."'");
    }

    #Thêm pcgd
    if(isset($_POST["gvthem"]) && isset($_POST["namhocthem"]) && isset($_POST["lopthem"])){
        $q=$conn->query("INSERT INTO phanconggd VALUES ('".$_POST["gvthem"]."','".$_POST["lopthem"]."','".$_POST["namhocthem"]."')");
        echo "Đã thêm thành công!";
    }
?>