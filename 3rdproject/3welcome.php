<?php
    include('dbcon.php');
    include('check.php');

    if (is_login()){
        ;
    }else
        header("Location: index.php");

        include('head.php');
?>


<?php
        $user_id = $_SESSION['user_id'];

        try {
                $stmt = $con->prepare('select * from users where username=:username');
                $stmt->bindParam(':username', $user_id);
                $stmt->execute();

   } catch(PDOException $e) {
                die("Database error: " . $e->getMessage());
   }

   $row = $stmt->fetch();

   echo($row['regtime']);
?>

에 생성된

<?php echo $user_id; ?>로 로그인했습니다.
<div align="center">
<div class="container">
        <div class="page-header">
        <h1 class="h2">&nbsp;  <?php echo $user_id; ?> 회원님의 page</h1><hr>
        </div>
<div class="row">

    <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
        <thead>
        <tr>
              <th>회원님아이디</th>
              <th>CPU 갯수</th>
              <th>DISK </th>
              <th>VM 갯수</th>
              <th>생성날짜</th>
        </tr>
        </thead>
                <?php
                        $stmt = $con->prepare('select * from hosttbl where userid=:userid');
                        $stmt->bindParam (':userid', $user_id);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0)
                {
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                        {
                                extract($row);

                        if ($username != 'admin') {
                        ?>
                                <tr>
                                <td><?php echo $userid; ?></td>
                                <td><?php echo $CPU;    ?></td>
                                <td><?php echo $DISK;   ?></td>
                                <td><?php echo $createvm; ?></td>
                                <td><?php echo $mdate;  ?></td>
                                </tr>
                <?php
                                }
                        }
                }
                ?>
                </table>

</div>

</body>
</html>
