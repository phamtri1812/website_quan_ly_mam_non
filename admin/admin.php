<?php
    require_once("../connect.php");
    require_once("../inc/header.php");
    session_start();
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
        <style>
            body{
                background: rgba(0, 0, 0, 0.7);
            }
            #content{
                width: 1000px;
                height: 700px;
                background-color: aliceblue;
                margin-top: 20px;
                margin-left: 250px;
                
            }
            #chucnang{
                margin-left: 200px;
                
            }
            #chucnang td{
                width:200px;
                height: 200px;
                text-align: center;
            }
            #chucnang img{
                width:140px;
                height:140px;
                border-radius: 50%;
                
            }
            button{
                border:none;
                background-color: aliceblue;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <br>
            
            
            <table id="chucnang">
                <tr>
                    <td><a href='cngv.php' style="text-decoration: none; color:black;"><button><img src='../anhchucnang/cngv.jpg'></button><br>Cập nhật giáo viên</a></td>
                    <td><button onclick='editMK()'><img src='../anhchucnang/mk.jpg'></button><br>Đổi mật khẩu</td>
                    <td><button><a href='dshs.php' style="text-decoration: none; color:black;"><img src='../anhchucnang/cnhs.jpg'></a></button><br>Cập nhật học sinh</td>
                </tr> 
                <tr>
                    <td><a href='thucdon.php' style="text-decoration: none; color:black;"><button><img src='../anhchucnang/thucdon.jpg'><br>Thực đơn</button></a></td>
                    <td><button><a href='pcdg.php' style="text-decoration: none; color:black;"><img src='../anhchucnang/pcgd.jpg' ></a></button><br>Phân công giảng dạy</td>
                    <td><button><a href='cnlop.php' style="text-decoration: none; color:black;"><img src='../anhchucnang/lophoc.png' ></a></button><br>Cập nhật lớp học</td>
                </tr> 
                <tr> 
                    <td><button><a href='chuongtrinhhoc.php' style="text-decoration: none; color:black;"><img src='../anhchucnang/chuongtrinhhoc.png'><br>Chương trình học</a></button></td>
                    <td><a href='baidang.php' style="text-decoration: none; color:black;"><button ><img src='../anhchucnang/upload.png'></button ><br>Đăng/xóa tập tin</a></td>
                    <td><button onclick='logout()'><img src='../anhchucnang/logout.jpg'></button ><br>Đăng xuất</td>
                </tr>
            </table>
            <script>
                function logout(){
                    var result = confirm("Bạn muốn đăng xuất?");
                    if(result) {
                        window.location="../inc/home.php";
                    }
                }

                function editMK(){
                    document.getElementById("doimk").style.display='flex';
                }
            </script>
			
        </div>
        <div id="doimk">
            <style>
                #doimk{
                    background: rgba(0, 0, 0, 0.7);
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 4;
                    position: fixed;
                    
                    display: none;
                }

                #edit-mk{
                    width: 1000px;
                    height: 500px;
                    background-color: aliceblue;
                    margin-top: 100px;
                    margin-left: 250px;
                    
                    }
                #close-edit{
                    width: 80px;
                    height: 30px;
                    background-color: red;
                    margin-left: 920px;
                    color:azure;
                    font-size: 30;
                }

                #edit-pass{
                    margin-left: 250px;
                }

                #edit-pass td{
                    font-size: 20;
                }

                #btn-edit{
                    width: 150px;
                    font-size: 20px;
                    color:azure;
                    background-color: blue;
                    border:none;
                    margin-left: 425px;
                    border-radius: 5px;
                }
            </style>
            <div id="edit-mk">
                <button id="close-edit" onclick='closeEditMK()'><i class="bi bi-x"></i></button>
                <br><br>
			<p style="text-align: center; font-size: 30; color: red;">THAY ĐỔI MẬT KHẨU</p>
			<br><br><br>
			
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
			
			<br>
			<button id="btn-edit" onclick="editMatKhau()">Thay đổi</button>
			<script type="text/javascript">
                function closeEditMK(){
                    document.getElementById("doimk").style.display='none';
                }
				function editMatKhau(){
				var mkcu=document.getElementById("mkcu").value;
				var mkmoi=document.getElementById("mkmoi").value;
				$.ajax({
					type: 'POST',
					url: '../giaovien/doimk.php',
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
        </div>
    </body>
</html>