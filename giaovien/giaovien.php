<?php require_once("../connect.php");
	session_start();
	if(!isset($_SESSION['Login'])){
		header('Location:home.php');
    }
	$id= $_SESSION['Login'];

  
	#echo $id;
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
		<title>GIÁO VIÊN</title>
		
		<script src='../js/giaovien.js'></script>
		<script>
			function hiendoimk(){
				document.getElementById("gv").style.display='none';
				document.getElementById("cngv").style.display='none';
				document.getElementById("doimk").style.display='block';
				
			}

			function hiencngv(){
				document.getElementById("gv").style.display='none';
				document.getElementById("cngv").style.display='block';
				document.getElementById("doimk").style.display='none';
			}
		</script>
	</head>
	<body>
		<div id="content">
			<style>
				body{
					background-color: #e5e5e5;

				}
				#content{
					
					width: 1500px;
					height:500px;
					display: flex;
				}
			</style>
		<!--Lịch sử giảng dạy-->
		<div id="ls">
			<style>
				#ls{
					background-color: #ffffff;
					width: 300px;
					height: 300px;
					margin-top: 30px;
					margin-left: 20px;
					border-style: solid;
					border-radius: 10px;
					border-color: blue;
					overflow-x: hidden;
				}
				#lsgd{
					background: rgba(0, 0, 0, 0.7);
					
					margin-left: 25px;
					width: 250px;
					height: 200px;
					overflow-y: scroll;

				}

				#tb-pcgd td{
					border-style: double;
					border-color: black;
					text-align: center;
					background-color: #ffffff;
					
				}
			</style>
		
			<p style="text-align: center; font-size: 20; color: white; width: 300px; padding: 10px; background-color: blue">LỊCH SỬ GIẢNG DẠY</p>
			<div id='lsgd'>
				<table id="tb-pcgd">
					<tr>
						<td style='width:100px; background-color:blue; color: white;'>Lớp học</td>
						<td style='width:150px; background-color:blue; color: white;'>Năm học</td>
					</tr>
				<?php
				 	$q=$conn->query("SELECT TENLOP, NAMHOC FROM `phanconggd`,lop WHERE MAGV='".$id."' AND phanconggd.MSLOP=lop.MSLOP");
					while($r=$q->fetch_assoc()){
						echo "<tr>
								<td>".$r["TENLOP"]."</td>
								<td>".$r["NAMHOC"]."</td>
							</tr>";
					}
				?>
				</table>
			</div>
			
		</div>
		<!--cập nhật ảnh gv-->
		<style>
			#cn-anh{
				background: rgba(0, 0, 0, 0.7);
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				z-index: 4;
				position: fixed;
				display:none;
			}

			#img-sl{
				width: 400px;
				height: 200px;
				margin-left: 560px;
				margin-top: 250px;
				background-color:#ffffff;
				overflow-x: hidden;
			}
		</style>
		<script>
			function closeCNIMG(){
				document.getElementById("cn-anh").style.display='none';
			}

			function openCNIMG(){
				document.getElementById("cn-anh").style.display='block';
			}
			function Huy(){
				location.reload();
			}
			function LuuImg(){
				var file=$("#file-img").prop("files")[0];
                var form_data = new FormData();
				form_data.append("filegv",file);
				$.ajax({
                        url: 'cngv.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                          location.reload();
                        }
                    });
			}
		</script>
		<div id='cn-anh'>
			<div id='img-sl'>
				<div style='background-color:dodgerblue;'>
				<table>
					<tr>
						<td style='text-align:center; color:white; width: 370px; font-size: 18'>CẬP NHẬT HÌNH ẢNH </td>
						<td style='text-align:center; width: 30px;'><button onclick='closeCNIMG()' style='width: 100%; height: 30px; background-color:red; color: white; border:none; '><i class='bi bi-x'></i></button></td>
					</tr>
				</table>
				</div>
				<br><br>
				<input type="file" id='file-img' style='margin-left: 30px;'>
				<br><br>
				<table style='width:150px; margin-left: 125px;'>
					<tr style='text-align:center'>
						<td><button onclick='LuuImg()' style='background-color: blue; color:#ffffff; width: 80px;  border-radius: 3px;'>Lưu</button></td>
						<td><button onclick='Huy()' style='background-color: red; color:#ffffff;  width: 80px;  border-radius: 3px;'>Hủy</button></td>
					</tr>
				</table>
			</div>
		</div>
		<!--Chức năng-->
		<div id="chucnang">
			<style>
				#chucnang{
					background-color: #ffffff;
					width: 300px;
					height: 500px;
					margin-top: 30px;
					margin-left: 20px;
					align-items: center;
					
				}
				#chucnang #img-user{
					width: 300px; 
					height: 300px;
					background-color: rgb(0, 132, 255);
				}

				#chucnang .imggv{
					width: 200px; 
					height: 200px; 
					border-radius:50%;
					-moz-border-radius:50%;
					-webkit-border-radius:50%;
					margin-top: 50px;
					margin-left: 50px;
				}
				#chucnang  li{
					list-style-type: none;
					width: 300px;
					text-align: left;
					border-top: solid;
					border-top-color: #ececec;
					padding-left: 30px;
					font-size: 16px;
					cursor: pointer;
					height: 33px;
				}

				#chucnang li:hover{
					color:aqua;
				}

			</style>
			<?php 
				$q1=$conn->query("SELECT*FROM GV WHERE MSGV='".$id."'");
				while($r=$q1->fetch_assoc()){
			?>
			<div id="img-user"><img class="imggv" src="<?php echo $r["ANHGV"] ?>" ><br>
								<button style='background-color:black; color:white; margin-left: 220px; width: 60px; height: 40px; border-radius: 5px;' onclick='openCNIMG()'>
								 <i class="bi bi-card-image" style='font-size: 30'></i></button></div>
			
			<?php } ?>
			
				<li onclick="hiendoimk()"><i class="bi bi-lock"></i></i>Đổi mật khẩu</li>
				<li onclick="hiengv()"><i class="bi bi-info-square"></i>Hồ sơ giáo viên</li>
				<li onclick="hiencngv()"><i class="bi bi-pencil-square"></i>Cập nhật thông tin cá nhân</li>
				<li onclick="location.href='dshs.php';"><i class="bi bi-pencil-square"></i>Cập nhật thông tin học sinh</li>
				<li onclick="location.href='baidang.php';"><i class="bi bi-upload"></i>Đăng/xóa tin tức, hình ảnh</li>
				<li onclick="logout()"><i class="bi bi-power"></i>Đăng xuất</li>
			
			<form name="formlogout" method="POST" action="../logout.php">
				<input type="hidden" value="YES" name="logout">
			</form>

		</div>
		

		<!--Thông tin giáo viên-->
		<div id='gv'>
			<style>
				#gv{
					background-color: #ffffff;
					width: 800px;
					height: 500px;
					margin-top: 30px;
					margin-left: 20px;
			
				}

				
				.table-user{
					margin-left: 50px;
					font-size: 16;

				}

				.table-user tr{
					height:  60px;
				}

	</style>
			<br><br>
			<p style="text-align: center; font-size: 20; color: red;">THÔNG TIN GIÁO VIÊN</p>
			<?php 
				$q1=$conn->query("SELECT*FROM GV WHERE MSGV='".$id."'");
				while($row=$q1->fetch_assoc()){
			?>
			<table class="table-user">    
				<tr>
					<td style="width: 150px;"><b>Họ và tên: </b></td>
					<td style="width: 200px;"><?php echo $row["HOTENGV"];?></td>
					<td style="width: 150px;"><b>Giới tính: </b></td>
					<td style="width: 200px;"><?php echo $row["GIOITINH"];?></td>
				</tr>
				<tr>
					<td style="width: 150px;"><b>Ngày sinh: </b></td>
					<td style="width: 200px;"><?php 
								$a=date_create($row["NGAYSINH"]);
								date_format($a,'Y-m-d');
								echo $a->format("d-m-Y"); 
								?> 
					</td>

					<td style="width: 150px;"><b>Địa chỉ: </b></td>
					<td style="width: 200px;"><?php echo $row["DIACHI"];?></td>
				</tr>
				<tr>
					<td style="width: 150px;"><b>CMND/CCCD: </b></td>
					<td style="width: 200px;"><?php echo $row["CMNDCCCD"];?></td>
					<td style="width: 150px;"><b>Số điện thoại: </b></td>
					<td style="width: 200px;"><?php echo $row["SDT"];?></td>
				</tr>
				<tr>
					<td style="width: 150px;"><b>Ngày vào làm: </b></td>
					<td style="width: 200px;"><?php 
					$a=date_create($row["NGAYVAOLAM"]);
					date_format($a,'Y-m-d');
					echo $a->format("d-m-Y"); 
					?></td>
					<td style="width: 150px;"><b>Trình độ: </b></td>
					<td style="width: 200px;"><?php echo $row["TRINHDO"];?></td>
				</tr>
				<tr>
					<td style="width: 150px;"><b>Năng khiếu: </b></td>
					<td style="width: 200px;"><?php echo $row["NANGKHIEU"];?></td>
				</tr>
				
			</table>
			<?php } ?>
		</div>

		<!--Đổi mật khẩu-->
		<div id="doimk">
			<style>
				#doimk{
					background-color: #ffffff;
					width: 800px;
					height: 500px;
					margin-top: 30px;
					margin-left: 20px;
					display: none;
				}

				#doimk #edit-pass{
					margin-left: 150px;
					font-size: 18;
				}

				#doimk button{
					background-color: #00bf00;
					color:#ffffff;
					border:none;
					width:150px;
					height:40px;
					margin-top: 40px;
					font-size: 20;
					margin-left: 325px;
					border-radius: 50px;
				}
			</style>
		<br><br>
			<p style="text-align: center; font-size: 20; color: red;">THAY ĐỔI MẬT KHẨU</p>
			<br><br><br>
			<form method="POST" name="formdoimk">
			<table id="edit-pass">
				<tr>
					<td style="width: 200px; height: 60px;">Mật khẩu cũ</td>
					<td style="width: 300px; height: 60px;"><input id="mkcu" type="password"></td>
				</tr>
				<tr>
					<td style="width: 200px; height: 60px;">Mật khẩu mới</td>
					<td style="width: 300px; height: 60px;"><input id="mkmoi" type="password"></td>
				</tr>
			</table>
			
			</form>
			<button onclick="editMatKhau()">Thay đổi</button>
			<script type="text/javascript">
				function editMatKhau(){
				var mkcu=document.getElementById("mkcu").value;
				var mkmoi=document.getElementById("mkmoi").value;
				$.ajax({
					type: 'POST',
					url: 'doimk.php',
					data: {
						mkcu: mkcu,
						mkmoi: mkmoi
					},
					success: function(response){
					if(response=="yes"){
						alert("Đổi mật khẩu thành công!");
				
					}
					else{
						alert("Mật khẩu không chính xác!");
					}
					document.getElementById("mkcu").value='';
					document.getElementById("mkmoi").value='';
					}
				});
			}
			</script> 
		</div>

		<!--Cập nhật giáo viên-->
		<div id="cngv">
			<style>
				#cngv{
					background-color: #ffffff;
					width: 800px;
					height: 500px;
					margin-top: 30px;
					margin-left: 20px;
					display: none;
				}

				#cngv button{
					background-color: #00bf00;
					color:#ffffff;
					border:none;
					width:150px;
					height:40px;
					margin-top: 40px;
					font-size: 20;
					margin-left: 325px;
					border-radius: 50px;
				}
		
			</style>
			<br>
		<p style="text-align: center; font-size: 20; color: red;">CẬP NHẬT THÔNG TIN GIÁO VIÊN</p>
		<br>
			<?php
			$q1=$conn->query("SELECT*FROM GV WHERE MSGV='".$id."'");
			 while($row=$q1->fetch_assoc()){
			?>
			<from method="POST" name="fromcngv">
				<table class="table-user">    
					<tr>
						<td style="width: 150px;"><b>Họ và tên: </b></td>
						<td style="width: 200px;"><input id="hotengv" type="text" value="<?php echo $row["HOTENGV"];?>"></td>
						<td style="width: 150px;"><b>Giới tính: </b></td>
						<td style="width: 200px;"><input id="gioitinh" type="text" value="<?php echo $row["GIOITINH"];?>"></td>
					</tr>
					<tr>
						<td style="width: 150px;"><b>Ngày sinh: </b></td>
						<td style="width: 200px;"><input id="ngaysinh" type="text" value="<?php 
									$a=date_create($row["NGAYSINH"]);
									date_format($a,'Y-m-d');
									echo $a->format("d-m-Y"); 
									?> ">
						</td>

						<td style="width: 150px;"><b>Địa chỉ: </b></td>
						<td style="width: 200px;"><input id="diachi" type="text" value="<?php echo $row["DIACHI"];?>"></td>
					</tr>
					<tr>
						<td style="width: 150px;"><b>CMND/CCCD: </b></td>
						<td style="width: 200px;"><input id="cmnd/cccd" type="text" value="<?php echo $row["CMNDCCCD"];?>"></td>
						<td style="width: 150px;"><b>Số điện thoại: </b></td>
						<td style="width: 200px;"><input id="sdt" type="text" value="<?php echo $row["SDT"];?>"></td>
					</tr>
					<tr>
						<td style="width: 150px;"><b>Ngày vào làm: </b></td>
						<td style="width: 200px;"><input id="ngayvaolam" type="text" value="<?php 
						$a=date_create($row["NGAYVAOLAM"]);
						date_format($a,'Y-m-d');
						echo $a->format("d-m-Y"); 
						?>"></td>
						<td style="width: 150px;"><b>Trình độ: </b></td>
						<td style="width: 200px;"><input id="trinhdo" type="text" value="<?php echo $row["TRINHDO"];?>"></td>
					</tr>
					<tr>
					<td style="width: 150px;"><b>Năng khiếu: </b></td>
					<td style="width: 200px;"><input id="nangkhieu" type="text" value="<?php echo $row["NANGKHIEU"];?>"></td>
					</tr>
					
				</table>
				<?php } ?>
				<button onclick="editGV()">Cập nhật</button>
				</from>

				<script type="text/javascript">
					function editGV(){
						var hotengv=document.getElementById("hotengv").value;
						var gioitinh=document.getElementById("gioitinh").value;
						var ngaysinh=document.getElementById("ngaysinh").value;
						var diachi=document.getElementById("diachi").value;
						var cmnd=document.getElementById("cmnd/cccd").value;
						var sdt=document.getElementById("sdt").value;
						var ngayvaolam=document.getElementById("ngayvaolam").value;
						var trinhdo=document.getElementById("trinhdo").value;
						var nangkhieu=document.getElementById("nangkhieu").value;
						$.ajax({
							type: 'POST',
							url: 'cngv.php',
							data: {
								hotengv: hotengv,
								gioitinh: gioitinh,
								ngaysinh: ngaysinh,
								diachi: diachi,
								cmnd: cmnd,
								sdt: sdt,
								ngayvaolam: ngayvaolam,
								trinhdo: trinhdo,
								nangkhieu: nangkhieu
							},
							success: function(response){
								alert("Cập nhật thành công!");
								window.location.reload();
							}
						});
					}
				</script>
		</div>

		

		</div>

		
		
	</body>
</html>