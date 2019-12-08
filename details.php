<?php
require('conn.php');
$data = $_GET['key'];
session_start();
$data1 = mysqli_escape_string($conn, $data);

$query = 'SELECT * FROM items WHERE item_id = ' . $data . '';
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $founder_id =  $row['founder_id'];
    $found_place = $row['place_of_found'];
    $image =  $row['image_of_item'];
    $description = $row["description_about_item"];
    $query = 'SELECT * FROM user WHERE user_id = ' . $founder_id . '';
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $founder_mobile = $row['mobile_number'];
        $founder_name  = $row['full_name'];
    }
    $a = [];
    array_push($a, $founder_id);
    array_push($a, $data);
    array_push($a, $_SESSION['user_id']);
    $re = json_encode($a);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark primary-color">
        <a class="navbar-brand" href="index.php">
            <!-- <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="mdb logo"> -->
            <!-- <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAADICAMAAAA9W+hXAAAAA1BMVEUNR6GxS+Q1AAAANElEQVR4nO3BMQEAAADCoPVP7WsIoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAeAN1+AABVhDU2QAAAABJRU5ErkJggg==" height="30" alt="mdb logo"> -->
 
        </a>
    </nav><br><br>
    <!-- Table with panel -->
    <div class="container" style="padding:50px;">
        <?php
        echo '
        <div class="card card-cascade narrower">
        <!--Card image-->
        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mb-3 d-flex justify-content-between align-items-center">

            <div>
               
            </div>

            <a href="" class="white-text mx-3">Lost Description</a>

            <div>
                
            </div>

        </div>
        <!--/Card image-->
        <div class="px-4">
            <div class="table-wrapper">
                <!--Table-->
                <table class="table table-hover mb-0">
                    <!--Table head-->
                    <thead>
                        <tr>
                        <th class="th-lg">
                        <a>Image
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>
                            <th class="th-lg">
                                <a>Description
                                    <i class="fas fa-sort ml-1"></i>
                                </a>
                            </th>
                            <th class="th-lg">
                                <a href="">Found at
                                    <i class="fas fa-sort ml-1"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                    <tr>
                    <td>
                            <img src = "images/found_uploaded/' . $image . '" width=50px></td>
                            <td>' . $description . '</td>
                            <td>' . $found_place . '</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
        </div>
        ';
        ?>

    </div><br><br>

    <!-- <div class="container" style="padding:50px;"> -->
    <?php
    echo '
        <div class="card card-cascade narrower">
        <!--Card image-->
        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mb-3 d-flex justify-content-between align-items-center">

            <div>
                
            </div>

            <a href="" class="white-text mx-3">Founders Description</a>

            <div>
               
            </div>

        </div>
        <!--/Card image-->
        <div class="px-4">
            <div class="table-wrapper">
                <!--Table-->
                <table class="table table-hover mb-0">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th class="th-lg">
                                <a>Name
                                    <i class="fas fa-sort ml-1"></i>
                                </a>
                            </th>
                            <th class="th-lg">
                                <a href="">Contact Information
                                    <i class="fas fa-sort ml-1"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                    <tr>
                        <td>' . $founder_name . '</td>
                        <td>' . $founder_mobile . '</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';
    ?>

    <!-- </div> -->


    </div><br>

    <div class="container" style="margin-left:40%;">
        <?php echo "<button type='submit' class='btn btn-success confirm' data-key='$re'>Confirm </button>"; ?>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="mdb/js/addons/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.confirm').click(function(e) {
                e.preventDefault();
                let key = $(this).data('key');
                var decode = JSON.stringify(key);
                let data = {
                    "founder_id": key[0],
                    "item_id": key[1],
                    "lost_id": key[2]
                }

                $.ajax({
                    type: "POST",
                    data: data,
                    url: "response/confirm.php",
                    success: function(response) {
                        console.log(response);
                        alert("confirmed");
                        window.location.href = "index.php";
                    }
                });
            });
        });
    </script>
</body>

</html>