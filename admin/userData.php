<?php

require("../conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin Board</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../mdb/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../mdb/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../mdb/css/style.min.css" rel="stylesheet">
  <!-- MDBootstrap Datatables  -->
  <link href="../mdb/css/addons/datatables.min.css" rel="stylesheet">

  <style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
      bottom: .5em;
    }
  </style>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">
        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Links -->
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect">
        <img src="" class="img-fluid" alt="">
      </a>

      <div class="list-group list-group-flush">
        <!-- <a href="#" class="list-group-item active waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a> -->
        <a href="dashboard.php" class="list-group-item list-group-item-action  waves-effect">
          <i class="fas fa-user mr-3"></i>User</a>
        <a href="#" class="list-group-item list-group-item-action active waves-effect">
          <i class="fas fa-table mr-3"></i>Data</a>
        <button class="btn btn-dne waves-effect adminLogout" data-key="logout">
          <i class="fas fa-map mr-3"></i>Logout</button>

        <!-- <a href="#" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-map mr-3"></i>Maps</a>
        <a href="#" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-money-bill-alt mr-3"></i>Orders</a> -->
      </div>
    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
      <?php echo '<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image
            </th>
            <th class="th-sm">Lostee
            </th>
            <th class="th-sm">Founder Name
            </th>
            <th class="th-sm">Founder Number
            </th>
          </tr>
        </thead>
        <tbody>';

      $sql  = "SELECT i.image_of_item as image ,u.full_name as Lostee FROM user u INNER JOIN lost_and_found l on u.user_id = l.loser_id INNER JOIN items i on l.item_id = i.item_id";
      $query = mysqli_query($conn, $sql);
      $lostee = [];
      $dmmy = [];
      while ($row = mysqli_fetch_assoc($query)) {
        //   array_push($lostee,)
        $dmmy['image'] = $row["image"];
        $dmmy['lostee'] = $row["Lostee"];
        array_push($lostee, $dmmy);
        // echo '<tr>';
        // echo '<td>' . $row["image"] . '</td>';
        // echo '<td>' . $row["Lostee"] . '</td>';
        // echo '</tr>';
      }

      $sql  = "SELECT u.full_name as Founder , u.mobile_number as mobile_number FROM user u INNER JOIN lost_and_found l on u.user_id = l.founder_id";
      $query = mysqli_query($conn, $sql);
      $founder = [];
      $d = [];
      while ($row = mysqli_fetch_assoc($query)) {
        // echo '<tr>';
        $d['founder'] = $row["Founder"];
        $d['mob'] = $row["mobile_number"];
        array_push($founder, $d);
        // echo '<td>' . $row["Founder"] . '</td>';
        // echo '<td>' . $row["mobile_number"] . '</td>';
        // echo '</tr>';

      }
      $var = count($lostee);
      //   while($var!=0){
      //     //   echo '<tr>';
      //     // echo '<td>' . $row["image"] . '</td>';
      //     // echo '<td>' . $row["Lostee"] . '</td>';
      //     // echo '</tr>';
      //     echo "here";
      //     print_r( $lostee);
      //     $var-=1;
      //   }

      for ($i = 0; $i < $var; $i++) {
        // echo $i;
        echo '<tr>';
        echo '<td><img src=../images/found_uploaded/' . $lostee[$i]["image"] . ' style="width:50px;height:50px;border-radius:50%;"></td>';
        echo '<td>' . $lostee[$i]["lostee"] . '</td>';
        echo '<td>' . $founder[$i]["founder"] . '</td>';
        echo '<td>' . $founder[$i]["mob"] . '</td>';
        echo '</tr>';
      }


      echo '</tbody>
      </table>';
      ?>

    </div>
  </main>
  <!--Main layout-->




  <!-- SCRIPTS -->
  <!-- JQuery -->
  <!-- <script type="text/javascript" src="../mdb/js/jquery-3.4.1.min.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../mdb/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../mdb/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../mdb/js/mdb.min.js"></script>

  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="../mdb/js/addons/datatables.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

  <script>
    $(document).ready(function() {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });

    $(".adminLogout").click(function(e) {
      e.preventDefault();

      let simply = $(this).data("key");
      let data = {
        "saa": "man"
      }

      $.ajax({
        type: "POST",
        data: data,
        url: "../response/logoutResponse.php",
        success: function(response) {
          if (response) {
            console.log(response);
            window.location.href = "../index.php";
          }
        }
      });
    });

    // $(".btnClass").click(function(e) {

    //   e.preventDefault();
    //   let user_id = $(this).data('key');
    //   let data = {
    //     user_id: user_id
    //   }

    //   $.ajax({
    //     type: "POST",
    //     data: data,
    //     url: "../response/deleteFromAdmin.php",
    //     success: function(response) {
    //       if (response) {
    //         console.log(response);
    //         alert("Successfully deleted");

    //         window.location.reload();
    //       }
    //     }
    //   });
    // });
  </script>
</body>

</html>