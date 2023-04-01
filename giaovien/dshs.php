<?php require_once("../connect.php");
session_start();
require_once("header.php");
?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!--Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <script src="../js/giaovien.js"></script>
</head>
<body>
<!--Cập nhật thông tin học sinh-->
<div id="cnhs">
    <script>
        function cnhs(){
    var mahs=document.getElementById("mahs").value;
    var hotenhs=document.getElementById("hotenhs").value;
    var ngaysinh=document.getElementById("ngaysinhhs").value;
    var gioitinh=document.getElementById("gioitinhhs").value;
    var hotencha=document.getElementById("hotencha").value;
    var sdtcha=document.getElementById("sdtcha").value;
    var hotenme=document.getElementById("hotenme").value;
    var sdtme=document.getElementById("sdtme").value;
    var diachi=document.getElementById("diachihs").value;
    var ngaynhaphoc=document.getElementById("ngaynhaphoc").value;
    var anhcha = $("#anhcha").prop("files")[0];
    var anhhs = $("#anhhs").prop("files")[0];
    var anhme = $("#anhme").prop("files")[0];
    var form_data = new FormData();
    form_data.append("mahs",mahs);
    form_data.append("hotenhs",hotenhs);
    form_data.append("ngaysinh",ngaysinh);
    form_data.append("gioitinh",gioitinh);
    form_data.append("hotencha",hotencha);
    form_data.append("sdtcha",sdtcha);
    form_data.append("hotenme",hotenme);
    form_data.append("sdtme",sdtme);
    form_data.append("diachi",diachi);
    form_data.append("ngaynhaphoc",ngaynhaphoc);
    form_data.append("anhcha",anhcha);
    form_data.append("anhme",anhme);
    form_data.append("anhhs",anhhs);
    $.ajax({
        url: "cnhs.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
           alert("Cập nhật thành công!");
            window.location="../giaovien/dshs.php";
        }
    });
    


}
    </script>
<?php 
    $date=getdate();
    $n1=$date['year'];
    $n2=$date['year']+1;
    $namhoc=$n1."-".$n2;
    $q3=$conn->query("SELECT MSLOP FROM phanconggd WHERE MAGV='".$_SESSION["Login"]."' AND NAMHOC='".$namhoc."'");
    while($row=$q3->fetch_assoc()){
        $lop=$row["MSLOP"];
    }

    $_SESSION["lop"]=$lop;
?>
<br>
<p style="text-align: center; font-size: 30; color: red;">CẬP NHẬT THÔNG TIN HỌC SINH</p>
    <div id="ediths">
        
    </div>
</div>


