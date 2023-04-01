<?php
    require_once("../connect.php");
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

            #thucdon{
                background-color: aliceblue;
                width: 62%;
                height: 600px;
                margin-left: 1%;
                margin-top: 20px;
                
            }
            #thang{
                height: 30px;
                margin-left: 5px;
            }
            #nam{
                width: 120px;
                height: 30px;
                margin-left: 5px;
            }
            #lietke{
                background-color: blue;
                color:#e5e5e5;
                border-radius: 2px;
               
            }

            #tb-baidang{
                width: 800px;
                height: 400px;
                margin-left: 75px;
                overflow-y: scroll;
            }
            
            #table-thucdon td{
                border-style: double;
                border-color: black;
                text-align: center;
            }

            #table-thucdon #cot-an{
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
                height: 700px;
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
            function xoa(row){
                var i=row.parentNode.parentNode.rowIndex;
                var matd=document.getElementById("table-thucdon").rows[i].cells[0].innerHTML;
                var result=confirm("Bạn xóa thực đơn này?");
                 if(result) {
                    $.ajax({
                        type: 'POST',
                        url: 'thucdon-data.php',
                        data: {
                            matdxoa: matd,
                        },
                        success: function(response){
                            location.reload();
                        }
                    });
                 }
            }
            function xem(row){
                document.getElementById("frame").style.display='flex';
                var i=row.parentNode.parentNode.rowIndex;
                var matd=document.getElementById("table-thucdon").rows[i].cells[0].innerHTML;
                var tieude=document.getElementById("table-thucdon").rows[i].cells[1].innerHTML;
                var link=document.getElementById("table-thucdon").rows[i].cells[2].innerHTML;
                
              $.ajax({
							type: 'POST',
							url: 'thucdon-data.php',
							data: {
								matd: matd,
                                tieude: tieude,
                                link: link
                                
							},
							success: function(response){
                               $("#hframe").append(response);
                               
							}
						});
                
            }

            function lietke(){
                var selectthang = document.getElementById('thang');
                var textthang = selectthang.options[selectthang.selectedIndex].text;
                var selectnam = document.getElementById('nam');
                var textnam = selectnam.options[selectnam.selectedIndex].text;
                $.ajax({
                    type: 'POST',
                    url: 'thucdon-data.php',
                    data: {
                        thang: textthang,
                        nam: textnam
                        
                    },
                    success: function(response){
                       $("#tb-baidang").html(response);
                       
                    }
				});
            }

            function closeXem(){
                location.reload();
            }

            function suabai(row){
                var i=row.parentNode.parentNode.rowIndex;
                var tieude=document.getElementById("table-thucdon").rows[i].cells[1].innerHTML;
                var matd=document.getElementById("table-thucdon").rows[i].cells[0].innerHTML;
                var nam=document.getElementById("table-thucdon").rows[i].cells[3].innerHTML;
                document.getElementById("nam-cn").value=nam;
                document.getElementById('tieudecn').value=tieude;
                document.getElementById('matdcn').value=matd;
            }
        </script>
        
    </head>
    <body>
            <div id='frame'>
                <div id="hframe">
                    <button id='btn-dong' onclick='closeXem()'><i class="bi bi-x"></i></button>
                    
                </div>

            </div>
           <?php  require_once("../inc/header.php"); ?>
           <div id="content">
                <div id="thucdon">
                    <br><br>
                    <p style="text-align: center; font-size: 20; color: red;">THỰC ĐƠN</p>
                    
                    <Label style="margin-left: 125px;"><b>Tháng</b></Label>
                    <select id="thang">
                        <option>Tất cả</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option> 
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <Label style="margin-left: 10px;"><b>Năm</b></Label>
                    <select id="nam">
                        <option>Tất cả</option>
                    <?php $q=$conn->query("SELECT DISTINCT NAM FROM thucdon");
                         while($row=$q->fetch_assoc()){
                            echo "<option>".$row["NAM"]."</option>";
                         }
                    ?>
                    </select>
                    <button id="lietke" onclick="lietke()">Liệt kê</button><br>
                    <div id="tb-baidang">
                        <table id="table-thucdon">
                            <tr style="position:sticky; top: 0;">
                                <td id='cot-an'>Mã số</td>
                                <td style='width: 470; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
                                <td id='cot-an'>Link</td>
                                <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm</td>
                                <td style='width: 150; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                                
                            </tr>
                            <?php 
                                $q=$conn->query("SELECT*FROM thucdon");

                            while($row=$q->fetch_assoc()){
                            ?>
                                <tr>
                                        <td id='cot-an'><?php echo $row["MATD"] ?></td>
                                        <td style='width: 470;'><?php echo $row["TIEUDE"] ?></td>
                                        <td id='cot-an'><?php echo $row["LINK"] ?></td>
                                        <td style='width: 180;'><?php echo $row["NAM"]; ?></td>
                                        <td ><button id='btn-xem' onclick='xem(this)'><i class="bi bi-eye"></i></button>
                                            <button id='btn-sua' onclick=suabai(this)><i class="bi bi-pen"></i></button>
                                            <button id='btn-xoa' onclick='xoa(this)'><i class="bi bi-x"></i></button></td>
                                    </tr>
                                
                            <?php  }?>
                        </table>
                    </div>
                </div>
            <!--Đangư thực đơn-->
                <div id="dang-sua">
                    <div id="dangbai">
                        <br>
                        <p style="text-align: center; font-size: 20; color: red;">THÊM THỰC ĐƠN</p>
                        
                        <Label style="margin-left: 50px;"><b>Tháng</b></Label>
                        <select id="thang-dang">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option> 
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <Label style="margin-left: 10px;"><b>Năm học</b></Label>
                        <input type="text" id="nam-dang" placeholder="VD: 2022-2023">
                        <button id="dang-sua-bai" onclick="themTD()">Đăng</button><br><br>
                        <Label style="margin-left: 50px;"><b>Tiêu đề</b></Label>
                        <input id='tieudedang' type="text" style="width: 350px;">
                        <br><br>
                        <input id='filedang' type='file' style="margin-left: 50px;">
                        <script>
                            function themTD(){
                                var tieude=document.getElementById('tieudedang').value;
                                var thang=document.getElementById('thang-dang').value;
                                var nam=document.getElementById("nam-dang").value;
                                var filedang=$("#filedang").prop("files")[0];
                                var form_data = new FormData();
                                form_data.append("tieudedang",tieude);
                                form_data.append('thangdang',thang);
                                form_data.append('filedang',filedang);
                                form_data.append('namdang',nam);
                                $.ajax({
                                    url: "thucdon-data.php",
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

                    <!--Cập nhật thực đơn-->
                    <div id="suabai">
                    <br>
                        <p style="text-align: center; font-size: 20; color: red;">CẬP NHẬT THỰC ĐƠN</p>
                        
                        <Label style="margin-left: 50px;"><b>Tháng</b></Label>
                        <select id="thang-cn">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option> 
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <Label style="margin-left: 5px;"><b>Năm học</b></Label>
                        <input type="text" id="nam-cn" placeholder="VD: 2022-2023">
                        <button id="dang-sua-bai" onclick="capnhat()">Cập nhật</button><br><br>
                        <Label style="margin-left: 50px;"><b>Tiêu đề</b></Label>
                        <input id='tieudecn' type="text" style="width: 350px;">
                        <input id='matdcn' type='hidden'>
                        <br><br>
                        <input id='filecn' type='file' style="margin-left: 50px;">
                        <script>
                            function capnhat(){
                                var thang=document.getElementById("thang-cn").value;
                                var nam=document.getElementById("nam-cn").value;
                                var tieude=document.getElementById("tieudecn").value;
                                var matd=document.getElementById("matdcn").value;
                                var file=$("#filecn").prop("files")[0];
                                var form_data=new FormData();
                                form_data.append("thangcn",thang);
                                form_data.append("namcn",nam);
                                form_data.append("tieudecn",tieude);
                                form_data.append("matdcn",matd);
                                form_data.append("filecn",file);
                                $.ajax({
                                    url: "thucdon-data.php",
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
                </div>
                <style>
                     #thang-dang{
                        height: 30px;
                        margin-left: 5px;
                    }
                    #dang-sua-bai{
                        background-color: blue;
                        color:#e5e5e5;
                        border-radius: 2px;
                    }

                    #dang-sua{
                        
                        width: 32%;
                        height:600px;
                        margin-left: 2%;
                        margin-top: 20px;
                    }
                    #dangbai{
                        width: 500px;
                        height:290px;
                        background-color: aliceblue;
                    }
                    #suabai{
                        margin-top: 20px;
                        width: 500px;
                        height:290px;
                        background-color: aliceblue;
                    }
                </style>
            </div>
            
       
    </body>
</html>