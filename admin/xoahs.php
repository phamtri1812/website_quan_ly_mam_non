<?php 
    require_once('../connect.php');
    if(isset($_POST['msxoa'])){
        $sql='DELETE FROM hocsinh WHERE MAHS='.$_POST['msxoa'];
        $q=$conn->query($sql);
        
        echo 'Đã xóa học sinh!';

    }
#liệt kê
    if(isset($_POST['ms'])){
       echo "<table id='table-hs'>
            <tr style='position:sticky; top:0;' >
                <td id='colmahs', style=;width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Mã số</b></td>
                <td style='width: 200px; background-color:#0000ff ; 
                                            color:white; height: 50px;'><b>Họ tên</b></td>
                <td style='width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Giới tính</b></td>
                <td id='colmahs' style=' background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Mã lớp</b></td>

                <td style='width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Lớp</b></td>
                <td style='width: 200px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Họ tên cha</b></td>
                <td style='width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Điện thoại cha</b></td>
                <td style='width: 200px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Họ tên mẹ</b></td>
                <td style='width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px; '><b>Điện thoại mẹ</b></td>
                <td style='width: 100px; background-color:#0000ff ; 
                                            color:white; height: 50px;'><b>Chức năng</b></td>
                
            </tr>";
        if($_POST['ms']=='Tất cả'){
            $sql="SELECT * FROM hocsinh, lop 
            WHERE hocsinh.MSLOP=lop.MSLOP";
        }
        else{
            $sql="SELECT * FROM hocsinh, lop 
            WHERE hocsinh.MSLOP=lop.MSLOP AND hocsinh.MSLOP='".$_POST['ms']."'";
        }
      
        $q=$conn->query($sql);
        while($row=$q->fetch_assoc()){ 
            echo "<tr>
            <td id='colmahs' >". $row['MAHS']."</td>
            <td ><button class='btn-anh' onclick='ImgOPhs(this)'>".$row["HOTENHS"]."</button></td>
            <td >". $row["GIOITINH"]."</td>
            <td id='colmahs' >".$row['MSLOP']."</td>
            <td >".$row["TENLOP"]."</td>
            <td ><button class='btn-anh' onclick='ImgOPcha(this)'>".$row["HOTENCHA"]."</button></td>
            <td >".$row["SDTCHA"]."</td>
            <td ><button class='btn-anh' onclick='ImgOPme(this)'>".$row["HOTENME"]."</button></td>
            <td >".$row["SDTME"]."</td>
            <td ><button id='btn-edit' onclick='openEdit(this)'><i class='bi bi-pencil-square'></i></button>
                                        <button id='btn-delete' onclick='deleteHS(this)'><i class='bi bi-x'></i></button></td>
            </tr>";
        }
        echo "</table>";
    }
?>