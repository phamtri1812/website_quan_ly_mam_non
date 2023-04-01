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
                width: 50%;
                height: 470px;
                margin-top:20px;
                
                border-style: double;
                background-color:aliceblue;
                overflow-y: auto;
                margin-left: 2.5%;
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

            #hdanh{
                width: 25%;
                height: 470px;
                margin-top: 20px;
                margin-left: 10px;
                margin-right:10px;
                background-color:aliceblue;
                border-style: double;
                border-radius: 25px;
                border-color: #0800ff;
                overflow-y: hidden;
            }
            #listimg li{
                list-style-type: none;
                margin-left: 25px;
            }

            #frame-img{
                width:90%;
                margin-top: 5px;
                background-color: aquamarine;
                font-size: 18px;
                height: 70px;
                border-radius: 10px;
                padding-left: 50px;
                padding-top: 15px;
             
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
            function xem(){
                var k=document.getElementById("gv").value;
                $.ajax({
                    type: 'POST',
                    url: 'dsgv-data.php',
                    data: {
                        makhoi: k
                    },
                    success: function(response){
                        $("#tb-dsgv").html(response);
                    }
                });
           }
                
        </script>
    </head>
    <body>
        <div id='content'>
              <!--Hoạt động ảnh--------------->
              <div id='hdanh'>
                <p style=' font-size: 20; color: red; margin-left: 30px;'><img src='../css/huongduong.png' style='width: 80px; height: 80px; border-radius: 50%; '>HOẠT ĐỘNG GẦN ĐÂY</p>
                <div id='img-dong'>
                    <div id='anh'>
                        <?php
                            $q=$conn->query("SELECT * FROM `anh` ORDER BY THOIGIAN DESC");
                            $i=0;
                            while($rd=$q->fetch_assoc()){
                                if($i<5){
                                    echo "<div id='img-hd'><img src='".$rd["LINK"]."' style='width: 200; height: 150;'><br>".$rd["CHUDE"]."</div>";
                                    $i=$i+1;
                                }
                                else{
                                    break;
                                }
                            }
                            echo "</ul>";
                        ?>
                    </div>
                </div>
                <style>
                    #img-dong{
                        width: 100%;
                        height:90%;
                        position:relative;
                        overflow-y: hidden;
                    }
                    #img-hd{
                        width: 80%;  
                        height:45%;
                        text-align: center;
                        color:red;
                        margin-left: 10%;
                    }

                   #anh{
                    position:relative;
                    top:0px;
                    animation-name: move;
                    animation-duration:10s;
                    animation-iteration-count:infinite;
                   }
                   @keyframes move{
                    0%{
                            top:0%;
                            
                        }
                        
                        25%{
                            top:-45%;
                           
                        }
                        
                        50%{
                            top:-90%;
                        }
                        
                        75%{
                            top:-135%;
                        }
                    }
                </style>
            </div>  
            <div id='xemimg'>
                
                <?php
                     $date=getdate();
                     $n1=$date['year'];
                     $n2=$date['year']+1;
                     $namhoc=$n1."-".$n2;
                     echo "<p style='text-align:center; color:red; font-size:20; margin-top: 30px;'>DANH SÁCH GIÁO VIÊN NĂM HỌC ".$namhoc."</p>";
                ?>
                <b style='margin-left: 100px;'>Khối: </b>
                <select id='gv'>
                    <option>Tất cả</option>
                    <?php
                        $qk=$conn->query("SELECT*FROM khoi");
                        while($r=$qk->fetch_assoc()){
                            echo "<option value='".$r["MAKHOI"]."'>".$r["TENKHOI"]."</option>";
                        }
                    ?>
                </select>
                <button onclick='xem()' style='background-color:#0800ff; color: white; border: none; border-radius: 5px;'>Xem</button>
                <div id='tb-dsgv'>
                    <?php
                        $q=$conn->query("SELECT gv.HOTENGV, SDT, TENLOP, ANHGV  FROM gv, lop, phanconggd 
                                            WHERE gv.MSGV=phanconggd.MAGV AND lop.MSLOP=phanconggd.MSLOP AND NAMHOC='".$namhoc."'");
                        echo "<table style='margin-left: 100px'>";
                        while($r=$q->fetch_assoc()){
                            echo "<tr>
                                <td style='width: 150px; height: 120px; padding-top: 10px;'><img src='".$r["ANHGV"]."' style='width: 100px; height: 100px;'></td>
                                <td><b>Giáo viên: ".$r["HOTENGV"]."</b><br>
                                        Lớp: ".$r["TENLOP"]."<br>
                                        Số điện thoại: ".$r["SDT"]."</td>

                            </tr>";
                        }
                        echo "</table>";
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
    
        
    