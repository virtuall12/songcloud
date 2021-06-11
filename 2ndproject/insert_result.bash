<!DOCTYPE html>
<html>
<body>
<?php
$con = mysqli_connect("192.168.1.128","root","root","test");  // 마리아db 연결

// POST로 받은 값 불러오기
$userid = $_POST['userid'];
$cpu = $_POST['CPU'];
$disk = $_POST['DISK'];
$createvm = $_POST['createvm'];
$mdate = date("Y-m-j");

// DB에 생성 값 입력
$sql = "INSERT INTO hosttbl VALUES('$userid','$cpu','$disk','$createvm','$mdate')";
$ret = mysqli_query($con,$sql);
if($ret){
                echo " db 입력 완료 ";
}
else
{
     echo " 신청이 잘못 되었습니다. <br>";
                        echo mysqli_error($con);
}
mysqli_close($con);


// kvm1 cpurate 불러오기
$kvm1_num=system("mysql test -h 192.168.1.128 -u root -proot -e 'select * from vmtbl' | grep kvm1 | cut -c 6-");

// kvm2 cpurate 불러오기
$kvm2_num=system("mysql test -h 192.168.1.128 -u root -proot -e 'select * from vmtbl' | grep kvm2 | cut -c 6-");


// 인스턴스 생성
if ( $kvm1_num <= $kvm2_num ){
$connection = ssh2_connect('192.168.1.2', 22);
ssh2_auth_password($connection, 'root', 'root');
for ( $i=1 ; $i <= $createvm ; $i++ ) {
if ( $i == 1 ) {
ssh2_exec ($connection, sprintf('sudo /var/www/html/project2/boot/create_instance2.sh "%s" "%s" "%s" "%s"' , $disk, $userid, $cpu, $i));
}
elseif ( $i == $createvm ) {
ssh2_exec ($connection, sprintf('sudo /var/www/html/project2/boot/create_instance2-2.sh "%s" "%s" "%s" "%s"', $disk, $userid, $cpu, $i));
}
else{

ssh2_exec ($connection, sprintf('sudo /var/www/html/project2/boot/create_instance2-1.sh "%s" "%s" "%s" "%s"', $disk, $userid, $cpu, $i));
}
}
echo "Installing on kvm1.. Wait for a minute.";
}


if ( $kvm1_num > $kvm2_num ) {
$connection2 = ssh2_connect('192.168.1.3', 22);
ssh2_auth_password($connection2, 'root', 'root');
for ( $i=1 ; $i <= $createvm ; $i++ ) {
if ( $i == 1 ) {
ssh2_exec ($connection2, sprintf('sudo /var/www/html/project2/boot/create_instance2.sh "%s" "%s" "%s" "%s"' , $disk, $userid, $cpu, $i));
}
elseif ( $i == $createvm ) {
ssh2_exec ($connection2, sprintf('sudo /var/www/html/project2/boot/create_instance2-2.sh "%s" "%s" "%s" "%s"', $disk, $userid, $cpu, $i));
}
else {

ssh2_exec ($connection2, sprintf('sudo /var/www/html/project2/boot/create_instance2-1.sh "%s" "%s" "%s" "%s"', $disk, $userid, $cpu, $i));
}
}
echo "Installing on kvm2.. Wait for a minute.";
}

?>
</body>
</html>
