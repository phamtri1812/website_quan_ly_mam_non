<?php
 require_once("../connect.php");
 if(isset($_POST["ms"])){
    $q=$conn->query("SELECT*FROM hocsinh WHERE MAHS='".$_POST["ms"]."'");
    
   echo "<table id='btn-tb'><tr><td><button id='btncn' onclick='cnhs()'>Cập nhật</button></td>";
   echo "<td><button id='btnhuy' onclick='Huy()'>Hủy</button></td></tr></table>";
    echo "<input type='hidden' id='mahs' value='".$_POST["ms"]."'>";
    echo "<table id='hocsinh'>";
    while($row=$q->fetch_assoc()){
        $a=date_create($row["NGAYSINH"]);
        date_format($a,'Y-m-d');
        $NGAYSINH=$a->format("d-m-Y"); 

        $a=date_create($row["NGAYNHAPHOC"]);
        date_format($a,'Y-m-d');
        $NGAYNHAPHOC=$a->format("d-m-Y"); 
        echo "<tr>
                <td colspan='2' style='height: 200px;'><img src='".$row["ANHCHA"]."'><br>Ảnh cha<input type='file' id='anhcha'></td>
                <td colspan='2' style='height: 200px;'><img src='".$row["ANHME"]."'><br>Ảnh mẹ<input type='file' id='anhme'></td>
                <td colspan='2' style='height: 200px;'><img src='".$row["ANHHS"]."'><br>Ảnh học sinh<input type='file' id='anhhs'></td>
             </tr>";
        echo "<tr>
                <td style='width: 130px; '>Họ tên</td>
                <td style='width: 200px; '><input id='hotenhs' value='".$row["HOTENHS"]."'></td>
                <td style='width: 130px; '>Ngày sinh</td>
                <td style='width: 200px; '><input id='ngaysinhhs' value='".$NGAYSINH."'></td>
                <td style='width: 130px; '>Giới tính</td>
                <td style='width: 200px; '><input id='gioitinhhs' value='".$row["GIOITINH"]."'></td>
            </tr>";
            echo "<tr>
            <td style='width: 130px; '>Họ tên cha</td>
            <td style='width: 200px; '><input id='hotencha' value='".$row["HOTENCHA"]."'></td>
            <td style='width: 130px; '>Họ tên mẹ</td>
            <td style='width: 200px; '><input id='hotenme' value='".$row["HOTENME"]."'></td>
            <td style='width: 130px; '>Địa chỉ</td>
            <td style='width: 200px;'><input id='diachihs' value='".$row["DIACHI"]."'></td>
        </tr>";
        echo "<tr>
                <td style='width: 130px; '>SDT cha</td>
                <td style='width: 200px; '><input id='sdtcha' value='".$row["SDTCHA"]."'></td>
                <td style='width: 130px; '>SDT mẹ</td>
                <td style='width: 200px; '><input id='sdtme' value='".$row["SDTME"]."'></td>
                <td style='width: 130px; '>Ngày nhập học</td>
                <td style='width: 200px; '><input id='ngaynhaphoc' value='".$NGAYNHAPHOC."'></td>
            </tr>";
    }
    echo "</table>";

   
 }

  #mở ảnh
  if(isset($_POST["msanh"])){
    $q=$conn->query("SELECT*FROM hocsinh WHERE MAHS='".$_POST["msanh"]."'");
    while($row=$q->fetch_assoc()){
        if($_POST["t"]=="hs"){
            $link=$row["ANHHS"];
        }
        else{
            if($_POST["t"]=="cha"){
                $link=$row["ANHCHA"];

            }
            else
                $link=$row["ANHME"];
        }
    }
    echo "<img style='width: 200px; height: 200px; ' src='".$link."'>";
    
        
}
