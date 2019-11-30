<?php
include('conn.php');
session_start();
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $password = md5($_POST['password']);
    $mobile_number = $_POST['mobile_number'];
    $query = "INSERT INTO user (`full_name`,`mobile_number`,`password`) VALUES('$fullname','$mobile_number','$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("user registerd successfully");</script>';
    } else {
        echo '<script>alert("Error while registering");</script>';
    }
}

if (isset($_POST['login'])) {
    $mobile_number = $_POST['mobile_number'];
    $password = md5($_POST['password']);

    // echo "$mobile_number" . $password;

    $query = "SELECT * FROM user WHERE mobile_number = '$mobile_number' AND password = '$password' ";
    $result = mysqli_query($conn, $query);

    // var_dump($result);

    // $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['mobile_number'] = $mobile_number;

        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['user_id'] = $row['user_id'];
        }

        echo '<script>alert("Logged In");</script>';
    } else {
        echo '<script>alert("Invalid Credentials");</script>';
    }
}

if (isset($_POST['submitinfo'])) {
    if (isset($_SESSION['mobile_number'])) {
        $what = $_POST['One'];
        $where = $_POST['Two'];
        $when = $_POST['Three'];
        // $time = $_POST['Four'];
        $file_name = $_FILES['myfile']['name'];

        if (isset($_FILES['myfile'])) {
            $file_name = $_FILES['myfile']['name'];
            // $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            // $file_type = $_FILES['myfile']['type'];

            move_uploaded_file($file_tmp, "images/found_uploaded/" . $file_name);
        }


       $user_id = $_SESSION['user_id'];
       echo $user_id;
        //  $query1 = "INSERT INTO items(`description_about_item`,`place_of_found`,`date`,`time_stamp`,'myfile') VALUES('$what','$where','$when','$time','$file_name')";
        $query1 = "INSERT INTO items(`description_about_item`,`place_of_found`,`time_stamp`,`image_of_item`,founder_id) VALUES('$what','$where','$when','$file_name','$user_id')";
        $result1 = mysqli_query($conn, $query1);

        if ($result1) {
            echo '<script>alert("Item added successfully");</script>';
            // header('location:index.php');
        } else {
            echo '<script>alert("Error while adding item");</script>';
        }
    } else {
        echo '<script>alert("Please Login to add item");</script>';
        // header('location:Found.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Found.css" />

    <!-- <style>
        body{
            background: url('bg_2.jpg');
            background-size: cover;
     }
     </style> -->
</head>

<body>
    <nav class="navbar navbar-dark primary-color">
        <a class="navbar-brand" href="index.php">
            <!-- <img src="https://mdbootstrap.com/F/logo/mdb-transparent.png" height="30" alt="mdb logo"> -->
        </a>
        <?php
        if (isset($_SESSION['mobile_number'])) {
            echo '
                <ul class="navbar-nav">
                <li class="nav-item active" style="list-style-type:none">
                    <a class="nav-link" href="logout.php" style="color:white;">logout
                    </a>
                </li>
            </ul>
                ';
        }else{
            echo '
            <ul class="navbar-nav">
            <li class="nav-item active style="list-style-type:none"
                <a class="nav-link" data-toggle="modal" data-target="#modalLRForm" style="color:white;">Login/Register
                </a>
            </li>
        </ul>
            ';
        }
        ?>

    </nav><br><br>
    <div class="container">
        <form method="post" action="Found.php" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Enter the details :</h2><br></br>
                    <h4>What ?
                        <div class="md-form">
                            <input type="text" id="form1" name="One" class="form-control" required>
                            <label for="form1">What have you found</label>
                        </div>
                    </h4>
                    <h4>Where ?
                        <div class="md-form">
                            <input type="text" id="form2" name="Two" class="form-control" required>
                            <label for="form2">Where have you found</label>
                        </div>
                    </h4>
                    <h4>When ?
                        <div class="md-form">
                            <input type="datetime-local" id="form3" name="Three" class="form-control" required>
                        </div>
                    </h4>
                    <!-- <h2>Time ?  <input type="text" name = "Four"></h2> -->
                    <h4>Image
                        <!-- <div class="upload-btn-wrapper"> -->
                        <!-- <button class="btn" name = "imgid">Upload</button> -->
                        <!-- </div> -->
                    </h4>
                    <input type="file" name="myfile" />
                    <button type="submit" class="btn btn-outline-info waves-effect" data-toggle="modal" data-target="#modalLRForm" name="submitinfo">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <!--Modal: Login / Register Form-->
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                                Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                                Register</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 7-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                            <!--Body-->
                            <form action="Found.php" method="post">
                                <div class="modal-body mb-1">
                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="text" id="modalLRInput10" class="form-control form-control-sm validate" name="mobile_number">
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Your Mobile NUmber</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="modalLRInput11" class="form-control form-control-sm validate" name="password">
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                                    </div>
                                    <div class="text-center mt-2">
                                        <button class="btn btn-warning" type="submit" name="login">Log in <i class="fas fa-sign-in ml-1"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/.Panel 7-->

                        <!--Panel 8-->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">

                            <!--Body-->
                            <form action="found.php" method="post">
                                <div class="modal-body">
                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input type="text" id="modalLRInput12" class="form-control form-control-sm validate" name="fullname">
                                        <label data-error="wrong" data-success="right" for="modalLRInput12">Full Name</label>
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="password" id="modalLRInput13" class="form-control form-control-sm validate" name="password">
                                        <label data-error="wrong" data-success="right" for="modalLRInput13">Your password</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <input type="text" id="modalLRInput14" class="form-control form-control-sm validate" name="mobile_number">
                                        <label data-error="wrong" data-success="right" for="modalLRInput14">Mobile Number</label>
                                    </div>

                                    <div class="text-center form-sm mt-2">
                                        <button class="btn btn-warning" type="submit" name="register">Sign up <i class="fas fa-sign-in ml-1"></i></button>
                                    </div>

                                </div>
                            </form>
                            <!--/.Panel 8-->
                        </div>

                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!--Modal: Login / Register Form-->


        <!-- </form> -->
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
        <!-- <script type="text/javascript" src="Found.js"></script> -->
</body>

</html>