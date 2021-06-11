<?php

    include('dbcon.php');
    include('check.php');

    if (is_login()){

        unset($_SESSION['user_id']);
        session_destroy();
    }

    header("Location: index.php");
?>
root@master-virtual-machine:/var/www/html/projectpage# cat nginx_maria.php
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Create Instance</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Nginx + MariaDB</h3></div>
                                    <div class="card-body">
                                    <br>
<br>
<br>
<br>

                                    <center><img src="mariaDB.png" width="350" height="130"></center>
                                       <br>
                                       <br>
                                         <form method="post" action="insert_result2.php" >
                                        <center>
<button type="submit" name="submit"  class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;SUBMIT</button>
              <form method="post" action="insert_result2.php" >
                <span><input type="hidden" name="userid" value="cactus"><br><br></span>
                <span><input type="hidden" name="CPU" value="1"><br><br></span>
                <span><input type="hidden" name="DISK" value="1"><br><br></span>
                <span><input type="hidden" name="createvm" value="1"><br><br></span>
                 <span><input type="hidden" name="mdate" value="1"><br><br></span>

        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
