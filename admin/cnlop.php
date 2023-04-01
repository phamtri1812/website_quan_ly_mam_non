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
        
        <style> 
            #content{
                width:100%;
                height: 700px;
                display:flex;
                background-color: rgba(0, 0, 0, 0.7);
            }

            #lop{
                width:24%;
                height:660px;
                background-color: aliceblue;
                margin-left: 1%;
                margin-top: 20px;
            }
            #chuyenlop{
                width: 73%;
                margin-top: 20px;
                margin-left: 1%;
                height: 660px;
                background-color: aliceblue;
                display:flex;
            }
            #lopcu{
                width: 450px;
                margin-top: 30px;
                margin-left: 20px;
                height: 600px;
                
                
            }

            #lopmoi{
                width: 450px;
                margin-top: 30px;
                margin-left: 10px;
                height: 600px;
               
            }

            #tb-lop{
                width:320px;
                height: 250px;
                margin-left: 20px;
                overflow-y: scroll;
                background-color:  rgba(0, 0, 0, 0.7);
            }

            #tb-lop td{
                text-align: center;
                border-style: double;
                border-color: black;
                background-color:#ffffff;
                
            }
        </style>

        <script>
            function lk(){
                var makhoi=document.getElementById("khoi").value;
               $.ajax({
                    url: "cnlop-data.php",

                    data:{
                        makhoi: makhoi
                    },                       
                    type: 'post',
                    success: function(response){
                        $("#tb-lop").html(response);
                    }
                });
            }

            function xoa(row){
                var i=row.parentNode.parentNode.rowIndex;
                var msxoa=document.getElementById("table-lop").rows[i].cells[0].innerHTML;
                $.ajax({
                    url: "cnlop-data.php",

                    data:{
                        msxoa: msxoa
                    },                       
                    type: 'post',
                    success: function(response){
                        location.reload();
                    }
                });
            }

            function cn(row){
                document.getElementById("pcgd").style.display='block';
                var i=row.parentNode.parentNode.rowIndex;
                var mslop=document.getElementById("table-lop").rows[i].cells[0].innerHTML;
                $.ajax({
                    url: "cnlop-data.php",

                    data:{
                        mslop: mslop
                    },                       
                    type: 'post',
                    success: function(response){
                        $("#xpc").html(response);
                    }
                });

            }

            function closePC(){
                document.getElementById("pcgd").style.display='none';
            }

            function luuPC(){
                var mstd=document.getElementById("mlop").value;
                var msgv=document.getElementById("slgv").value;
                var xd=document.getElementById("xd").value;
                $.ajax({
                    url: "cnlop-data.php",

                    data:{
                        mstd: mstd,
                        msgv: msgv,
                        xd: xd
                    },                       
                    type: 'post',
                    success: function(response){
                        location.reload();
                        //alert(response);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id='pcgd'>
            <style>
                #pcgd{
                    top:0;
                    bottom:0;
                    left: 0;
                    right: 0;
                    position:fixed;
                    background: rgba(0, 0, 0, 0.7);
                    display: none;
                    z-index: 4;
                }

                #xpc{
                    width: 500px;
                    height: 300px;
                    margin-left: 500px;
                    margin-top: 150px;
                    background-color: #ffffff;
                }
            </style>
            <div id='xpc'>
           

            </div>
        </div>
        <div id="content">
            <div id="lop">
                <br>
                <p style='text-align:center; color: red; font-size: 20;'>DANH SÁCH LỚP HỌC</p>
                <Label style='margin-left: 20px;'><b>Khối </b></Label>
                <select id='khoi'>
                    <option>Tất cả</option>
                    <?php 
                        $q=$conn->query("SELECT*FROM khoi");
                        while($r=$q->fetch_assoc()){
                            echo "<option value='".$r["MAKHOI"]."'>".$r["TENKHOI"]."</option>";
                        }
                ?>
                </select>
                <button style='background-color:blue; color:aliceblue; border: none; border-radius: 3px;' onclick='lk()'>Liệt kê</button>

                <div id='tb-lop'>
                    <table id='table-lop'>
                        <tr style='top: 0; position:sticky;'>
                            <td style='width: 100px; background-color:blue; color:azure;'>Mã lớp</td>
                            <td style='width: 100px; background-color:blue; color:azure;'>Lớp học</td>
                            <td style='width: 120px; background-color:blue; color:azure;'>Chức năng</td>
                        </tr>
                    <?php
                        $q1=$conn->query("SELECT*FROM lop");
                        while($row=$q1->fetch_assoc()){
                            echo "<tr>
                                    <td>".$row["MSLOP"]."</td>
                                    <td>".$row["TENLOP"]."</td>
                                    <td><button id='btn-del' onclick='xoa(this)' style='background-color: red; color: white; border-radius: 2px;'><i class='bi bi-trash'></i></button>
                                    <button id='btn-del' onclick='cn(this)' style='background-color: blue; color: white; border-radius: 2px;'><i class='bi bi-pen'></i></button></td>
                            </tr>";
                        }
                    ?>
                    </table>
                </div>
                <hr style='padding: 0;
                    border: none;
                    border-top: medium double #333;
                    color: #333;'>
                <p style='text-align:center; color: red; font-size: 20;'>THÊM LỚP HỌC</p>
                <Label style='margin-left: 20px;'><b>Khối </b></Label>
                <select id='khoi-new'>
                    <?php 
                        $q=$conn->query("SELECT*FROM khoi");
                        while($r1=$q->fetch_assoc()){
                            echo "<option value='".$r1["MAKHOI"]."'>".$r1["TENKHOI"]."</option>";
                        }
                ?>
                </select>
                <br>
                <Label style='margin-left: 20px;'><b>Mã lớp</b></Label>
                <input type="text" id="mlopnew" style='width: 200px'><br><br>
                <Label style='margin-left: 20px;'><b>Tên lớp</b></Label>
                <input type="text" id="tenlopnew" style='width: 200px'>
                <br><br>
                <table style='margin-left:75px'>
                    <tr>
                        <td style='width: 100px;'><button id='btn-luu' onclick='Luu()' style='background-color:blue; color:aliceblue; width: 100px; height: 30px; border: none; border-radius: 5px;'>Lưu</button></td>
                        <td style='width: 100px;'><button id='btn-huy' onclick='Huy()' style='background-color:red; color:aliceblue; width: 100px; height: 30px; border: none; border-radius: 5px;'>Hủy</button></td>

                    </tr>
                </table>
                <script>
                    function Huy(){
                        location.reload();
                    }

                    function Luu(){
                        var khoi=document.getElementById("khoi-new").value;
                        var ml=document.getElementById("mlopnew").value;
                        var lop=document.getElementById("tenlopnew").value;
                        $.ajax({
                            url: "cnlop-data.php",

                            data:{
                                makhoinew: khoi,
                                malopnew: ml,
                                tenlopnew: lop
                            },                       
                            type: 'post',
                            success: function(response){
                               location.reload();
                            }
                        });
                    }

                    function lkcu(){
                        var select = document.getElementById('lop-cu');
                        var lkcu = select.options[select.selectedIndex].value;
                        $.ajax({
                            url: "cnlop-data.php",

                            data:{
                               lkcu: lkcu
                            },                       
                            type: 'post',
                            success: function(response){
                               
                                    $("#tb-lopcu").html(response);
                                  
                            }
                        });

                        $.ajax({
                            url: "cngv-data.php",

                            data:{
                               lkcu: lkcu
                            },                       
                            type: 'post',
                            success: function(response){
                               
                                    $("#gvcu").html(response);
                                  
                            }
                        });
                      
                    }

                    function lkmoi(){
                        var select = document.getElementById('lop-moi');
                        var lkmoi = select.options[select.selectedIndex].value;
                       
                       $.ajax({
                            url: "cnlop-data.php",

                            data:{
                               lkmoi: lkmoi
                            },                       
                            type: 'post',
                            success: function(response){
                               $("#tb-lopmoi").html(response);
                            }
                        });

                        $.ajax({
                            url: "cngv-data.php",

                            data:{
                               lkmoi: lkmoi
                            },                       
                            type: 'post',
                            success: function(response){
                               
                                    $("#gvmoi").html(response);
                                  
                            }
                        });
                    }

                    function chooseAll(){
                        var rowCount=$('#tbcu tr').length;
                        const choose= document.getElementsByClassName('checkrow');
                        if(document.getElementById('checkall').checked==true){
                            for(var i=0; i<rowCount-1; i++){
                                choose[i].checked=true;
                            }
                           
                        }
                       else {
                            for(var i=0; i<rowCount-1; i++){
                              choose[i].checked=false;
                            }
                        }
                    }

                </script>
            </div>
            
            <div id="chuyenlop">
                <!--ds lớp cũ-->
                <div id='lopcu'>
                    <br>
                    <select id='lop-cu'>
                        
                        <?php 
                            $q=$conn->query("SELECT*FROM lop");
                            while($r=$q->fetch_assoc()){
                                echo "<option value='".$r["MSLOP"]."'>".$r["TENLOP"]."</option>";
                            }
                    ?>
                    </select>
                    <button style='background-color:blue; color:aliceblue; border: none; border-radius: 3px;' onclick='lkcu()'>Liệt kê</button> 
                    <br><p><b id="gvcu"></b></p>
                    
                    <div id='tb-lopcu'>
                        <table id='tbcu'>
                            <tr style='top:0; position: sticky'>
                                <td style='display: none;'>Mã số</td>
                                <td style='width: 300px; background-color:blue; color:#ffffff; text-align:center;'>Họ tên học sinh</td>
                                <td style='width: 150px; background-color:blue; color:#ffffff; text-align:center;'><input type='checkbox' id='checkall' onclick='chooseAll()'></td>
                            </tr>
                        
                        <?php 
                            $q=$conn->query("SELECT*FROM hocsinh WHERE MSLOP='C1'");
                            while($rcu=$q->fetch_assoc()){
                                echo "<tr>
                                        <td style='display: none;'>".$rcu["MAHS"]."</td>
                                        <td>".$rcu["HOTENHS"]."</td>
                                        <td style='text-align: center;'><input type='checkbox' class='checkrow'></td>
                                    </tr>";
                            }
                        ?>
                        </table>
                    </div>
                </div>
                <script>
                    function chuyen(){
                        var rowCount=$('#tbcu tr').length;
                        const choose= document.getElementsByClassName('checkrow');
                        var l=[];
                        for(i=0;i<rowCount-1;i++){
                            if(choose[i].checked==true){
                                var ms=document.getElementById("tbcu").rows[i+1].cells[0].innerHTML;
                                l.push(ms);
                             }
                        }
                        
                        var select = document.getElementById('lop-moi');
                        var malopmoi = select.options[select.selectedIndex].value;
                        $.ajax({
                            url: "cnlop-data.php",

                            data:{
                               l: l,
                               malopmoi: malopmoi
                            },                       
                            type: 'post',
                            success: function(response){
                               //$("#tb-lopmoi").html(response);
                               lkcu();
                               lkmoi();
                            }
                        });
                        
                    }
                </script>

                <button id='btn-luu' onclick='chuyen()' style='background-color:blue; color:aliceblue; width: 100px; margin-left:10px; margin-top: 315px;
                                                           height: 30px; border: none; border-radius: 5px;'><i class="bi bi-arrow-right-circle"></i></button>
                
                <!--ds lớp mới-->
                <div id='lopmoi'>
                <br>
                    <select id='lop-moi'>
                        <?php 
                            $q=$conn->query("SELECT*FROM lop");
                            while($r=$q->fetch_assoc()){
                                echo "<option value='".$r["MSLOP"]."'>".$r["TENLOP"]."</option>";
                            }
                    ?>
                    </select>
                    <button style='background-color:blue; color:aliceblue; border: none; border-radius: 3px;' onclick='lkmoi()'>Liệt kê</button> 
                    <br><p><b id="gvmoi"></b></p>
                    <div id='tb-lopmoi'>
                    <table id='tbmoi'>
                            <tr style='top:0; position: sticky'>
                                <td style='display: none;'>Mã số</td>
                                <td style='width: 450px; background-color:blue; color:#ffffff; text-align:center;'>Họ tên học sinh</td>
                                
                            </tr>
                        
                        <?php 
                            $q=$conn->query("SELECT*FROM hocsinh WHERE MSLOP='C1'");
                            while($rmoi=$q->fetch_assoc()){
                                echo "<tr>
                                        <td style='display: none;'>".$rmoi["MAHS"]."</td>
                                        <td>".$rmoi["HOTENHS"]."</td>
                                       
                                    </tr>";
                            }
                        ?>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <style>
            #tbcu td{
                background-color: #ffffff;
                border-color: black;
                border-style:double;
            }
            #tbmoi td{
                background-color: #ffffff;
                border-color: black;
                border-style:double;
            }
            #tb-lopcu{
                width: 450px;
                height: 500px;
                background-color:#ceccc4;
                overflow-y:scroll;
            }
            #tb-lopmoi{
                width: 450px;
                height: 500px;
                background-color:#ceccc4;
                overflow-y:scroll;
            }
        </style>

    </body>
</html>