<?php 
    require_once("../connect.php");
    require_once("../inc/header.php");
?>
<html>
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!--Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <head>
        <style>
            #content{
                width: 100%;
                height: 600px;
                display:flex;
                background: rgba(0, 0, 0, 0.7);
            }

            #dsgv{
                width: 42%;
                height: 560px;
                background-color:azure;
                margin-top: 20px;
                margin-right:1%;
                margin-left: 2%;
            }

            #them{
                width: 80px;
                height: 25px;
                background-color: #0dbc0d;
                color:aliceblue;
                border: none;
                border-radius: 4px;
                
            }

            #cntt{
                width: 52%;
                height:560px;
                background-color:azure;
                margin-top: 20px;
                margin-left: 1%;
                display: none;
            }
            #tb-gv{
                width: 550px;
                height: 400px;
                overflow-y: scroll;
                margin-left: 24px;
            }
            #tb-gv td{
                text-align: center;
                border-style: double;
                border-color: black;
            }
            #btn-cn{
                background-color: blue;
                color:aliceblue;
                border-radius: 2px;
               
            }

            .table-user{
                margin-left: 50px;
            }
            .table-user td{
                height: 50px;
                
            }

            .btncn{
                background-color: #0dbc0d;
                width: 160px;
                height: 40px;
                font-size: 20;
                color:antiquewhite;
                margin-left: 350px;
                border:none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
    <div id="content">
        <div id="dsgv">
            
            <p style="text-align:center; color: red; font-size: 30">DANH SÁCH GIÁO VIÊN</p>
            <table style='margin-left: 300px; margin-top: 30px;'>
                <tr><td><select id='tuychon'>
                    <option>Xuất ra Excel</option>
                    <option>Thêm từ Excel</option>
                    <option>Cập nhật từ Excel</option>
                </select></td>
                    <td><button onclick='openExcel()' style=' border: none; width: 50px; height: 25px; background-color:blue; color: white; border-radius: 4px;'>Chọn</button></td>
                    <td><button id="them" onclick='openThem()'><i class='bi bi-plus'></i>Thêm</button></td>
                </tr>
            </table>
            <div id="tb-gv">
                
                <table id="table-cn">
                    <tr style='position:sticky; top: 0;'>
                        <td style='width: 100px; color: white; background-color:blue;' >Mã số</td>
                        <td style='width: 350px; color: white; background-color:blue;' >Họ tên giáo viên</td>
                        <td style='width: 100px; color: white; background-color:blue;' >Cập nhật</td>
                    </tr>
                <?php 
                    $q=$conn->query("SELECT*FROM gv");
                    while($row=$q->fetch_assoc()){
                        if($row["MSGV"]!='GV0'){
                ?>
                    <tr>
                        <td><?php echo $row["MSGV"] ?></td>
                        <td><?php echo $row["HOTENGV"] ?></td>
                        <td><button id='btn-cn' onclick='capnhat(this)'><i class="bi bi-pencil-square"></button></td>
                    </tr>
                <?php } 
                        }?>
                </table>
            </div>
        </div>
        <div id="cntt">
        <br><br>
			
				<script type="text/javascript">

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
                                window.location='thu.php';
                            }
                        }
                       
                    }
                    function openThem(){
                        document.getElementById("themgv").style.display='block';
                        document.getElementById("cntt").style.display='none';
                    }
                    function capnhat(row){
                        document.getElementById("themgv").style.display='none';
                        document.getElementById("cntt").style.display='block';
                        var i=row.parentNode.parentNode.rowIndex;
                        var id=document.getElementById("table-cn").rows[i].cells[0].innerHTML;
                        $.ajax({
							type: 'POST',
							url: 'cngv-data.php',
							data: {
								idgv: id
							},
							success: function(response){
								$("#cntt").html(response);
							}
						});
                    }
					function editGV(){
                        var msgv=document.getElementById("msgv").value;
                        var tendn=document.getElementById("tendn").value;
						var hotengv=document.getElementById("hotengv").value;
						var gioitinh=document.getElementById("gioitinh").value;
						var ngaysinh=document.getElementById("ngaysinh").value;
						var diachi=document.getElementById("diachi").value;
						var cmnd=document.getElementById("cmnd/cccd").value;
						var sdt=document.getElementById("sdt").value;
						var ngayvaolam=document.getElementById("ngayvaolam").value;
						var trinhdo=document.getElementById("trinhdo").value;
                        var file=$("#anhgv").prop("files")[0];
                        var form_data = new FormData();
                        form_data.append("msgv",msgv);
                        form_data.append("tendn",tendn);
                        form_data.append("hotengv",hotengv);
                        form_data.append("gioitinh",gioitinh);
                        form_data.append("ngaysinh",ngaysinh);
                        form_data.append("diachi",diachi);
                        form_data.append("cmnd",cmnd);
                        form_data.append("sdt",sdt);
                        form_data.append("ngayvaolam",ngayvaolam);
                        form_data.append("trinhdo",trinhdo);
                        form_data.append("file",file);
                
                        
						$.ajax({
							
							url: 'cngv-data.php',
							dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
							success: function(response){
								alert("Cập nhật thành công");
								window.location.reload();
                               
							}
						});
                        
					}
				</script>
		
        </div>
        <!--Thêm giáo viên-->
        <style>
            #themgv{
                width: 52%;
                height:560px;
                background-color:azure;
                margin-top: 20px;
                margin-left: 1%;
            }
        </style>
        <div id="themgv">
            <br><br>
             <p style='text-align: center;'>ẢNH GIÁO VIÊN<br><input type='file' id='anhgvnew' ><br></p>
            <table class='table-user'>   
                <tr>
                    <td style='width: 150px;'><b>Mã số giáo viên: </b></td>
                    <td style='width: 250px;'><input id='msgvnew' type='text' ></td>
                    <td style='width: 150px;'><b>Tên đăng nhập: </b></td>
                    <td style='width: 250px;'><input id='tendnnew' type='text' ></td>
                </tr> 
                <tr>
                    <td style='width: 150px;'><b>Họ và tên: </b></td>
                    <td style='width: 250px;'><input id='hotengvnew' type='text' ></td>
                    <td style='width: 150px;'><b>Giới tính: </b></td>
                    <td style='width: 250px;'><input id='gioitinhnew' type='text' ></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>Ngày sinh: </b></td>
                    <td style='width: 250px;'><input id='ngaysinhnew' type='text' placeholder='yyyy-mm-dd'></td>

                    <td style='width: 150px;'><b>Địa chỉ: </b></td>
                    <td style='width: 250px;'><input id='diachinew' type='text'></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>CMND/CCCD: </b></td>
                    <td style='width: 250px;'><input id='cmnd/cccdnew' type='text'></td>
                    <td style='width: 150px;'><b>Số điện thoại: </b></td>
                    <td style='width: 250px;'><input id='sdtnew' type='text' ></td>
                </tr>
                <tr>
                    <td style='width: 150px;'><b>Ngày vào làm: </b></td>
                    <td style='width: 250px;'><input id='ngayvaolamnew' type='text' placeholder='yyyy-mm-dd'></td>
                    <td style='width: 150px;'><b>Trình độ: </b></td>
                    <td style='width: 250px;'><input id='trinhdonew' type='text' ></td>
                </tr>
                <tr>
                <td style='width: 150px;'><b>Năng khiếu: </b></td>
                    <td style='width: 250px;'><input id='nangkhieunew' type='text' ></td>
            
                </tr>
                
            </table>
           <br>
            <button class='btncn' onclick='themGV()'>Lưu</button>
            <script>
                function themGV(){
                    var msgvnew=document.getElementById("msgvnew").value;
                    var tendnnew=document.getElementById("tendnnew").value;
                    var hotengvnew=document.getElementById("hotengvnew").value;
                    var gioitinhnew=document.getElementById("gioitinhnew").value;
                    var ngaysinhnew=document.getElementById("ngaysinhnew").value;
                    var diachinew=document.getElementById("diachinew").value;
                    var cmndnew=document.getElementById("cmnd/cccdnew").value;
                    var sdtnew=document.getElementById("sdtnew").value;
                    var ngayvaolamnew=document.getElementById("ngayvaolamnew").value;
                    var trinhdonew=document.getElementById("trinhdonew").value;
                    var file=$("#anhgvnew").prop("files")[0];
                    var form_data = new FormData();
                    form_data.append("msgvnew",msgvnew);
                    form_data.append("tendnnew",tendnnew);
                    form_data.append("hotengvnew",hotengvnew);
                    form_data.append("gioitinhnew",gioitinhnew);
                    form_data.append("ngaysinhnew",ngaysinhnew);
                    form_data.append("diachinew",diachinew);
                    form_data.append("cmndnew",cmndnew);
                    form_data.append("sdtnew",sdtnew);
                    form_data.append("ngayvaolamnew",ngayvaolamnew);
                    form_data.append("trinhdonew",trinhdonew);
                    form_data.append("filenew",file);
                    $.ajax({
                        url: 'cngv-data.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            
                           window.location.reload();
                           
                        }
                    });
                    
                }
            </script>
        </div>
    </div>
     <!--Cập nhật từ Excel-->
     <div id='cn-excel'>
            <style>
                #cn-excel{
                    top: 0;
                    bottom:0;
                    left:0;
                    right:0;
                    background-color: rgba(0, 0, 0, 0.7);
                    z-index: 4;
                    position: fixed;
                    display:none;
                }
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
                            url: 'cngv-data.php',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                            window.location='cngv.php';
                            }
                        });
                }

                function clcn(){
                    document.getElementById("cn-excel").style.display='none';
                }
                </script>
            <div id='xemimg'>
                <button class='bt-x' onclick='clcn()'><i class='bi bi-x'></i></button>
                <p style='color:red; font-size: 30; text-align:center; margin-top: 30px;'>CẬP NHẬT GIÁO VIÊN TỪ EXCEL</p>
                <br>
                    
                    <input type='file' id='cnexcel' style='margin-left:20%'>
                    <button onclick='cnex()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Cập nhật</button>
                    <p style='margin-left: 20%; font-size: 14; color: red'>(*File Excel phải có cấu trúc giống như file mẫu bên dưới.)</p>
            
                <p style='font-size: 18; text-align:center'><b>File Excel mẫu</b></p>
                <p style=' text-align:center'><img src='../css/filegvmau.jpg' style='width: 70%; height:20%; border-style: solid; border-color:red;' ></p>
        
            </div> 
        </div>  
    <!--Thêm từ excel-->
    <div id='hs-excel'>
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
            function ehs(){
                var file=$("#themexcel").prop("files")[0];
                var form_data = new FormData();
				form_data.append("filex",file);

				$.ajax({
                        url: 'cngv-data.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                           window.location='cngv.php';
                        }
                    });
            }

            function clhs(){
                document.getElementById("hs-excel").style.display='none';
            }
        </script>
        <div id='xemimg'>
            <button class='bt-x' onclick='clhs()'><i class='bi bi-x'></i></button>
            <p style='color:red; font-size: 30; text-align:center; margin-top: 30px;'>THÊM GIÁO VIÊN TỪ EXCEL</p>
            <br>
                
                <input type='file' id='themexcel' style='margin-left:20%'>
                <button onclick='ehs()' type='submit' name='submit' style='background-color:blue; color:#ffffff; border-radius: 5px'>Thêm</button>
                <p style='margin-left: 20%; font-size: 14; color: red'>(*File Excel phải có cấu trúc giống như file mẫu bên dưới.)</p>
           
            <p style='font-size: 18; text-align:center'><b>File Excel mẫu</b></p>
            <p style=' text-align:center'><img src='../css/filegvmau.jpg' style='width: 70%; height:20%; border-style: solid; border-color:red;' ></p>
       
        </div> 

       
            

    </div>
 
           
    </body>
</html>