<?php require_once("../connect.php");
session_start();
require_once("../inc/header.php");
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
    
</head>

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
            location.reload();
        }
    });
    


}
</script>
<p style="text-align: center; font-size: 30; color: red;">CẬP NHẬT THÔNG TIN HỌC SINH</p>
    <div id="ediths">
        
    </div>
</div>

<!--Danh sách hocsinh-->
<div id="hs-edit">
        <p style="text-align: center; font-size: 30; color: red;">DANH SÁCH HỌC SINH</p>
        <br>
        <script>
            function hienInsert(){
                document.getElementById("themhs").style.display='block';
                document.getElementById("hs-edit").style.display='none';
                document.getElementById("cnhs").style.display='none';
            }

            function deleteHS(row){
                var i=row.parentNode.parentNode.rowIndex;
                 var msxoa=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
                 var result=confirm("Bạn muốn xóa thông tin học sinh này!");
                 if(result){
                    $.ajax({
                        type: 'POST',
                        url: 'xoahs.php',
                        data: {
                            msxoa: msxoa,
                        },
                        success: function(response){
                            alert(response);
                            window.location="dshs.php";
                        }
                    });
                 }
            }

            function openEdit(row){
                document.getElementById("hs-edit").style.display='none';
                document.getElementById("cnhs").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
                $.ajax({
                    type: 'POST',
                    url: 'open-cnhs.php',
                    data: {
                        ms: ms
                    },
                    success: function(response){
                        $('#ediths').html(response);
                    }
                });

            }

            function Huy(){
                location.reload();
            }

            function lietke(){
                var ms=document.getElementById("lh").value;
                $.ajax({
                    type: 'POST',
                    url: 'xoahs.php',
                    data: {
                        ms: ms
                    },
                    success: function(response){
                        $("#list").html(response);
                    }
                });
            }
        </script>
        <table>
            <tr>
                <td><Label style='margin-left: 50px;'><b>Lớp</b></Label></td>
                <td> <select id="lh">
                        <option>Tất cả</option>
                        <?php $q=$conn->query("SELECT*FROM lop");
                        while($rl=$q->fetch_assoc()){
                            echo "<option value='".$rl["MSLOP"]."'>".$rl["TENLOP"]."</option>";
                        }
                    ?>
                    </select></td>
                <td style='width:200px;'> <button style='background-color:#0000ff; color:aliceblue; border-radius: 3px; border:none;' onclick='lietke()'>Liệt kê</button></td>
                <td><select id='tuychon' style='margin-left:550px;'>
                    <option>Xuất ra file Excel</option>
                    <option>Thêm từ Excel</option>
                    <option>Cập nhật từ Excel</option>
                </select></td>
                <td><button style='background-color: blue; color: white; border:none; border-radius:4px;' onclick='openExcel()'>Chọn</button></td>
                <td><button id="btn-insert" onclick="hienInsert()"><i class="bi bi-plus"></i> Thêm</button></td>
            </tr>
        </table>
        
           
            
           
        <div id="list">
            
            <table id="table-hs">
                 <tr style='position:sticky; top:0;' >
                    <td id="colmahs" style="width: 100px; background-color:#0000ff ; 
                                                color:white; height: 50px; "><b>Mã số</b></td>
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
                    
                </tr>
            <?php 
                $q=$conn->query("SELECT * FROM hocsinh, lop WHERE hocsinh.MSLOP=lop.MSLOP");
                while($row=$q->fetch_assoc()){ 
            ?>
              <tr>
                    <td id='colmahs' ><?php echo $row['MAHS'] ; ?></td>
                    <td ><button class='btn-anh' onclick='ImgOPhs(this)'><?php echo $row["HOTENHS"] ; ?></button></td>
                    <td ><?php echo $row["GIOITINH"] ; ?></td>
                    <td id='colmahs' ><?php echo $row['MSLOP']; ?>"</td>
                    <td ><?php echo $row["TENLOP"] ; ?></td>
                    <td ><button class='btn-anh' onclick='ImgOPcha(this)'><?php echo $row["HOTENCHA"]  ?></button></td>
                    <td ><?php echo $row["SDTCHA"] ; ?></td>
                    <td ><button class='btn-anh' onclick='ImgOPme(this)'><?php echo $row["HOTENME"]  ?></button></td>
                    <td ><?php echo $row["SDTME"] ; ?></td>
                    <td ><button id="btn-edit" onclick="openEdit(this)"><i class="bi bi-pencil-square"></i></button>
                                                <button id="btn-delete" onclick="deleteHS(this)"><i class='bi bi-x'></i></button></td>
                </tr>
            <?php }?>
            </table>
        </div>
    </div>
    <div id='open-img'>
        <script>
             function ImgOPhs(row){
                
                document.getElementById("open-img").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
              $.ajax({
                    type: 'POST',
                    url: 'open-cnhs.php',
                    data: {
                        msanh: ms,
                        t: "hs"
                    },
                    success: function(response){
                        $('#im').html(response);
                    }
                });
                
            }
            function ImgOPcha(row){
                
                document.getElementById("open-img").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
              $.ajax({
                    type: 'POST',
                    url: 'open-cnhs.php',
                    data: {
                        msanh: ms,
                        t: "cha"
                    },
                    success: function(response){
                        $('#im').html(response);
                    }
                });
                
            }
            function ImgOPme(row){
                
                document.getElementById("open-img").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
              $.ajax({
                    type: 'POST',
                    url: 'open-cnhs.php',
                    data: {
                        msanh: ms,
                        t: "me"
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
                var malop=document.getElementById("lophoc").value;
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
                form_data.append("malop",malop);
                $.ajax({
                    url: "themhs.php",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(response){
                       location.reload();
                        alert("Đã thêm học sinh!");
                    }
                });

            }
            function openExcel(){
                var i=document.getElementById("tuychon").value;
                if(i=='Thêm từ Excel'){
                    document.getElementById("hs-excel").style.display='block';
                }
                else{
                    if(i=='Cập nhật từ Excel'){
                        document.getElementById("cn-excel").style.display='block';
                    }
                    else{
                        var lop=document.getElementById("lh").value;
                        window.location="xuat-excel.php? mslop="+lop;
                    }
                }
               
            }
        </script>
        <p style="text-align: center; font-size: 30; color: red;">THÊM HỌC SINH</p>
        
        <table id='btn-tb'>
            <tr>
                
                <td><button id="btnthem" onclick="themHS()">Thêm</button></td>";
                <td><button id='btnhuy' onclick='Huy()'>Hủy</button></td>
            </tr>
        </table>
        <br><br>
        <Label style='margin-left: 55px;'><b>Lớp học</b></Label>
        <select id="lophoc">
            <?php $q1=$conn->query("SELECT*FROM lop");
            while($r=$q1->fetch_assoc()){
                echo "<option value='".$r["MSLOP"]."'>".$r["TENLOP"]."</option>";
            }
            ?>
        </select>
        
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
        
    </div>
    <!--Cập nhật từ Excel----------------------------------------------------->
    <div id='cn-excel'>
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
                          //alert(response);
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
               
                <input style='margin-left:20%' type='file' id='cnexcel'>
                <button onclick='cnex()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Cập nhật</button>
                <p style='margin-left: 20%; font-size: 14; color: red'>(*File Excel phải có cấu trúc giống như file mẫu bên dưới.)</p>
           
            <p style='font-size: 18; text-align:center'><b>File Excel mẫu</b></p>
            <p style=' text-align:center'><img src='../css/filehsmau.JPG' style='width: 70%; height:20%; border-style: solid; border-color:red;' ></p>
       
        </div>   
    </div>
    <!--Thêm từ excel------------------------------------------------------------------------------------>
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
           
        </style>
       
        <script>
            function ehs(){
                var file=$("#themexcel").prop("files")[0];
                var mslop=document.getElementById("lh").value;
                var form_data = new FormData();
				form_data.append("filex",file);
                form_data.append("mslop",mslop);
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
            
                <input style='margin-left:30%' type='file' id='themexcel'>
                <button onclick='ehs()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Thêm</button>
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
            #btnfile{
                width: 150px;
                height: 30px; 
                border: none;
                border-radius: 4px;
                background-color:#0000ff;
                color:aliceblue;
            }

			#btnthem{
				width: 80px;
                height: 30px; 
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
				width:1100px;
				height:300px;
				background-color: #b2b2b2;
				overflow-y: scroll;
				margin-left: 50px;
			}

			#table-hs td{
				background-color:#ffffff;
				text-align: center;
				border-style: double;
				height: 40px;
				font-size: 16;
			}

            #table-hs .btn-anh{
                border:none;
                background-color: aliceblue;
                color:#ff0000;
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
				background-color:#CCFFFF ;
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
				height: 30px;
				color:aliceblue;
				background-color: red;
                border: none;
                border-radius: 4px;
			}
            #ediths #btncn{
				width: 100px;
				color:aliceblue;
				background-color: blue;
                border: none;
                border-radius: 4px;
                height: 30px;
			}
             #btn-tb{
                width:200px;
                margin-left: 785px;
            }
			#btn-insert{
				width: 100px;
				height: 25px;
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
</html>