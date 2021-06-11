<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<meta charset="UTF-8">
<body style="background-color:#3399FF" font-color:"white" >
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
<?php
$con = mysqli_connect("192.168.1.200","root","test123","project3");  // 마리아db 연결

// POST로 받은 값 불러오기
$userid = $_POST['userid'];
$CPU = $_POST['CPU'];
$DISK = $_POST['DISK'];
$createvm = $_POST['createvm'];
$mdate = date("Y-m-j");
$rep = $_POST['createvm'];
$port = rand(30001, 31000);

// DB에 생성 값 입력
$sql = "INSERT INTO hosttbl VALUES('$userid','$CPU','$DISK','$createvm','$mdate')";
$ret = mysqli_query($con,$sql);
if($ret){
                echo " db 입력 완료 ";
}
else
{
     $str = "신청이 잘못 되었습니다.";
     echo  "$str<br>";
                        echo mysqli_error($con);
}
mysqli_close($con);
shell_exec(sprintf( 'sudo /var/www/html/projectpage/test2.sh "%s" "%s" "%s"', $userid, $rep, $port ));

echo "<br> 접속주소는 <br> 10.10.51.102:$port <br> 10.10.51.103:$port <br> 입니다."


?>
<br>
<br>
<div class="large"><a href="index.php">메인으로 돌아가기</a></div>

</center>
</body>
</head>
</html>