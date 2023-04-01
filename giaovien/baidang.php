<?php
    require_once("../connect.php");
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
           
            #content{
                width:100%;
                background-color: #e5e5e5;
                display: flex;
            }

            #baidang{
               background-color: aliceblue;
                width: 70%;
                height: 600px;
               
                margin-top: 20px;
                
            }
            #theloai{
                height: 30px;
                margin-left: 5px;
            }
            #lietke{
                background-color: blue;
                color:#e5e5e5;
                border-radius: 2px;
               
            }

            #tb-baidang{
                width: 700px;
                height: 200px;
                margin-left: 125px;
                overflow-y: scroll;
            }
            
            #table-baidang td{
                border-style: double;
                border-color: black;
                text-align: center;
            }

           #cot-an{
                display:none;
            }

            #frame{
                background-color:aquamarine;
                
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 4;
                position: fixed;
                background: rgba(0, 0, 0, 0.7);
                display:none;
                overflow-y: scroll;
            }

            #hframe{
                background-color: aliceblue;
                width:900px;
               
                margin-top: 30px;
                margin-left: 300px;
            }

            #btn-xem{
                background-color: #1eb21e;
                color:aliceblue;
            }
            #btn-sua{
                background-color: #0b0bea;
                color:aliceblue;
            }
            #btn-xoa{
                background-color: #d61919;
                color:aliceblue;
            }
            #btn-dong{
                background-color: #d61919;
                color:aliceblue;
                width:50px;
                margin-left: 850px;
            }

            iframe{
                
                margin-left: 50px;
            }
        </style>

        <script>
            function lietke(){
                var select = document.getElementById('theloai');
                var text = select.options[select.selectedIndex].text;
                $.ajax({
                    type: 'POST',
                    url: 'baidang-data.php',
                    data: {
                        theloai: text,
                    },
                    success: function(response){
                        $("#tb-baidang").html(response);
                    }
                });
                
            }
            
            function xem(row){
                document.getElementById("frame").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var tieude=document.getElementById("table-baidang").rows[i].cells[1].innerHTML;
                var link=document.getElementById("table-baidang").rows[i].cells[2].innerHTML;
                var theloai=document.getElementById("table-baidang").rows[i].cells[3].innerHTML;
                $.ajax({
                    type: 'POST',
                    url: 'baidang-data.php',
                    data: {
                        tieude: tieude,
                        link: link,
                        theloaixem: theloai
                    },
                    success: function(response){
                        $("#hframe").append(response);
                    }
                });
                
            }
            function closeXem(){
              location.reload();
              
            }

            function xoa(row){
               var result=confirm("Bạn muốn xóa bài đăng này?");
               if(result){
                    var i=row.parentNode.parentNode.rowIndex;
                    var mabd=document.getElementById("table-baidang").rows[i].cells[0].innerHTML;
                    $.ajax({
                        type: 'POST',
                        url: 'baidang-data.php',
                        data: {
                            mabdxoa: mabd,
                        },
                        success: function(response){
                            location.reload();
                        }
                    });
                }
            }
        </script>
        <?php  require_once("header.php"); ?>
    </head>
    <body>
            <div id='frame'>
                <div id="hframe">
                    <button id='btn-dong' onclick='closeXem()'><i class="bi bi-x"></i></button>

                </div>
            </div>

           
           <div id="content">
                <div id="baidang">
                    <br>
                    <p style="text-align: center; font-size: 20; color: red;">THÔNG BÁO/ TIN TỨC</p>
                    
                    <Label style="margin-left: 125px;"><b>Thể loại</b></Label>
                    <select id="theloai">
                        <option>Tất cả</option>
                        <option>Thông báo</option>
                        <option>Bài viết</option>
                       
                    </select>
                    <button id="lietke" onclick="lietke()">Liệt kê</button><br>
                    <div id="tb-baidang">
                        <table id="table-baidang">
                            <tr style="position:sticky; top:0;">
                                <td id="cot-an">Mã số</td>
                                <td style='width: 400; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
                                <td id="cot-an">Link</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Thể Loại</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Ngày đăng</td>
                                <td style='width: 200; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                            </tr>
                            <?php 
                                $q=$conn->query("SELECT*FROM baidang WHERE MAGV='".$_SESSION["Login"]."'");

                            while($row=$q->fetch_assoc()){
                            ?>
                                <tr>
                                        <td id='cot-an'><?php echo $row["MABD"] ?></td>
                                        <td style='width: 400;'><?php echo $row["TIEUDE"] ?></td>
                                        <td id='cot-an'><?php echo $row["LINK"] ?></td>
                                        <td style='width: 100;'><?php echo $row["THELOAI"] ?></td>
                                        <td style='width: 100;'><?php echo $row["NGAYDANG"] ?></td>
                                        <td ><button id='btn-xem' onclick='xem(this)'><i class="bi bi-eye"></i></button>
                                        <button id='btn-xoa' onclick='xoa(this)'><i class="bi bi-x"></i></button></td>
                                    </tr>
                                
                            <?php  }?>
                        </table>
                    </div>
                    <br>
                    <style>
                        #tb-anh{
                            width:900px;
                            height: 200px;
                            overflow-y: scroll;
                            margin-left: 70px;
                        }
                        #table-anh td{
                            border-style: double;
                            text-align: center;
                            border-color: black;
                        }
                    </style>
                    <script>
                        function lkImg(){
                            var nam=document.getElementById("nam-img").value;
                            $.ajax({
                                type: 'POST',
                                url: 'baidang-data.php',
                                data: {
                                    namimg: nam,
                                },
                                success: function(response){
                                    $("#table-anh").html(response);
                                }
                             });
                        }

                        function SeeImg(row){
                            document.getElementById("frame").style.display='block';
                            var i=row.parentNode.parentNode.rowIndex;
                            var cd=document.getElementById("table-anh").rows[i].cells[0].innerHTML;
                            var n=document.getElementById("table-anh").rows[i].cells[2].innerHTML;
                            $.ajax({
                                type: 'POST',
                                url: 'xembaidang.php',
                                data: {
                                    chude: cd,
                                    thoigian: n  
                                },
                                success: function(response){
                                    $("#hframe").append(response);
                                }
                             });

                        }

                        function DeleteImg(row){

                            var result=confirm("Bạn muốn xóa những ảnh này?");
                            if(result){
                                var i=row.parentNode.parentNode.rowIndex;
                                var cd=document.getElementById("table-anh").rows[i].cells[0].innerHTML;
                                var n=document.getElementById("table-anh").rows[i].cells[2].innerHTML;
                                $.ajax({
                                    type: 'POST',
                                    url: 'baidang-data.php',
                                    data: {
                                        chudexoa: cd,
                                        thoigianxoa: n  
                                    },
                                    success: function(response){
                                    location.reload();
                                    }
                                });
                            }

                        }
                    </script>
                    <p style="text-align: center; font-size: 20; color: red;">HÌNH ẢNH</p>
                    <Label style="margin-left: 70px;"><b>Năm học</b></Label>
                    <select id="nam-img">
                        <option>Tất cả</option>
                        <?php
                            $q=$conn->query("SELECT DISTINCT SUBSTRING(THOIGIAN, 1, 4) FROM anh ");
                            while($rn=$q->fetch_assoc()){
                                echo "<option>".$rn["SUBSTRING(THOIGIAN, 1, 4)"]."</option>";

                            }
                       ?>
                    </select>
                    <button id="lietke" onclick="lkImg()">Liệt kê</button><br>
                    <div id="tb-anh">
                        <table id="table-anh">
                            <tr style="position:sticky; top:0;">
                                <td style='width: 300; background-color: #1386f9; color:aliceblue'>Chủ đề</td>
                                <td style='width: 300; background-color: #1386f9; color:aliceblue'>Địa điểm</td>
                                <td style='width: 100; background-color: #1386f9; color:aliceblue'>Thời gian </td>
                                <td style='width: 200; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                            </tr>
                        <?php
                            $q=$conn->query("SELECT DISTINCT CHUDE,THOIGIAN,DIADIEM FROM `anh` WHERE  MAGV='".$_SESSION["Login"]."'");
                            while($r=$q->fetch_assoc()){
                                echo "<tr>
                                        <td>".$r["CHUDE"]."</td>
                                        <td>".$r["DIADIEM"]."</td>
                                        <td>".$r["THOIGIAN"]."</td>
                                        <td ><button id='btn-xem' onclick='SeeImg(this)'><i class='bi bi-eye'></i></button>
                                        <button id='btn-xoa' onclick='DeleteImg(this)'><i class='bi bi-x'></i></button></td>
                                    </tr>";
                            }
                            ?>
                        </table>
                    </div>

                </div>
                <div id="dang-sua">
                    <div id="dangbai">
                        <br>
                        <p style="text-align: center; font-size: 20; color: red;">ĐĂNG BÀI</p>
                        
                        <Label style="margin-left: 50px;"><b>Thể loại</b></Label>
                        <select id="theloai-dang">
                            <option>Thông báo</option>
                            <option>Bài viết</option>
                        </select>
                        <button id="dang-sua-bai" onclick="dangbai()">Đăng</button><br><br>
                        <Label style="margin-left: 50px;"><b>Tiêu đề</b></Label>
                        <input id='tieudedang' type="text" style="width: 250px;">
                        <br><br>
                        <input id='filedang' type='file' style="margin-left: 50px;">
                        <script>
                            function dangbai(){
                                var tieude=document.getElementById('tieudedang').value;
                                var theloai=document.getElementById('theloai-dang').value;
                                var filedang=$("#filedang").prop("files")[0];
                                var form_data = new FormData();
                                form_data.append("tieudedang",tieude);
                                form_data.append('theloaidang',theloai);
                                form_data.append('filedang',filedang);
                                $.ajax({
                                    url: "baidang-data.php",
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
                    </div>
                    <div id="suabai">
                    <br>
                        <p style="text-align: center; font-size: 20; color: red;">ĐĂNG ẢNH</p>
                        <form method="post" action="baidang-data.php" enctype="multipart/form-data">
                            <Label style="margin-left: 50px;"><b>Thời gian</b></Label>
                            <input name='thoigian' type='text' placeholder='yyyy-mm-dd'>
                            
                            <input type="submit" id="dang-sua-bai" value='Đăng' ><br><br>
                            <Label style="margin-left: 50px;"><b>Địa điểm</b></Label>
                            <input name='diadiem' type="text" style="width: 230px;"><br><br>
                            <Label style="margin-left: 50px;"><b>Chủ đề</b></Label>
                            <input name='chude' type="text" style="width: 250px;">
                            
                            <br><br>
                            <input  multiple="multiple" name="file[]" size="141" type="file" style="margin-left: 50px;">
                        </form>
                    </div>
                </div>
                <style>
                     #theloai-dang{
                        height: 30px;
                        margin-left: 5px;
                    }
                    #dang-sua-bai{
                        background-color: blue;
                        color:#e5e5e5;
                        border-radius: 2px;
                    }

                    #dang-sua{
                        
                        width: 28%;
                        height:600px;
                        margin-left: 1%;
                        margin-top: 20px;
                    }
                    #dangbai{
                        width: 98%;
                        height:290px;
                        margin-right: 2%;
                        background-color: aliceblue;
                    }
                    #suabai{
                        margin-top: 20px;
                        width: 98%;
                        height:290px;
                        margin-right: 2%;
                        background-color: aliceblue;
                    }
                </style>
            </div>
            
       
    </body>
</html>