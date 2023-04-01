<?php
    require_once("..//connect.php");
    session_start();
    if(isset($_FILES["filex"])){
          $date=getdate();
            $n1=$date['year'];
            $n2=$date['year']+1;
            $namhoc=$n1."-".$n2;
            $q3=$conn->query("SELECT MSLOP FROM phanconggd WHERE MAGV='".$_SESSION["Login"]."' AND NAMHOC='".$namhoc."'");
            while($row=$q3->fetch_assoc()){
                $lop=$row["MSLOP"];
            }

            $name='../dslop/'.$_FILES['filex']['name'];
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
                    if($j==2 || $j==5){
                        $data[$i - 2][$j] =date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow($j, $i)->getValue()));;
                    }
                    else{
                        $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                    }
                
                }
            }
            //Hiển thị mảng dữ liệu
           
            $r=count($data);
          $c= count($data[0]);
          
            for($i=0;$i<$r;$i++){
                $sql="INSERT INTO hocsinh(`HOTENHS`, `NGAYSINH`, `GIOITINH`, `DIACHI`, `NGAYNHAPHOC`, `HOTENCHA`, `SDTCHA`, `HOTENME`, `SDTME`, `MSLOP`) 
                                VALUES ('".$data[$i][1]."','".$data[$i][2]."','".$data[$i][3]."','".$data[$i][4]."','".$data[$i][5]."',
                                        '".$data[$i][6]."','".$data[$i][7]."','".$data[$i][8]."','".$data[$i][9]."','".$lop."')";
                $q1=$conn->query($sql);
               
            }
            unlink($name);

          
        }
    ##########################################################
    #Cập nhật file excel
    if(isset($_FILES["filecn"])){
        $date=getdate();
          $n1=$date['year'];
          $n2=$date['year']+1;
          $namhoc=$n1."-".$n2;
          $q3=$conn->query("SELECT MSLOP FROM phanconggd WHERE MAGV='".$_SESSION["Login"]."' AND NAMHOC='".$namhoc."'");
          while($row=$q3->fetch_assoc()){
              $lop=$row["MSLOP"];
          }

          $name='../dslop/'.$_FILES['filecn']['name'];
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
          for ($i =2; $i <= $Totalrow; $i++) {
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
            $sql="UPDATE `hocsinh` SET `HOTENHS`='".$data[$i][1]."',`NGAYSINH`='".$data[$i][2]."',
            `GIOITINH`='".$data[$i][3]."',`DIACHI`='".$data[$i][4]."',`NGAYNHAPHOC`='".$data[$i][5]."',`HOTENCHA`='".$data[$i][6]."',
            `SDTCHA`='".$data[$i][7]."',`HOTENME`='".$data[$i][8]."',`SDTME`='".$data[$i][9]."' WHERE MAHS='".$data[$i][0]."'";
             
              $q1=$conn->query($sql);
             
          }
          unlink($name);
        
      }

 ?>