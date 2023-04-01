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

            #ct{
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

            #tb{
                width:800px;
                margin-left: 75px;
                height: 350px;
                overflow-y:scroll ;
                
            }
            
            #table-cth td{
                border-style: double;
                border-color: black;
                text-align: center;
            }

            #table-cth #cot-an{
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
            function lietke(){
                var select = document.getElementById('khoi');
                var khoi = select.options[select.selectedIndex].value;
                var nam=document.getElementById("namhoc").value;
               $.ajax({
                    type: 'POST',
                    url: 'chuongtrinhhoc-data.php',
                    data: {
                        khoi: khoi,
                        namhoc: nam
                        
                    },
                    success: function(response){
                       $("#tb").html(response);
                       //alert(response);
                       
                    }
				});
                
            }
            function xem(row){
                document.getElementById("frame").style.display='flex';
                var i=row.parentNode.parentNode.rowIndex;
                var tieude=document.getElementById("table-cth").rows[i].cells[1].innerHTML;
                var link=document.getElementById("table-cth").rows[i].cells[2].innerHTML;
                
              $.ajax({
							type: 'POST',
							url: 'chuongtrinhhoc-data.php',
							data: {
                                tieude: tieude,
                                link: link
                                
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
                var i=row.parentNode.parentNode.rowIndex;
                var matd=document.getElementById("table-cth").rows[i].cells[0].innerHTML;
                var result=confirm("Bạn xóa chương trình học này?");
                 if(result) {
                    $.ajax({
                        type: 'POST',
                        url: 'chuongtrinhhoc-data.php',
                        data: {
                            matdxoa: matd,
                        },
                        success: function(response){
                            location.reload();
                        }
                    });
                 }
            }

            function suabai(row){
                var i=row.parentNode.parentNode.rowIndex;
                var tieude=document.getElementById("table-cth").rows[i].cells[1].innerHTML;
                var matd=document.getElementById("table-cth").rows[i].cells[0].innerHTML;
                var nam=document.getElementById("table-cth").rows[i].cells[4].innerHTML;
                document.getElementById("nam-cn").value=nam;
                document.getElementById('tieudecn').value=tieude;
                document.getElementById('mactcn').value=matd;
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
                <div id="ct">
                    <br><br>
                    <p style="text-align: center; font-size: 20; color: red;">CHƯƠNG TRÌNH HỌC</p>
                    
                    <Label style="margin-left: 125px;"><b>Khối</b></Label>
                    <select id="khoi">
                        <option>Tất cả</option>
                        <?php $q=$conn->query("SELECT*FROM khoi");
                         while($row=$q->fetch_assoc()){
                            echo "<option value='".$row["MAKHOI"]."'>".$row["TENKHOI"]."</option>";
                         }?>
                    </select>
                    <Label style="margin-left: 10px;"><b>Năm học</b></Label>
                    <select id="namhoc">
                        <option>Tất cả</option>
                    <?php $q=$conn->query("SELECT DISTINCT NAMHOC FROM chuongtrinhhoc");
                         while($row=$q->fetch_assoc()){
                            echo "<option>".$row["NAMHOC"]."</option>";
                         }
                    ?>
                    </select>

                    <button id="lietke" onclick="lietke()">Liệt kê</button><br>

                    <div id="tb">
                        <table id='table-cth'>
                            <tr style='position:sticky; top: 0;'>
                                <td id='cot-an'>Mã số</td>
                                <td style='width: 390; background-color: #1386f9; color:aliceblue'>Tiêu đề</td>
                                <td id='cot-an'>Link</td>
                                <td style='width: 80; background-color: #1386f9; color:aliceblue'>Khối</td>
                                <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm học</td>
                                
                                <td style='width: 150; background-color: #1386f9; color:aliceblue'>Chức năng</td>
                            </tr>
                           
                       
                        <?php 
                                $q=$conn->query("SELECT*FROM chuongtrinhhoc");

                            while($row=$q->fetch_assoc()){

                            ?>
                                <tr>
                                        <td id='cot-an'><?php echo $row["MACT"] ?></td>
                                        <td style='width: 390;'><?php echo $row["TIEUDE"] ?></td>
                                        <td id='cot-an'><?php echo $row["LINK"] ?></td>
                                        <td style='width: 80;'><?php 
                                            $q1=$conn->query("SELECT*FROM khoi WHERE MAKHOI='".$row["MAKHOI"]."'");
                                            while($r=$q1->fetch_assoc()){
                                                echo $r["TENKHOI"];
                                            }
                                            ?></td>
                                        <td style='width: 180;'><?php echo $row["NAMHOC"]; ?></td>
                                        <td ><button id='btn-xem' onclick='xem(this)'><i class="bi bi-eye"></i></button>
                                            <button id='btn-sua' onclick=suabai(this)><i class="bi bi-pen"></i></button>
                                             <button id='btn-xoa' onclick='xoa(this)'><i class="bi bi-x"></i></button></td>
                                    </tr>
                                
                            <?php  }?>
                         </table>
                    </div>
                </div>
            <!--Thêm chương trình học-->
                <div id="dang-sua">
                    <div id="dangbai">
                        <br>
                        <p style="text-align: center; font-size: 20; color: red;">THÊM CHƯƠNG TRÌNH HỌC</p>
                        
                        <Label style="margin-left: 30px;"><b>Khối</b></Label>
                        <select id="khoi-them">
                        <?php $q=$conn->query("SELECT*FROM khoi");
                         while($row=$q->fetch_assoc()){
                            echo "<option value='".$row["MAKHOI"]."'>".$row["TENKHOI"]."</option>";
                         }?>
                        </select>
                        <Label style="margin-left: 10px;"><b>Năm học</b></Label>
                        <input type="text" id="nam-them" placeholder="VD: 2022-2023">
                        <button id="dang-sua-bai" onclick="themTD()">Thêm</button><br><br>
                        <Label style="margin-left: 30px;"><b>Tiêu đề</b></Label>
                        <input id='tieudethem' type="text" style="width: 350px;">
                        <br><br>
                        <input id='filethem' type='file' style="margin-left: 30px;">
                        <script>
                            function themTD(){
                                var tieude=document.getElementById('tieudethem').value;
                                var thang=document.getElementById('khoi-them').value;
                                var nam=document.getElementById("nam-them").value;
                                var filedang=$("#filethem").prop("files")[0];
                                var form_data = new FormData();
                               form_data.append("tieudethem",tieude);
                                form_data.append('khoithem',thang);
                                form_data.append('filethem',filedang);
                                form_data.append('namthem',nam);
                                $.ajax({
                                    url: "chuongtrinhhoc-data.php",
                                    dataType: 'text',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,                         
                                    type: 'post',
                                    success: function(response){
                                        
                                        alert(response);
                                        location.reload();
                                    }
                                })
                            }
                        </script>
                    </div>

                    <!--Cập nhật chương trình học-->
                    <div id="suabai">
                    <br>
                        <p style="text-align: center; font-size: 20; color: red;">CẬP NHẬT CHƯƠNG TRÌNH HỌC</p>
                        
                        <Label style="margin-left: 30px;"><b>Khối</b></Label>
                        <select id="khoi-cn">
                        <?php $q=$conn->query("SELECT*FROM khoi");
                         while($row=$q->fetch_assoc()){
                            echo "<option value='".$row["MAKHOI"]."'>".$row["TENKHOI"]."</option>";
                         }?>
                        </select>
                        <Label style="margin-left: 5px;"><b>Năm học</b></Label>
                        <input type="text" id="nam-cn" placeholder="VD: 2022-2023">
                        <button id="dang-sua-bai" onclick="capnhat()">Cập nhật</button><br><br>
                        <Label style="margin-left: 30px;"><b>Tiêu đề</b></Label>
                        <input id='tieudecn' type="text" style="width: 350px;">
                        <input id='mactcn' type='hidden'>
                        <br><br>
                        <input id='filecn' type='file' style="margin-left: 50px;">
                        <script>
                            function capnhat(){
                                var thang=document.getElementById("khoi-cn").value;
                                var nam=document.getElementById("nam-cn").value;
                                var tieude=document.getElementById("tieudecn").value;
                                var matd=document.getElementById("mactcn").value;
                               var file=$("#filecn").prop("files")[0];
                                var form_data=new FormData();
                                form_data.append("khoicn",thang);
                                form_data.append("namcn",nam);
                                form_data.append("tieudecn",tieude);
                                form_data.append("mactcn",matd);
                                form_data.append("filecn",file);
                                $.ajax({
                                    url: "chuongtrinhhoc-data.php",
                                    dataType: 'text',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,                         
                                    type: 'post',
                                    success: function(response){
                                        alert(response);
                                        location.reload();
                                        
                                    }
                                });
                                
                            }
                        </script>
                    </div-->
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