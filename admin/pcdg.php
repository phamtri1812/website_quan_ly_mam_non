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
                var select = document.getElementById('namhoc');
                var nam = select.options[select.selectedIndex].text;
                
              $.ajax({
                    type: 'POST',
                    url: 'pcgd-data.php',
                    data: {
                       
                        namhoc: nam
                        
                    },
                    success: function(response){
                       $("#tb").html(response);
                       //alert(response);
                       
                    }
				});
                
            }
            function xem(row){
                var i=row.parentNode.parentNode.rowIndex;
                var magv=document.getElementById("table-cth").rows[i].cells[0].innerHTML;
                var ten=document.getElementById("table-cth").rows[i].cells[1].innerHTML;
                $("#tengv").html(ten);
              $.ajax({
							type: 'POST',
							url: 'pcgd-data.php',
							data: {
                                magv: magv
                                
							},
							success: function(response){
                               $("#ls").html(response);
                               
							}
						});
                
            }
            

            function xoa(row){
                var i=row.parentNode.parentNode.rowIndex;
                var magvxoa=document.getElementById("table-cth").rows[i].cells[0].innerHTML;
                var nam=document.getElementById("table-cth").rows[i].cells[3].innerHTML;
                var result=confirm("Bạn xóa phân công giảng dạy này?");
                 if(result) {
                   $.ajax({
                        type: 'POST',
                        url: 'pcgd-data.php',
                        data: {
                            magvxoa: magvxoa,
                            namhocxoa: nam
                        },
                        success: function(response){
                            location.reload();
                        }
                    });
                 }
            }

            
        </script>
        
    </head>
    <body>
            
           <?php  require_once("../inc/header.php"); ?>
           <div id="content">
                <div id="ct">
                    <br><br>
                    <p style="text-align: center; font-size: 20; color: red;">BẢNG PHÂN CÔNG</p>
                    
                    <Label style="margin-left: 75px;"><b>Năm học</b></Label>
                    <select id="namhoc">
                        <option>Tất cả</option>
                    <?php $q=$conn->query("SELECT DISTINCT NAMHOC FROM phanconggd");
                         while($row=$q->fetch_assoc()){
                            echo "<option>".$row["NAMHOC"]."</option>";
                         }
                    ?>
                    </select>

                    <button id="lietke" onclick="lietke()">Liệt kê</button><br>

                    <div id="tb">
                        <table id='table-cth'>
                            <tr style='position:sticky; top:0;'>
                                <td style='width: 80; background-color: #1386f9; color:aliceblue'>Mã số </td>
                                <td style='width: 300; background-color: #1386f9; color:aliceblue'>Họ tên</td>
                                <td style='width: 80; background-color: #1386f9; color:aliceblue'>Lớp</td>
                                <td style='width: 180; background-color: #1386f9; color:aliceblue'>Năm học</td>
                                <td style='width: 80; background-color: #1386f9; color:aliceblue'>Lịch sử</td>
                                <td style='width: 80; background-color: #1386f9; color:aliceblue'>Xóa</td>
                            </tr>
                           
                       
                        <?php 
                                $q=$conn->query("SELECT gv.MSGV, gv.HOTENGV, phanconggd.MSLOP, phanconggd.NAMHOC FROM `phanconggd`, gv WHERE gv.MSGV=phanconggd.MAGV");

                            while($row=$q->fetch_assoc()){

                            ?>
                                <tr>
                                        <td style='width: 80;'><?php echo $row["MSGV"] ?></td>
                                        <td style='width: 300;'><?php echo $row["HOTENGV"] ?></td>
                                        <td style='width: 80;'><?php 
                                            $q1=$conn->query("SELECT*FROM lop WHERE MSLOP='".$row["MSLOP"]."'");
                                            while($r=$q1->fetch_assoc()){
                                                echo $r["TENLOP"];
                                            }
                                            ?></td>
                                        <td style='width: 180;'><?php echo $row["NAMHOC"]; ?></td>
                                        <td style='width: 80;'><button id='btn-xem' onclick='xem(this)'><i class="bi bi-eye"></i></button></td>
                                        <td style='width: 80;'><button id='btn-xoa' onclick='xoa(this)'><i class="bi bi-x"></i></button></td>
                                    </tr>
                                
                            <?php  }?>
                         </table>
                    </div>
                </div>
            <!--Thêm phân công-->
                <div id="dang-sua">
                    <div id="dangbai">
                        <br>
                        <p style="text-align: center; font-size: 20; color: red;">PHÂN CÔNG</p>
                        
                        <Label style="margin-left: 30px;"><b>Lớp</b></Label>
                        <select id="lop-pc">
                        <?php $q=$conn->query("SELECT*FROM lop");
                         while($row=$q->fetch_assoc()){
                            echo "<option value='".$row["MSLOP"]."'>".$row["TENLOP"]."</option>";
                         }?>
                        </select>
                        <Label style="margin-left: 10px;"><b>Năm học</b></Label>
                        <input type="text" id="nam-them" placeholder="VD: 2022-2023">
                        <button id="dang-sua-bai" onclick="themPCGD()">Lưu</button><br><br>
                        <Label style="margin-left: 30px;"><b>Họ tên giáo viên</b></Label>
                        <select id="gv-pc">
                        <?php 
                            $gv=array();
                            $hoten=array();
                            $pc=array();
                            $q=$conn->query("SELECT*FROM gv");
                            while($row=$q->fetch_assoc()){
                                $gv[]=$row["MSGV"];
                                $hoten[]=$row["HOTENGV"];

                            }
                            $date=getdate();
                            $n1=$date['year'];
                            $n2=$date['year']+1;
                            $namhoc=$n1."-".$n2;
                            $q2=$conn->query("SELECT*FROM phanconggd WHERE NAMHOC='".$namhoc."'");
                            while($r=$q2->fetch_assoc()){
                                $pc[]=$r["MAGV"];
                            }
                            
                            for($i=0;$i<count($gv);$i++){
                                if(in_array($gv[$i],$pc)){
                                    continue;
                                }
                                else{
                                    echo "<option value='".$gv[$i]."'>".$hoten[$i]."</option>";
                                }
                                
                            }
                         ?>
                        </select>
        
                        <script>
                            function themPCGD(){
                                var nam=document.getElementById('nam-them').value;
                                var lop=document.getElementById('lop-pc').value;
                                var magv=document.getElementById("gv-pc").value;
                               
                                $.ajax({
                                    url: "pcgd-data.php",
                                    data: {
                                        namhocthem: nam,
                                        lopthem: lop,
                                        gvthem: magv
                                    },                     
                                    type: 'post',
                                    success: function(response){
                                        alert(response);
                                        location.reload();
                                    }
                                });
                                   
                            }
                        </script>
                    </div>

                    <!--Lịch sử công tác-->
                    <div id="suabai">
                    <br>
                        <p style="text-align: center; font-size: 20; color: red;">LỊCH SỬ GIẢNG DẠY</p>
                        
                        <Label style='margin-left: 30px;'><b >Giáo viên: </b><b id="tengv"></b></Label>
                        <div id="ls">

                        </div>
                       
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
                        height:200px;
                        background-color: aliceblue;
                    }
                    #suabai{
                        margin-top: 20px;
                        width: 500px;
                        height:380px;
                        background-color: aliceblue;
                    }
                    #ls{
                        width: 450px;
                        height: 250px;
                        margin-left: 25px;
                       overflow-y: scroll;
                    }

                    #ls td{
                        border-style: double;
                        border-color: black;
                        text-align: center;
                    }
                </style>
            </div>
            
       
    </body>
</html>