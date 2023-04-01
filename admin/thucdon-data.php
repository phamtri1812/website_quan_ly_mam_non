<?php
    require_once("../connect.php");
   
    #Xem bài thực đơn
    if(isset($_POST['link'])){
        echo "<br><br><p style='text-align: center; font-size: 30; color: red'>".$_POST["tieude"]."</p>";
        echo "<iframe src='".$_POST["link"]."#toolbar=0' width='800px' height='570px'>
        </iframe>";
        
       
    }

    #Liệt kê
    if(isset($_POST["thang"])){
       echo "<table id='table-thucdon'>
        <tr style='position:sticky; top:0;'>
            <td id='cot-an'>Mã số</td>
            <td style='width: 470; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
            <td id='cot-an'>Link</td>
            <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm</td>
            <td style='width: 150; background-color: #1386f9; color:aliceblue'>Chức năng</td>
          
        </tr>";
        if($_POST["thang"]=='Tất cả' && $_POST['nam']!='Tất cả'){        
            $sql=("SELECT*FROM thucdon WHERE NAM='".$_POST['nam']."'");
        }
        else{
            if($_POST['thang']=='Tất cả' && $_POST['nam']=='Tất cả'){
                $sql=("SELECT*FROM thucdon");
            }
            else{
                if($_POST['thang']!='Tất cả' && $_POST['nam']=='Tất cả'){
                    $sql=("SELECT*FROM thucdon WHERE THANG='".$_POST['thang']."'");
                }
                else{
                    $sql=("SELECT*FROM thucdon WHERE THANG='".$_POST['thang']."' AND NAM='".$_POST['nam']."'");
                }
            }
        }
        $q=$conn->query($sql);
        while($row=$q->fetch_assoc()){
            echo "<tr>
                    <td id='cot-an'>". $row["MATD"] ."</td>
                    <td style='width: 470;'>".$row["TIEUDE"]."</td>
                    <td id='cot-an'>".$row["LINK"]."</td>
                    <td style='width: 180;'>".$row["NAM"]."</td>
                    <td ><button id='btn-xem' onclick='xem(this)'><i class='bi bi-eye'></i></button>
                        <button id='btn-sua' onclick=suabai(this)><i class='bi bi-pen'></i></button>
                        <button id='btn-xoa' onclick='xoa(this)'><i class='bi bi-x'></i></button></td>
                </tr>";
                    
        }
        echo " </table>";
    }

    #Thêm thực đơn
    if(isset($_FILES['filedang'])){
       $name='../thucdon/'.$_FILES['filedang']['name'];
        move_uploaded_file($_FILES['filedang']['tmp_name'],$name );
       
        $q1="INSERT INTO thucdon(TIEUDE,LINK,THANG,NAM) VALUES('".$_POST['tieudedang']."',
         '".$name."', '".$_POST['thangdang']."', '".$_POST["namdang"]."' )";
        $q=$conn->query($q1);
       
        
    }

    #Xóa thực đơn
    if(isset($_POST["matdxoa"])){
        $q=$conn->query("DELETE FROM thucdon WHERE MATD='".$_POST["matdxoa"]."'");
    }

    #Cập nhật thực đơn
    if(isset($_POST["matdcn"])){
        
        if(isset($_FILES['filecn'])){
            $name='../thucdon/'.$_FILES['filecn']['name'];
            move_uploaded_file($_FILES['filecn']['tmp_name'],$name );
            $sql="UPDATE thucdon SET TIEUDE='".$_POST['tieudecn']."', THANG='".$_POST['thangcn']."', NAM='".$_POST['namcn']."',
            LINK='".$name."' WHERE MATD='".$_POST["matdcn"]."'";
        }
        else{
            $sql="UPDATE thucdon SET TIEUDE='".$_POST['tieudecn']."', THANG='".$_POST['thangcn']."', NAM='".$_POST['namcn']."'
                 WHERE MATD='".$_POST["matdcn"]."'";
        }
        $q=$conn->query($sql);
    }