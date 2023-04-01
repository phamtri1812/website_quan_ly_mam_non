<?php   require_once('../connect.php');
    #Xem thông tin giáo viên
    if(isset($_POST["idgv"])){
        $id=$_POST["idgv"];
        $q1=$conn->query("SELECT*FROM GV WHERE MSGV='".$id."'");
        while($row=$q1->fetch_assoc()){
            $a=date_create($row['NGAYSINH']);
            date_format($a,'Y-m-d');
            $ns= $a->format('d-m-Y');

            $a=date_create($row['NGAYVAOLAM']);
            date_format($a,'Y-m-d');
            $nvl=$a->format('d-m-Y'); 
            echo "<p style='text-align: center; 'font-size: 30; color: red;'>
            <img style='width: 150px; height: 150px; border-radius: 50%;' src='".$row['ANHGV']."'><br><input type='file' id='anhgv' ><br></p>";
            echo"<table class='table-user'>   
                <tr>
                    <td style='width: 150px;'><b>Mã số giáo viên: </b></td>
                    <td style='width: 250px;'><input id='msgv' type='text' value='".$row['MSGV']."'></td>
                    <td style='width: 150px;'><b>Tên đăng nhập: </b></td>
                    <td style='width: 250px;'><input id='tendn' type='text' value='".$row['TENDN']."'></td>
                </tr> 
                <tr>
                    <td style='width: 150px;'><b>Họ và tên: </b></td>
                    <td style='width: 250px;'><input id='hotengv' type='text' value='".$row['HOTENGV']."'></td>
                    <td style='width: 150px;'><b>Giới tính: </b></td>
                    <td style='width: 250px;'><input id='gioitinh' type='text' value='".$row['GIOITINH']."'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>Ngày sinh: </b></td>
                    <td style='width: 250px;'><input id='ngaysinh' type='text' value='".$ns."'></td>

                    <td style='width: 150px;'><b>Địa chỉ: </b></td>
                    <td style='width: 250px;'><input id='diachi' type='text' value='".$row['DIACHI']."'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>CMND/CCCD: </b></td>
                    <td style='width: 250px;'><input id='cmnd/cccd' type='text' value='".$row['CMNDCCCD']."'></td>
                    <td style='width: 150px;'><b>Số điện thoại: </b></td>
                    <td style='width: 250px;'><input id='sdt' type='text' value='".$row['SDT']."'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>Ngày vào làm: </b></td>
                    <td style='width: 250px;'><input id='ngayvaolam' type='text' value='".$nvl."'></td>
                    <td style='width: 150px;'><b>Trình độ: </b></td>
                    <td style='width: 250px;'><input id='trinhdo' type='text' value='".$row['TRINHDO']."'></td>
                </tr>
                
            </table>
           
            <button class='btncn' onclick='editGV()'>Cập nhật</button>";
        }
    }	
    #cập nhật giáo viên
    if(isset($_POST["tendn"])){

        $a=date_create($_POST['ngaysinh']);
        date_format($a,'d-m-Y');
        $ns= $a->format('Y-m-d');

        $a=date_create($_POST['ngayvaolam']);
        date_format($a,'d-m-M');
        $nvl=$a->format('Y-m-d');
        if(isset($_FILES['file'])){
            $name='../anhgv/'.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],$name );
            $sql="UPDATE gv SET  HOTENGV='".$_POST["hotengv"]."', NGAYSINH='".$ns."',
                                    GIOITINH='".$_POST["gioitinh"]."', DIACHI='".$_POST["diachi"]."', CMNDCCCD='".$_POST["cmnd"]."',
                                    SDT='".$_POST["sdt"]."', NGAYVAOLAM='".$nvl."', TRINHDO='".$_POST["trinhdo"]."', TENDN='".$_POST["tendn"]."',
                                    ANHGV='".$name."' WHERE  MSGV='".$_POST["msgv"]."'";
        }
        else{

            $sql="UPDATE gv SET  HOTENGV='".$_POST["hotengv"]."', NGAYSINH='".$ns."',
                                    GIOITINH='".$_POST["gioitinh"]."', DIACHI='".$_POST["diachi"]."', CMNDCCCD='".$_POST["cmnd"]."',
                                    SDT='".$_POST["sdt"]."', NGAYVAOLAM='".$nvl."', TRINHDO='".$_POST["trinhdo"]."', TENDN='".$_POST["tendn"]."'
                                    WHERE  MSGV='".$_POST["msgv"]."'";
        }
         $q=$conn->query($sql);   
  
    }

    #Thêm giáo viên
    if(isset($_POST["msgvnew"])){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $mk='';
        $size = strlen( $chars );
        for( $i = 0; $i < 8; $i++ ) {
            $mk .= $chars[ rand( 0, $size - 1 ) ];
        }
        if(isset($_FILES['filenew'])){
            $name='../anhgv/'.$_FILES['filenew']['name'];
            move_uploaded_file($_FILES['filenew']['tmp_name'],$name );
            $sql="INSERT INTO gv VALUES('".$_POST["msgvnew"]."', '".$_POST["hotengvnew"]."','".$_POST["ngaysinhnew"]."', '".$_POST["diachinew"]."',
                                 '".$_POST["cmndnew"]."', '".$_POST["sdtnew"]."', '".$_POST["ngayvaolamnew"]."', '".$_POST["trinhdonew"]."', '"
                                 .$_POST["gioitinhnew"]."','".$_POST["tendnnew"]."', '".$mk."', '".$name."','".$_POST["nangkhieunew"]."')";
            
        }
        else{

            $sql="INSERT INTO gv(MSGV,HOTENGV,NGAYSINH,DIACHI,CMNDCCCD,SDT,NGAYVAOLAM,TRINHDO,GIOITINH,TENDN,MATKHAU,NANGKHIEU) 
             VALUES('".$_POST["msgvnew"]."', '".$_POST["hotengvnew"]."','".$_POST["ngaysinhnew"]."', '".$_POST["diachinew"]."',
            '".$_POST["cmndnew"]."', '".$_POST["sdtnew"]."', '".$_POST["ngayvaolamnew"]."', '".$_POST["trinhdonew"]."', '"
            .$_POST["gioitinhnew"]."','".$_POST["tendnnew"]."', '".$mk."','".$_POST["nangkhieunew"]."')";
        }
        $q=$conn->query($sql); 
       
    }

        if(isset($_POST["lkcu"])){
            $date=getdate();
            $n1=$date['year'];
            $n2=$date['year']+1;
            $namhoc=$n1."-".$n2;
            $s=$conn->query("SELECT HOTENGV FROM gv,phanconggd WHERE gv.MSGV=phanconggd.MAGV AND phanconggd.MSLOP='".$_POST["lkcu"]."' 
                                                                                                AND phanconggd.NAMHOC='".$namhoc."'");
            while($r=$s->fetch_assoc()){
                echo "Giáo viên: ".$r["HOTENGV"];
            }
        }

        if(isset($_POST["lkmoi"])){
            $date=getdate();
            $n1=$date['year'];
            $n2=$date['year']+1;
            $namhoc=$n1."-".$n2;
            $s=$conn->query("SELECT HOTENGV FROM gv,phanconggd WHERE gv.MSGV=phanconggd.MAGV AND phanconggd.MSLOP='".$_POST["lkmoi"]."' 
                                                                                                AND phanconggd.NAMHOC='".$namhoc."'");
            while($r=$s->fetch_assoc()){
                echo "Giáo viên: ".$r["HOTENGV"];
            }
        }
            
    #Thêm bằng file excel
    if(isset($_FILES["filex"])){
            $name='../baidang/'.$_FILES['filex']['name'];
            move_uploaded_file($_FILES['filex']['tmp_name'],$name );

            //Nhúng PHPExcel
            require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

            //Đường dẫn file
            $file = $name;
            //Tiến hành xác thực file
            $objFile = PHPExcel_IOFactory::identify($file);
            $objData = PHPExcel_IOFactory::createReader($objFile);

            //Chỉ đọc dữ liệu
            $objData->setReadDataOnly(true);

            // Load dữ liệu sang dạng đối tượng
            $objPHPExcel = $objData->load($file);

            //Lấy ra số trang sử dụng phương thức getSheetCount();
            // Lấy Ra tên trang sử dụng getSheetNames();

            //Chọn trang cần truy xuất
            $sheet = $objPHPExcel->setActiveSheetIndex(0);

            //Lấy ra số dòng cuối cùng
            $Totalrow = $sheet->getHighestRow();
            //Lấy ra tên cột cuối cùng
            $LastColumn = $sheet->getHighestColumn();

            //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
            $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

            //Tạo mảng chứa dữ liệu
            $data = [];

            //Tiến hành lặp qua từng ô dữ liệu
            //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
            for ($i = 2; $i <= $Totalrow; $i++) {
                //----Lặp cột
                for ($j = 0; $j < $TotalCol; $j++) {
                    // Tiến hành lấy giá trị của từng ô đổ vào mảng
                    if($j==2 || $j==6){
                        $data[$i - 2][$j] =date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow($j, $i)->getValue()));;
                    }
                    else{
                        $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                    }
                
                }
            }
            //Tạo mật khẩu
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $mk='';
            $size = strlen( $chars );
            for( $i = 0; $i < 8; $i++ ) {
                $mk .= $chars[ rand( 0, $size - 1 ) ];
            }
            //Hiển thị mảng dữ liệu
           
            $r=count($data);
            $c= count($data[0]);
            for($i=0;$i<$r;$i++){
                $sql="INSERT INTO `gv`(`MSGV`, `HOTENGV`, `NGAYSINH`, `DIACHI`, `CMNDCCCD`, `SDT`, `NGAYVAOLAM`, `TRINHDO`, `GIOITINH`, `TENDN`, `MATKHAU`,`NANGKHIEU`)
                                VALUES ('".$data[$i][0]."','".$data[$i][1]."','".$data[$i][2]."','".$data[$i][3]."','".$data[$i][4]."',
                                        '".$data[$i][5]."','".$data[$i][6]."','".$data[$i][7]."','".$data[$i][8]."',
                                        '".$data[$i][9]."','".$mk."', '".$data[$i][10]."')";
                $q1=$conn->query($sql);
        
               
            }
            unlink($name);
    }

    ############################################################################################################
     #Cập nhật bằng file excel
     if(isset($_FILES["filecn"])){
        $name='../baidang/'.$_FILES['filecn']['name'];
        move_uploaded_file($_FILES['filecn']['tmp_name'],$name );

        //Nhúng PHPExcel
        require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

        //Đường dẫn file
        $file = $name;
        //Tiến hành xác thực file
        $objFile = PHPExcel_IOFactory::identify($file);
        $objData = PHPExcel_IOFactory::createReader($objFile);

        //Chỉ đọc dữ liệu
        $objData->setReadDataOnly(true);

        // Load dữ liệu sang dạng đối tượng
        $objPHPExcel = $objData->load($file);

        //Lấy ra số trang sử dụng phương thức getSheetCount();
        // Lấy Ra tên trang sử dụng getSheetNames();

        //Chọn trang cần truy xuất
        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        //Lấy ra số dòng cuối cùng
        $Totalrow = $sheet->getHighestRow();
        //Lấy ra tên cột cuối cùng
        $LastColumn = $sheet->getHighestColumn();

        //Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
        $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

        //Tạo mảng chứa dữ liệu
        $data = [];

        //Tiến hành lặp qua từng ô dữ liệu
        //----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
        for ($i = 2; $i <= $Totalrow; $i++) {
            //----Lặp cột
            for ($j = 0; $j < $TotalCol; $j++) {
                // Tiến hành lấy giá trị của từng ô đổ vào mảng
                    $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
            }
        }
        //Hiển thị mảng dữ liệu
       
        $r=count($data);
        $c= count($data[0]);
        for($i=0;$i<$r;$i++){

            $sql="UPDATE `gv` SET `HOTENGV`='".$data[$i][1]."',`NGAYSINH`='".$data[$i][2]."',`DIACHI`='".$data[$i][3]."',
            `CMNDCCCD`='".$data[$i][4]."',`SDT`='".$data[$i][5]."',`NGAYVAOLAM`='".$data[$i][6]."',`TRINHDO`='".$data[$i][7]."',
            `GIOITINH`='".$data[$i][8]."',`TENDN`='".$data[$i][9]."',`NANGKHIEU`='".$data[$i][10]."' WHERE MSGV='".$data[$i][0]."'";
            $q1=$conn->query($sql);
        }
        unlink($name);
    }
?>