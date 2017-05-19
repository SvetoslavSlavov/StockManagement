<?php

require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
    header('location: http://localhost:8012/stock_system/dashboard.php');
}

$errors = array();

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        if ($username == "") {
            $errors[] = "Username is required";
        }

        if ($password == "") {
            $errors[] = "Password is required";
        }
    }else {
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $connect->query($sql);

            if ($result->num_rows == 1) {
                $password = md5($password);
                //exists
                $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                $mainResult = $connect->query($mainSql);

                if ($mainResult->num_rows == 1) {
                    $value = $mainResult->fetch_assoc();
                    $user_id = $value['user_id'];


                    //set session
                    $_SESSION['user_Id'] = $user_id;

                    header('location: http://localhost:8012/stock_system/dashboard.php');
                } else {
                    $errors[] = "incorrect username/password combination";
                }
            } else {
                $errors[] = "Username does not exists";
            } // else
        }// else not empty username //password
} //if $_POST
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Management System</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- bootstrap theme css -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css">
    <!-- custome css -->
    <link rel="stylesheet"href="custom/css/custom.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- jquery -->
    <script type="text/javascript"src="assets/jquery/jquery.min.js"></script>
    <!-- jqueryui -->
    <link rel="stylesheet" href="assets/jquery-ui/jquery-ui.min.css">
    <!-- jquertui js-->
    <script type="text/javascript" src="assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- bootstrap js-->
    <script type="text/javascript"src="assets/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
</head>
<body>
    <div class="container">
        <div class="row vertical">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

                        <div class="messages">
                            <?php if ($errors){
                                foreach ($errors as $key => $value){
                                    echo '<div class="alert alert-warning" role="alert">
                                        <i class="glyphicon glyphicon-exclamation-sign"></i>
                                        '.$value.'
                                    </div>';
                                }
                            }?>
                        </div>

                        <form class="form-horizontal"action="<?php echo $_SERVER['PHP_SELF']?>"method="POST"id="loginForm">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username"name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i>Sign in</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
