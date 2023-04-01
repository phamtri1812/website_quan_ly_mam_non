<?php
    require_once("../connect.php");
    #Liệt kê
    if(isset($_POST["makhoi"])){
        echo "<table id='table-lop'>
                    <tr style='top: 0; position:sticky;'>
                        <td style='width: 120px; background-color:blue; color:azure;'>Mã lớp</td>
                        <td style='width: 100px; background-color:blue; color:azure;'>Lớp học</td>
                        <td style='width: 100px; background-color:blue; color:azure;'>Xóa</td>
                    </tr>";
        if($_POST["makhoi"]=='Tất cả'){
            $sql="SELECT*FROM lop";
        }     
        else{
            $sql="SELECT*FROM lop WHERE MAKHOI='".$_POST["makhoi"]."'";
        }     
        $q1=$conn->query($sql);
        while($row=$q1->fetch_assoc()){
            echo "<tr>
                    <td>".$row["MSLOP"]."</td>
                    <td>".$row["TENLOP"]."</td>
                    <td><button id='btn-del' onclick='xoa(this)' style='background-color: red; color: white; border-radius: 2px;'><i class='bi bi-trash'></i></button>
                    <button id='btn-del' onclick='cn(this)' style='background-color: blue; color: white; border-radius: 2px;'><i class='bi bi-pen'></i></button></td>
                            </tr>";
        }
                    
        echo "</table>";
     }
     #Thêm lớp học

     if(isset($_POST["makhoinew"])){
        $sql="INSERT INTO lop VALUES ('".$_POST["malopnew"]."','".$_POST["tenlopnew"]."','".$_POST["makhoinew"]."')";
        $q=$conn->query($sql);
     }

     #xóa lớp học
     if(isset($_POST["msxoa"])){
        $q=$conn->query("DELETE FROM lop WHERE MSLOP='".$_POST["msxoa"]."'");
     }

     #dslop cũ
    
     if(isset($_POST["lkcu"])){
        
        echo "<table id='tbcu'>
        <tr style='top:0; position: sticky'>
            <td style='display: none;'>Mã số</td>
            <td style='width: 300px; background-color:blue; color:#ffffff; text-align:center;'>Họ tên học sinh</td>
            <td style='width: 150px; background-color:blue; color:#ffffff; text-align:center;'><input type='checkbox' id='checkall' onclick='chooseAll()'></td>
        </tr>";
        $q=$conn->query("SELECT*FROM hocsinh WHERE MSLOP='".$_POST["lkcu"]."'");
        while($r=$q->fetch_assoc()){
            echo "<tr>
                <td style='display: none;'>".$r["MAHS"]."</td>
                <td>".$r["HOTENHS"]."</td>
                <td style='text-align: center;'><input type='checkbox' class='checkrow'></td>
            </tr>";
        }
        echo "</table>";
     }

     #dslop mới
     if(isset($_POST["lkmoi"])){
        echo "<table id='tbmoi'>
        <tr style='top:0; position: sticky'>
            <td style='display: none;'>Mã số</td>
            <td style='width: 450px; background-color:blue; color:#ffffff; text-align:center;'>Họ tên học sinh</td>
        </tr>";
        $q=$conn->query("SELECT*FROM hocsinh WHERE MSLOP='".$_POST["lkmoi"]."'");
        while($r=$q->fetch_assoc()){
            echo "<tr>
                <td style='display: none;'>".$r["MAHS"]."</td>
                <td>".$r["HOTENHS"]."</td>
            </tr>";
        }
        echo "</table>";
     }

     #chuyển lớp
     if(isset($_POST["l"])){
        $l=$_POST["l"];
        $s=count($l);
        for($i=0; $i<$s; $i++){
            $q=$conn->query("UPDATE hocsinh SET MSLOP='".$_POST["malopmoi"]."' WHERE MAHS=".$l[$i]);
        }
     }

     #Xem phân công
     if(isset($_POST["mslop"])){
        $date=getdate();
        $n1=$date['year'];
        $n2=$date['year']+1;
        $namhoc=$n1."-".$n2;
        echo "<button style='width: 50px; background-color: red; margin-left: 450px; border: none; color: white;' onclick='closePC()'><i class='bi bi-x'></i></button>";
        echo " <br><p style='text-align:center; color: red; font-size: 20;'>PHÂN CÔNG GIẢNG DẠY</p>";
        $s=$conn->query("SELECT*FROM lop WHERE MSLOP='".$_POST["mslop"]."'");
        while($ro=$s->fetch_assoc()){
            echo "<b style='margin-left: 60px;'>Mã lớp: </b><input id='mlop' type='text' style='width: 30px;' value='".$_POST["mslop"]."'>
                        <b  style='margin-left: 50px'>Tên lớp: ".$ro["TENLOP"]."</b>";
        }
        $q=$conn->query("SELECT*FROM gv,lop,phanconggd WHERE lop.MSLOP=phanconggd.MSLOP AND gv.MSGV=phanconggd.MAGV 
                                    AND phanconggd.MSLOP='".$_POST["mslop"]."' AND phanconggd.NAMHOC='".$namhoc."'");
        $xd=' ';
        while($r=$q->fetch_assoc()){
            echo "<br><b style='margin-left: 60px;'>Giáo viên giảng dạy: ".$r["HOTENGV"]."</b>";
            $xd="yes";
            
        }
        echo "<input id='xd' type='hidden' value='".$xd."'>";
        echo " <hr style='padding: 0;
                border: none;
                border-top: medium double #333;
                color: #333;'>";
        echo " <p style='text-align:center; color: red; font-size: 20;'>THAY ĐỔI PHÂN CÔNG GIẢNG DẠY</p>";
        //Danh sách gv
        $gv=array();
        $hoten=array();
        $pc=array();
        $q=$conn->query("SELECT*FROM gv");
        while($row=$q->fetch_assoc()){
            $gv[]=$row["MSGV"];
            $hoten[]=$row["HOTENGV"];

        }
        $date=getdate();
        $n1=$date['year'];
        $n2=$date['year']+1;
        $namhoc=$n1."-".$n2;
        $q2=$conn->query("SELECT*FROM phanconggd WHERE NAMHOC='".$namhoc."'");
        while($r=$q2->fetch_assoc()){
            $pc[]=$r["MAGV"];
        }
        
        
        echo "<b style='margin-left: 60px;'>Giáo viên: </b><select id='slgv'>";
        for($i=0;$i<count($gv);$i++){
            if(in_array($gv[$i],$pc)){
                continue;
            }
            else{
                echo "<option value='".$gv[$i]."'>".$hoten[$i]."</option>";
            }
            
        }
        echo "</select>";
        echo "<button style='width: 80px; background-color: blue; margin-left: 20px; border: none; color: white;' onclick='luuPC()'>Lưu</button>";
        
     }

     #PCGD
     if(isset($_POST["xd"])){
        $date=getdate();
        $n1=$date['year'];
        $n2=$date['year']+1;
        $namhoc=$n1."-".$n2;
        if($_POST["xd"]=="yes"){
            $sql="UPDATE `phanconggd` SET `MAGV`='".$_POST["msgv"]."' WHERE MSLOP='".$_POST["mstd"]."'  AND NAMHOC='".$namhoc."'";
        }
        else{
            $sql="INSERT INTO `phanconggd` VALUES ('".$_POST["msgv"]."','".$_POST["mstd"]."','".$namhoc."')";
        }
       $q=$conn->query($sql);
       
     }
 ?>