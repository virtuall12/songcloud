<?php
    include('dbcon.php');
    include('check.php');

    if(is_login()){

        if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin']==1)
            header("Location: admin.php");
        else
            header("Location: welcome.php");
    }
?>
<?php

    include('head.php');

?>
<!DOCTYPE html>
<html>
<head>
        <title>login</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>


<body style="background-color:#3399FF">

<div class="container">
        <center>
        <h2 align="center">Login</h2><hr>
        <form class="form-horizontal" method="POST">
                <div class="form-group" style="padding: 10px 10px 10px 10px;">
                        <label for="user_name">ID</label>
                        <input type="text" name="user_name"  class="form-control" style="width:200px;" id="inputID" placeholder="input your ID"
                                required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
                </div>
                <div class="form-group" style="padding: 10px 10px 10px 10px;">
                        <label for="user_password">Password</label>
                        <input type="password" name="user_password" class="form-control" style="width:200px;" id="inputPassword" placeholder="input your PassWord"
                                required  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
                </div>
                <div class="checkbox">
                        <label><input type="checkbox"> Remember ID</label>
                </div>
                </br>
                <div class="form-group" style="padding: 10px 10px 10px 10px;">
                        <button type="submit" name="login" href="index.php"style="background-color:#3366FF" class="btn btn-success">login</button>
                        <a class="btn btn-success" href="registration.php" style="margin-left: 50px">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Account
                        </a>
                </div>
                </br>
        </form>
</div>
</center>
</body>
</html>


<?php

    $login_ok = false;

    if ( ($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['login']) )
    {
                $username=$_POST['user_name'];
                $userpassowrd=$_POST['user_password'];

                if(empty($username)){
                        $errMSG = "아이디를 입력하세요.";
                }else if(empty($userpassowrd)){
                        $errMSG = "패스워드를 입력하세요.";
                }else{


                        try {

                                $stmt = $con->prepare('select * from users where username=:username');

                                $stmt->bindParam(':username', $username);
                                $stmt->execute();

                        } catch(PDOException $e) {
                                die("Database error. " . $e->getMessage());
                        }

                        $row = $stmt->fetch();
                        $salt = $row['salt'];
                        $password = $row['password'];

                        $decrypted_password = decrypt(base64_decode($password), $salt);

                        if ( $userpassowrd == $decrypted_password) {
                                $login_ok = true;
                        }
                }


                if(isset($errMSG))
                        echo "<script>alert('$errMSG')</script>";


        if ($login_ok){

            if ($row['activate']==0)
                                echo "<script>alert('$username 계정 활성이 안되었습니다. 관리자에게 문의하세요.')</script>";
            else{
                                        session_regenerate_id();
                                        $_SESSION['user_id'] = $username;
                                        $_SESSION['is_admin'] = $row['is_admin'];

                                        if ($username=='admin' && $row['is_admin']==1 )
                                                header('location:admin_index.php');
                                        else
                                                header('location:index.php');
                                        session_write_close();
                        }
                }
                else{
                        echo "<script>alert('$username 인증 오류')</script>";
                }
        }
?>