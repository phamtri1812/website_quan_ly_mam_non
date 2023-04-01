<!DOCTYPE html>
<html>
<head>
    <title>Xem ví dụ</title>
    <style type="text/css">
        #test{
            background-color:green;
            width:50px;
            height:50px;
            position:relative;
            top:0px;
            left:0px;
            animation-name:move;
            animation-duration:10s;
            animation-iteration-count:infinite;
        }
        @keyframes move{
            0%{
                top:0px;
                left:0px;
                background-color:blue;
            }
            10%{
                top:0px;
                left:400px;
                background-color:red;
            }
            40%{
                top:200px;
                left:400px;
                background-color:green;
            }
            100%{
                top:0px;
                left:0px;
                background-color:blue;
            }
        }
    </style>
</head>
<body>
    <div id="test"></div>
</body>
</html>