<!--Danh sách hocsinh-->
    <div id="hs-edit">
        <?php
            $s=$conn->query("SELECT*FROM lop WHERE MSLOP='".$lop."'");
            while($rl=$s->fetch_assoc()){
                $tenlop=$rl["TENLOP"];
            }
        ?>
        <p style="text-align: center; font-size: 30; color: red; text-transform: uppercase;">DANH SÁCH HỌC SINH LỚP <?php echo $tenlop; ?></p>
        <table style='margin-left: 750px;'>
        <tr>
        <td>
            <select id='tuychon'>
                <option>Xuất ra file Excel</option>
                <option>Cập nhật từ Excel</option>
                <option>Thêm từ Excel</option>
            </select>
            <td><button onclick='openCN()' style='height: 30px;background-color:#0000ff; color:#ffffff; border:none; border-radius: 4px;'>Chọn</button></td>
            </td>
            <td><button id="btn-insert" onclick="hienInsert()"><i class="bi bi-plus"></i> Thêm</button></td>
        </tr>
        </table>
       
       
        
        <br>
        <script>
            function hienInsert(){
                document.getElementById("themhs").style.display='block';
                document.getElementById("hs-edit").style.display='none';
                document.getElementById("cnhs").style.display='none';
            }

            
        </script>
        
        <div id="list">
            <table id="table-hs">
                <tr style='position:sticky; top:0;' >
                    <td id="colmahs" style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Mã số</b></td>
                    <td style="width: 200px; background-color:#0000ff ; 
                                                color:white; height: 50px;"><b>Họ tên</b></td>
                    <td style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Giới tính</b></td>
                    <td style="width: 200px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Họ tên cha</b></td>
                    <td style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Điện thoại cha</b></td>
                    <td style="width: 200px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Họ tên mẹ</b></td>
                    <td style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Điện thoại mẹ</b></td>
                    <td style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px;"><b>Cập nhật</b></td>
                    
                </tr>
            <?php 
                $q=$conn->query("SELECT * FROM hocsinh WHERE MSLOP='".$lop."'");
                while($row=$q->fetch_assoc()){ 
            ?>
                <tr>
                    <td id="colmahs" style="width: 100px;"><?php echo $row["MAHS"] ; ?></td>
                    <td style="width: 200px;"><button class='btn-anh' onclick='ImgOP(this,"hs")'><?php echo $row["HOTENHS"] ; ?></button></td>
                    <td style="width: 100px;"><?php echo $row["GIOITINH"] ; ?></td>
                    <td style="width: 200px;"><button class='btn-anh' onclick='ImgOP(this,"cha")'><?php echo $row["HOTENCHA"]  ?></button></td>
                    <td style="width: 100px;"><?php echo $row["SDTCHA"] ; ?></td>
                    <td style="width: 200px;"><button class='btn-anh' onclick='ImgOP(this,"me")'><?php echo $row["HOTENME"]  ?></button></td>
                    <td style="width: 100px;"><?php echo $row["SDTME"] ; ?></td>
                    <td style="width: 100px;"><button id="btn-edit" onclick="openEdit(this)"><i class="bi bi-pencil-square"></i></button></td>
                </tr>
            <?php }?>
            </table>
        </div>
    </div>
    <div id='open-img'>
        <script>
             function ImgOP(row,t){
                
                document.getElementById("open-img").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
                $.ajax({
                    type: 'POST',
                    url: 'open-cnhs.php',
                    data: {
                        msanh: ms,
                        t: t
                    },
                    success: function(response){
                        $('#im').html(response);
                    }
                });
            }

            function closeANH(){
                document.getElementById("open-img").style.display='none';
            }
        </script>
        <style>
            #open-img{
                  
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 4;
                    position: fixed;
                  
                    display: none;
            }

            #images{
                width: 300px;
                height: 330px;
                background-color: aliceblue;
                margin-top: 200px;
                margin-left: 600px;
                border-style: solid;
                border-color:black;
                border-radius: 10px;
                overflow-x: hidden;
            }
            #close-img{
                width: 50px;
                height: 30px;
                border: none;
                margin-left: 250px;
                background-color: #ff0000;
                color:aliceblue;
            }
            
        </style>
        <div id='images'>
            <button id="close-img" onclick='closeANH()'><i class="bi bi-x"></i></button>
            <div id='im' style='width: 200px; height: 200px; margin-left: 50px; margin-top: 50px;'>
            </div>
        </div>
    </div>
    <!--Thêm học sinh-->
    <div id="themhs">
        <script>
           
            function themHS(){
                var malop=document.getElementById("malop").value;
                var hotenhs=document.getElementById("hotenhs").value;
                var ngaysinh=document.getElementById("ngaysinhhs").value;
                var gioitinh=document.getElementById("gioitinhhs").value;
                var hotencha=document.getElementById("hotencha").value;
                var sdtcha=document.getElementById("sdtcha").value;
                var hotenme=document.getElementById("hotenme").value;
                var sdtme=document.getElementById("sdtme").value;
                var diachi=document.getElementById("diachihs").value;
                var ngaynhaphoc=document.getElementById("ngaynhaphoc").value;
                var anhcha = $("#anhcha").prop("files")[0];
                var anhhs = $("#anhhs").prop("files")[0];
                var anhme = $("#anhme").prop("files")[0];
                var form_data = new FormData();
                form_data.append("malop",malop);
                form_data.append("hotenhs",hotenhs);
                form_data.append("ngaysinh",ngaysinh);
                form_data.append("gioitinh",gioitinh);
                form_data.append("hotencha",hotencha);
                form_data.append("sdtcha",sdtcha);
                form_data.append("hotenme",hotenme);
                form_data.append("sdtme",sdtme);
                form_data.append("diachi",diachi);
                form_data.append("ngaynhaphoc",ngaynhaphoc);
                form_data.append("anhcha",anhcha);
                form_data.append("anhme",anhme);
                form_data.append("anhhs",anhhs);
                $.ajax({
                    url: "themhs.php",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(response){
                        alert("Đã thêm thành công!");
                        location.reload();
                    }
                });

            }

            function Huy(){
                location.reload();
            }
            

        </script>
        <p style="text-align: center; font-size: 30; color: red;">THÊM HỌC SINH</p>
        <table id='btn-tb'><tr>
            <td><button id="btnthem" onclick="themHS()">Thêm</button></td>";
            <td><button id='btnhuy' onclick='Huy()'>Hủy</button></td></tr></table>
        <form method="post"  enctype="multipart/form-data">
        
        <input type="hidden" id='malop' value='<?php echo $lop; ?>'>
        <table id='hsthem'>
        
                <tr>
                    <td colspan='2' >Ảnh cha: <input id="anhcha" type="file" ></td>
                    <td colspan='2' >Ảnh học sinh: <input id="anhhs" type="file"></td>
                    <td colspan='2' >Ảnh mẹ: <input id="anhme" type="file"></td>
                </tr>
            <tr>
                    <td style='width: 130px; '>Họ tên</td>
                    <td style='width: 200px; '><input id='hotenhs' ></td>
                    <td style='width: 130px; '>Ngày sinh</td>
                    <td style='width: 200px; '><input id='ngaysinhhs' placeholder="yyyy-mm-dd"></td>
                    <td style='width: 130px; '>Giới tính</td>
                    <td style='width: 200px; '><input id='gioitinhhs' ></td>
                </tr>
                <tr>
                <td style='width: 130px; '>Họ tên cha</td>
                <td style='width: 200px; '><input id='hotencha' ></td>
                <td style='width: 130px; '>Họ tên mẹ</td>
                <td style='width: 200px; '><input id='hotenme'></td>
                <td style='width: 130px; '>Địa chỉ</td>
                <td style='width: 200px;'><input id='diachihs' ></td>
            </tr>
            <tr>
                    <td style='width: 130px; '>SDT cha</td>
                    <td style='width: 200px; '><input id='sdtcha'></td>
                    <td style='width: 130px; '>SDT mẹ</td>
                    <td style='width: 200px; '><input id='sdtme'></td>
                    <td style='width: 130px; '>Ngày nhập học</td>
                    <td style='width: 200px; '><input id='ngaynhaphoc' placeholder="yyyy-mm-dd"></td>
                </tr>
                    
        </table>
        </form>
    </div>
    <!--Thêm học sinh từ Excel---------------------------------------------------------------------------------->
    <div id='hs-excel'>
    <style>
           
            #xemimg{
                width: 80%;
                height: 80%;
                margin-top:30px;
                border-radius: 50px;
                border-style: double;
                background-color:#ffffff;
                margin-left: 10%;
               overflow-x: hidden;
                

            }
            .bt-x{
                background-color: red;
                color:#ffffff;
                width: 7%;
                height: 5%;
                font-size: 20;
                margin-left: 93%;
            }
           
        </style>
       
        <script>
            function ehs(){
                var file=$("#themexcel").prop("files")[0];
                var form_data = new FormData();
				form_data.append("filex",file);

				$.ajax({
                        url: 'hs-excel-data.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                          window.location='dshs.php';
                        
                        }
                    });
            }
            function clhs(){
                document.getElementById("hs-excel").style.display='none';
            }
        </script>
        <div id='xemimg'>
            <button class='bt-x' onclick='clhs()'><i class='bi bi-x'></i></button>
            <p style='color:red; font-size: 30; text-align:center; margin-top: 30px;'>THÊM HỌC SINH TỪ EXCEL</p>
            <br>
                
                <input type='file' id='themexcel' style='margin-left:20%'>
                <button onclick='ehs()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Thêm</button>
                <p style='margin-left: 20%; font-size: 14; color: red'>(*File Excel phải có cấu trúc giống như file mẫu bên dưới.)</p>
           
            <p style='font-size: 18; text-align:center'><b>File Excel mẫu</b></p>
            <p style=' text-align:center'><img src='../css/filehsmau.JPG' style='width: 70%; height:20%; border-style: solid; border-color:red;' ></p>
       
        </div>   
        

    </div>
    <!--Cập nhật từ Excel----------------------------------------------------------------------------->
    <div id='cn-excel'>
        <script>
            function openCN(){
                var i=document.getElementById("tuychon").value;
                if(i=='Thêm từ Excel')
                    document.getElementById("hs-excel").style.display='block';
                else{
                    if(i=='Cập nhật từ Excel'){
                        document.getElementById("cn-excel").style.display='block';
                    }
                    else{
                        window.location='thu.php';
                    }
                }
            }
        </script>
    <style>
           
            #xemimg{
                width: 80%;
                height: 80%;
                margin-top:30px;
                border-radius: 50px;
                border-style: double;
                background-color:#ffffff;
                margin-left: 10%;
               
                

            }
           
        </style>
       
        <script>
            function cnex(){
                var file=$("#cnexcel").prop("files")[0];
                var form_data = new FormData();
				form_data.append("filecn",file);

				$.ajax({
                        url: 'hs-excel-data.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                          window.location='dshs.php';
                           
                        }
                    });
            }

            function clcn(){
                    document.getElementById("cn-excel").style.display='none';
                }
        </script>
        <div id='xemimg'>
            <button class='bt-x' onclick='clcn()'><i class='bi bi-x'></i></button>
            <p style='color:red; font-size: 30; text-align:center; margin-top: 30px;'>CẬP NHẬT HỌC SINH TỪ EXCEL</p>
            <br>
                
                <input type='file' id='cnexcel' style='margin-left:20%'>
                <button onclick='cnex()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Cập nhật</button>
                <p style='margin-left: 20%; font-size: 14; color: red'>(*File Excel phải có cấu trúc giống như file mẫu bên dưới.)</p>
           
            <p style='font-size: 18; text-align:center'><b>File Excel mẫu</b></p>
            <p style=' text-align:center'><img src='../css/filehsmau.JPG' style='width: 70%; height:20%; border-style: solid; border-color:red;' ></p>
       
        </div>   
        

    </div>
 <style>
            #hs-excel{
                top: 0;
                bottom:0;
                left:0;
                right:0;
                background-color: rgba(0, 0, 0, 0.7);
                z-index: 4;
                position: fixed;
                display: none;

            }
            #cn-excel{
                top: 0;
                bottom:0;
                left:0;
                right:0;
                background-color: rgba(0, 0, 0, 0.7);
                z-index: 4;
                position: fixed;
                display: none;

            }

            .btn-anh{
                background-color: aliceblue;
                border: none;
                color:#ff0000;
            }
			#btnthem{
				width: 80px;
				
				border: none;
				color:#ffffff;
				background-color: #00bf00;
				border-radius: 4px;
			}
			#hsthem{
				margin-left: 55px ;
			}

			#hsthem td{
				height: 60px;
			}
			#themhs{
    			background-color: #ffffff;
				width: 1100px;
				height: 500px;
				margin-top: 30px;
				margin-left: 200px;
				display:none;
			}
			#hs-edit{
				
				width: 1100px;
				height: 500px;
				margin-top: 30px;
				margin-left: 200px;
				
			}
				
				
				
			
			#list{
				width:1000px;
				height:350px;
				background-color: #b2b2b2;
				overflow-y: scroll;
				margin-left: 50px;
			}

			#table-hs td{
				background-color:#ffffff;
				text-align: center;
				border-style: double;
				height: 40px;
				font-size: 14;
			}

			#table-hs #colmahs{
                display:none;
            }

			#ediths{
				width: 990px;
				height: 400px;
				margin-left: 55px;
                
			}

			#hocsinh td{
				background-color:#CCFFFF;
				border-style: double;
				height: 40px;
			}

			#hocsinh img{
				width: 150px;
				height: 150px;
				margin-top: 10px;
				margin-bottom: 40px;
				margin-left: 90px;;
			}

             #btnhuy{
				width: 100px;
				color:aliceblue;
				background-color: red;
                border:none;
                border-radius: 4px;
			}
            #ediths #btncn{
				width: 100px;
				color:aliceblue;
				background-color: blue;
                border: none;
                border-radius: 4px;
			}
             #btn-tb{
                width:200px;
                margin-left: 800px;
            }

            

			#btn-insert{
				width: 80px;
				height: 30px;
				background-color: #00bf00;
				
				border:#00bf00;
				color:aliceblue;
				border-radius: 5px;
			}

			#btn-edit{
				width: 40px;
				height: 40px;
				background-color: #0000ff;
				border:#0000ff;
				color:aliceblue;
				border-radius: 5px;
			}

			#btn-delete{
				width: 40px;
				height: 40px;
				background-color: #ff0000;
				border:#ff0000;
				color:aliceblue;
				border-radius: 5px;
			}
            #cnhs{
                background-color: #ffffff;
                width: 1100px;
                height: 500px;
                margin-top: 30px;
                margin-left: 200px;
            
                display:none;
            }
		</style>
    </body>
</html>