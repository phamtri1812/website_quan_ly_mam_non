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
    
<div id="header">
<img src="../css/mt.png" style="width: 100%; height: 25%; ">
    <div id="menu-bar">
        <ul id="nav">
             <li onclick="location.href='../inc/home.php'">
                <i class="bi bi-house"></i>Trang chủ
             
            </li>
            <li>
            <i class="bi bi-book"></i>
                Tin tức
                <ul class='list'>
                    <li onclick="location.href='../inc/tintuc.php';">Bài viết</li>
                    <li onclick="location.href='../inc/thongbao.php';">Thông báo</li>
                    <li onclick="location.href='../inc/dsgv.php';">Danh sách giáo viên</li>
                </ul>
                
            </li>
            <li onclick="location.href='../inc/hinhanh.php';">
            <i class="bi bi-card-image"></i>
                Hình ảnh
            </li>
            <li onclick="location.href='../inc/thucdon.php';">
            <i class="bi bi-card-list"></i>
               Thực đơn
            </li>
            <li onclick="location.href='../inc/chuongtrinhhoc.php';">
            <i class="bi bi-grid-3x3-gap"></i>
                Chương trình học
            </li>
            <li>
                <a href='../inc/lienhe.php' style='text-decoration: none;'><i class="bi bi-chat-quote"></i>
                    Liên hệ
                </a>
            </li>
        </ul>
    </div>
     
</div>
</html>
