<?php
    require_once("../connect.php");
   
    #Xem chương trình học
    if(isset($_POST['link'])){
        echo "<br><br><p style='text-align: center; font-size: 30; color: red'>".$_POST["tieude"]."</p>";
        echo "<iframe src='".$_POST["link"]."#toolbar=0' width='800px' height='570px'>
        </iframe>";
        
       
    }

    #Liệt kê
    if(isset($_POST["khoi"])){
      echo "<table id='table-cth'>
       <tr style='position:sticky; top: 0;'>
           <td id='cot-an'>Mã số</td>
           <td style='width: 390; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
           <td id='cot-an'>Link</td>
           <td style='width: 80; background-color: #1386f9; color:aliceblue'>Khối</td>
           <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm học</td>
           <td style='width: 150; background-color: #1386f9; color:aliceblue'>Chức năng</td>
       </tr>";
        if($_POST["khoi"]=='Tất cả' && $_POST['namhoc']!='Tất cả'){        
            $sql=("SELECT chuongtrinhhoc.MACT, chuongtrinhhoc.TIEUDE, chuongtrinhhoc.LINK, khoi.TENKHOI, chuongtrinhhoc.NAMHOC 
                        FROM `khoi`,chuongtrinhhoc WHERE khoi.MAKHOI=chuongtrinhhoc.MAKHOI AND chuongtrinhhoc.NAMHOC='".$_POST['namhoc']."'");
        }
        else{
            if($_POST['khoi']=='Tất cả' && $_POST['namhoc']=='Tất cả'){
                $sql=("SELECT chuongtrinhhoc.MACT, chuongtrinhhoc.TIEUDE, chuongtrinhhoc.LINK, khoi.TENKHOI, chuongtrinhhoc.NAMHOC 
                                        FROM `khoi`,chuongtrinhhoc WHERE khoi.MAKHOI=chuongtrinhhoc.MAKHOI");
            }
            else{
                if($_POST['khoi']!='Tất cả' && $_POST['namhoc']=='Tất cả'){
                    $sql=("SELECT chuongtrinhhoc.MACT, chuongtrinhhoc.TIEUDE, chuongtrinhhoc.LINK, khoi.TENKHOI, chuongtrinhhoc.NAMHOC 
                    FROM `khoi`,chuongtrinhhoc WHERE khoi.MAKHOI=chuongtrinhhoc.MAKHOI AND chuongtrinhhoc.MAKHOI='".$_POST['khoi']."'");
                }
                else{
                    $sql=("SELECT chuongtrinhhoc.MACT, chuongtrinhhoc.TIEUDE, chuongtrinhhoc.LINK, khoi.TENKHOI, chuongtrinhhoc.NAMHOC 
                    FROM `khoi`,chuongtrinhhoc WHERE khoi.MAKHOI=chuongtrinhhoc.MAKHOI AND
                     chuongtrinhhoc.MAKHOI='".$_POST['khoi']."' AND chuongtrinhhoc.NAMHOC='".$_POST['namhoc']."'");
                }
            }
        }
        
        $q=$conn->query($sql);
        
        while($row=$q->fetch_assoc()){
            $q1=$conn->query("SELECT*FROM khoi WHERE MAKHOI='".$_POST["khoi"]."'");
           echo "<tr>
                    <td id='cot-an'>". $row["MACT"] ."</td>
                    <td style='width: 390;'>".$row["TIEUDE"]."</td>
                    <td id='cot-an'>".$row["LINK"]."</td>
                    <td style='width: 80;'>".$row["TENKHOI"]."</td>
                    <td style='width: 180;'>".$row["NAMHOC"]."</td>
                    <td ><button id='btn-xem' onclick='xem(this)'><i class='bi bi-eye'></i></button>
                        <button id='btn-sua' onclick=suabai(this)><i class='bi bi-pen'></i></button>
                        <button id='btn-xoa' onclick='xoa(this)'><i class='bi bi-x'></i></button></td>
                </tr>";
                    
        }
        echo " </table>";
        
    }

     #Xóa chương trình học
     if(isset($_POST["matdxoa"])){
        $q=$conn->query("DELETE FROM chuongtrinhhoc WHERE MACT='".$_POST["matdxoa"]."'");
    }

    #Thêm chương trình học
    if(isset($_POST["tieudethem"])){
        if(isset($_FILES["filethem"])){
            $name='../chuongtrinhhoc/'.$_FILES['filethem']['name'];
            move_uploaded_file($_FILES['filethem']['tmp_name'],$name );
            $sql="INSERT INTO chuongtrinhhoc(TIEUDE,LINK,NAMHOC,MAKHOI) VALUES('".$_POST["tieudethem"]."', 
                                        '".$name."', '".$_POST["namthem"]."', '".$_POST["khoithem"]."')";
            $q=$conn->query($sql);
            echo "Đã thêm thành công!";
                                                    
        }
        else{
            echo "Chưa chọn tập tin!!!";
        }
    }

     #Cập nhật thực đơn
     if(isset($_POST["mactcn"])){
        
       if(isset($_FILES['filecn'])){
            $name='../chuongtrinhhoc/'.$_FILES['filecn']['name'];
            move_uploaded_file($_FILES['filecn']['tmp_name'],$name );
            $sql="UPDATE chuongtrinhhoc SET TIEUDE='".$_POST['tieudecn']."', MAKHOI='".$_POST['khoicn']."', NAMHOC='".$_POST['namcn']."',
            LINK='".$name."' WHERE MACT='".$_POST["mactcn"]."'";
            
        }
        else{
            $sql="UPDATE chuongtrinhhoc SET TIEUDE='".$_POST['tieudecn']."', MAKHOI='".$_POST['khoicn']."', NAMHOC='".$_POST['namcn']."'
             WHERE MACT='".$_POST["mactcn"]."'";
        }
        $q=$conn->query($sql);
   
        echo "Cập nhật thành công!";
    }
