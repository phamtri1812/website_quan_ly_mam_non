<?php
    require_once("../connect.php");
    require_once("../inc/heading.php");
?>
<html>
    <head>
        <style>
            body{
                background-color: #baf2f2;
            }
            #content{
                width: 100%;
                background-color: #baf2f2;
                display:flex;
            }

            #xemimg{
                width: 75%;
                margin-left: 5%;
                margin-top:20px;
                border-radius: 50px;
                border-style: double;
                background-color:aliceblue;
               
                

            }
            #log{
                width:25%;
                height:470px;
                background-color: #baf2f2;
                margin-top: 20px; 
            }
            #login{
                width: 80%;
                height: 35%;
                background-color: #e5e5e5;
                margin-left: 10%;
                border-style: solid;
                border-radius: 10px;
                border-color: #0061ff;
                overflow-x: hidden;
                overflow-y: hidden;
                
            }
            

            .label-login{
                width: 100%;
                height: 30px;
                text-align: center;
                color: white;
                background-color: #0061ff;
                font-size: 15;
                padding-top: 5px;
            }

            #btnDN{
                width: 150px;
                height: 30px;
                background-color: #0061ff;
                margin-left: 75px;
                margin-top: 0px;
                color: white;
                border: none;
                font-size: 16;
                border-radius: 5px;
              
            }

            #fdn{
                width: 90%;
                margin-left:5%;
                
            }

            #fdn input{
                width: 100%;
                height: 20%;
                margin-top: 3%;
            
            }
            #gocthayco{
                width: 80%;
                height:32%;
                margin-top:1%;
                margin-left: 10%;
                background-image: url("../css/khung.png");
                background-size: 100% 100%;
                border-radius: 10px;
                overflow-x: hidden;
            }
            #hd{
                width: 80%;
                height:32%;
                margin-top:1%;
                margin-left: 10%;
                background-image: url("../css/khung.png");
                background-size: 100% 100%;
                border-radius: 10px;
                overflow-x: hidden;
            }

           
            #listimg li{
                list-style-type: none;
                float: left;
                margin-left: 50px;
            }

            #frame-img{
                width:250px;
                height: 250px;
                
                margin-top: 30px;
             
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            function check(){
                var ten=document.getElementById("tendn").value;
                var matkhau=document.getElementById("mk").value;
                if(ten==''){
                    alert("Vui lòng nhập tên đăng nhập!");
                }
                else
                    if(matkhau==''){
                        alert("Vui lòng nhập mật khẩu!")
                    }
                   else{
                        $.ajax({
                            type: 'POST',
                            url: 'check.php',
                            data: {
                                name_user: ten,
                                pass_user: matkhau
                            },
                            success: function(response){
                                if(response=='ten'){
                                    alert('Tên đăng nhập sai!');
                                }
                                else{
                                    if(response=='mk'){
                                        alert('Mật khẩu sai!');
                                    }
                                    else {
                                        if(response=='yes'){
                                            document.flogin.submit();
                                        }
                                        else {
                                            alert('Lỗi rồi!!');
                                        }
                                    }
                                }
                            }
                        });
                    }


            }

            function xemanh(){
                var cd=document.getElementById("chude").value;
                var nam=document.getElementById("nam-img").value;
                $.ajax({
                    type: 'POST',
                    url: 'data.php',
                    data: {
                        cd: cd,
                        nam: nam
                    },
                    success: function(response){
                        $("#hframe").html(response);
                    }
                 });
                }
        </script>
    </head>
    <body>
        <div id='content'>
            <div id='xemimg'>
                <?php
                    #select chủ đề
                    $q1=$conn->query("SELECT DISTINCT CHUDE FROM `anh` ");
                    echo "<br><br><b style=' margin-left: 200px;'>CHỦ ĐỀ: </b><select id='chude'>
                            <option>Tất cả</option>";
                    while($r=$q1->fetch_assoc()){
                        echo "<option>".$r["CHUDE"]."</option>";
                    }
                    echo "</select>";
                    #select năm
                    echo "<b style='margin-left: 20px;'>Năm: </b><select id='nam-img'>
                        <option>Tất cả</option>";
                    $q=$conn->query("SELECT DISTINCT SUBSTRING(THOIGIAN, 1, 4) FROM anh ");
                    while($rn=$q->fetch_assoc()){
                        echo "<option>".$rn["SUBSTRING(THOIGIAN, 1, 4)"]."</option>";

                    }
                    echo "</select>";
                    echo "<button style='margin-left: 10px; border: none; border-radius: 3px; background-color: blue; color: white;'
                                                onclick='xemanh()'>Xem</button><br><br>";
                    ?>
                    <div id='hframe'>
                        <?php
                            if(isset($_POST["submit"])){
                                $q2=$conn->query("SELECT*FROM anh WHERE CHUDE='".$_POST["submit"]."'");
                            }
                            else{
                                $q2=$conn->query("SELECT*FROM anh ORDER BY THOIGIAN DESC");
                            }
                            echo "<ul id='listimg'>";
                            while($r2=$q2->fetch_assoc()){
                                echo "<li><div id='frame-img'><p style='text-align: center; color: red; font-size: 19px'><img src='".$r2["LINK"]."' style='width:200px; height: 170px;'><br>".$r2["CHUDE"]."</p></div></li>";
                            }
                            echo "</ul>"
                     ?>
                    </div>
                    
            </div>
            <div id="log">
                    <div id="login">
                            <div class="label-login">
                                    ĐĂNG NHẬP VÀO WEBSITE
                            </div>
                            
                            <form id="fdn" method="POST" name="flogin" action="../login.php">
                                
                                <input type="text" name='tendn' id="tendn" placeholder="   Tên Người Dùng" class="input-user">
                                
                                <input type="password" name='mk' id="mk" placeholder="   Mật khẩu" class="input-user">

                            </form>
                            <button id="btnDN" onclick="check()">Đăng nhập</button>
                    </div>
                    <div id='gocthayco'>
                        <p style="text-align:center; font-size: 15; color: red; margin-top: 10px;margin-bottom: 3px;"><b>BÀI VIẾT GẦN ĐÂY</b></p>
                        <ul style='list-style-type: none;'>
                        <?php
                            $q=$conn->query("SELECT*FROM baidang WHERE THELOAI='Bài viết'");
                            $i=0;
                            while($rt=$q->fetch_assoc()){
                                if($i<4){
                                    echo "<li style=' margin-left: 10px; '><a style='color: blue;' href='".$rt["LINK"]."'>".$rt["TIEUDE"]."</a></li>";
                                    $i=$i+1;
                                }
                                else{
                                    break;
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                    <div id='hd'>
                         <p style="text-align:center; font-size: 15; color: red; margin-top: 10px; margin-bottom: 3px;"><b>HOẠT ĐỘNG GẦN ĐÂY</b></p>
                         <?php 
                            $date=getdate();
                            $n1=$date['year'];
                            $q=$conn->query("SELECT DISTINCT CHUDE FROM `anh` WHERE THOIGIAN LIKE '".$n1."%' ORDER BY THOIGIAN DESC");
                            $i=0;
                            while($r=$q->fetch_assoc()){
                                if($i<4){
                                    echo "<form method='POST' action='hinhanh.php' style='height: 5px;'>
                                                    <input style='background: none; border: none; margin-left: 30px; color: blue;' type='submit' name='submit' value='".$r["CHUDE"]."'>
                                              </form>";
                                    $i=$i+1;
                                }
                                else{
                                    break;
                                }

                                    
                            }
                         ?>

                    </div>
            </div>
            
        </div>
       
    </body>
</html>
    