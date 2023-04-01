<?php
    require_once("../connect.php");
    session_start();
    
    ##########################################################
        #Xuất file excel
       
           $s=$conn->query("SELECT count(*) FROM `hocsinh` WHERE MSLOP='".$_GET["mslop"]."'");
            while($r1=$s->fetch_assoc()){
                $c=$r1["count(*)"];
            }

            $s1=$conn->query("SELECT * FROM lop WHERE MSLOP='".$_GET["mslop"]."'");
            while($r1=$s1->fetch_assoc()){
                $lop=$r1["TENLOP"];
            }

            $data=array();
            $q=$conn->query("SELECT * FROM `hocsinh` WHERE MSLOP='".$_GET["mslop"]."'");

            for($i=0;$i<$c;$i++){
                
                while($r=$q->fetch_assoc()){
                    $data[]=array($r["MAHS"], $r["HOTENHS"], $r["NGAYSINH"],$r["GIOITINH"],$r["DIACHI"], $r["NGAYNHAPHOC"],
                     $r["HOTENCHA"],$r["SDTCHA"], $r["HOTENME"], $r["SDTME"]);
                }
               
            }
            require "../PHPExcel-1.8/Classes/PHPExcel.php";

            //Khởi tạo đối tượng
            $excel = new PHPExcel();
            //Chọn trang cần ghi (là số từ 0->n)
            $excel->setActiveSheetIndex(0);
            //Tạo tiêu đề cho trang. (có thể không cần)
            $title="Danh sách học sinh lớp ".$lop;
            $excel->getActiveSheet()->setTitle($title);

            //Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

            //Xét in đậm cho khoảng cột
            $excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
            //Tạo tiêu đề cho từng cột
            //Vị trí có dạng như sau:
            /**
             * |A1|B1|C1|..|n1|
             * |A2|B2|C2|..|n1|
             * |..|..|..|..|..|
             * |An|Bn|Cn|..|nn|
             */

            $excel->getActiveSheet()->setCellValue('A1', 'Mã số');
            $excel->getActiveSheet()->setCellValue('B1', 'Họ tên');
            $excel->getActiveSheet()->setCellValue('C1', 'Ngày sinh');
            $excel->getActiveSheet()->setCellValue('D1', 'Giới tính');
            $excel->getActiveSheet()->setCellValue('E1', 'Địa chỉ');
            $excel->getActiveSheet()->setCellValue('F1', 'Ngày nhập học');
            $excel->getActiveSheet()->setCellValue('G1', 'Họ tên cha');
            $excel->getActiveSheet()->setCellValue('H1', 'Số ĐT cha');
            $excel->getActiveSheet()->setCellValue('I1', 'Họ tên mẹ');
            $excel->getActiveSheet()->setCellValue('J1', 'Số ĐT mẹ');
            // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
            // dòng bắt đầu = 2
            $numRow = 2;
            foreach ($data as $row) {
                $excel->getActiveSheet()->setCellValue('A' . $numRow, $row[0]);
                $excel->getActiveSheet()->setCellValue('B' . $numRow, $row[1]);
                $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[2]);
                $excel->getActiveSheet()->setCellValue('D' . $numRow, $row[3]);
                $excel->getActiveSheet()->setCellValue('E' . $numRow, $row[4]);
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $row[5]);
                $excel->getActiveSheet()->setCellValue('G' . $numRow, $row[6]);
                $excel->getActiveSheet()->setCellValue('H' . $numRow, $row[7]);
                $excel->getActiveSheet()->setCellValue('I' . $numRow, $row[8]);
                $excel->getActiveSheet()->setCellValue('J' . $numRow, $row[9]);
                $numRow++;
            }
            // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
            // ở đây mình lưu file dưới dạng excel2007

            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="'.$title.'.xls"');
            PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
            
                    
        
 ?>