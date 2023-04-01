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
    <style>
        #menu-bar {
        top:0;
        position:sticky;
        height: 40px;
        background-color: #007fff;
        display: block;
        text-align: center;
        }

        #nav {
            display: inline-block;
            word-spacing: -4px;
        }


        #nav > li {
            word-spacing: 0px;
            display: inline-block;
            height: 40px;
            padding: 7px 6px;
            width: 200px;
            color:aliceblue;
            font-size: 16;
           
            text-align: left;
        }

        #nav li {
            position: relative;
            cursor: pointer;
            text-align: center;
        }

        #nav > li:hover {
           background-color: #56aaff;
        }

        #nav li a{
            text-decoration: none;
            color: white;
        }

        .list {
            list-style: none;
            position: absolute;
             width: 300px;
            top: 100%;
            left: 0; 
            display: none;
            
        }

        .list li{
            color: white;
            background-color: #56aaff;
            width: 300px;
            left: -40px;
            padding: 10px;
        }

        .list li:hover{
            background-color: #007fff;
        }

         #nav li:hover .list{
            display: block;
         }

    </style>
    <script >
         function out(){
        var result = confirm("Bạn muốn đăng xuất?");
        if(result) {
            location='../logout.php';
        }
    }
    </script>
<div id="header">
<img src="../css/mt.png" style="width: 100%; height: 25%;">
    <div id="menu-bar">
        <ul id="nav">
            <li onclick="location.href='../inc/home.php'">
                <i class="bi bi-house"></i>Trang chủ
             
            </li>
            <li onclick="location.href='giaovien.php';">
            <i class="bi bi-person"></i>
                Cá nhân
            </li>
            <li onclick="out()">
            <i class="bi bi-power"></i>
                Đăng xuất
            </li>
        
        </ul>
    </div>
     
</div>
</html>
