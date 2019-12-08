<?php
session_start();
require("../conn.php");
?>

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
        <a href="#" class="list-group-item list-group-item-action active waves-effect">
          <i class="fas fa-user mr-3"></i>User</a>
        <a href="userData.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-table mr-3"></i>Data</a>
        <button class="btn btn-dne waves-effect adminLogout" data-key="logout">
          <i class="fas fa-map mr-3"></i>Logout</button>

        <!--<a href="#" class="list-group-item list-group-item-action waves-effect">
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
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Mobile Number
            </th>
            <th class="th-sm">Action
            </th>
          </tr>
        </thead>
        <tbody>';

      $sql  = "SELECT * FROM user";
      $query = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($query)) {
        echo '<tr>';
        echo '<td>' . $row["full_name"] . '</td>';
        echo '<td>' . $row["mobile_number"] . '</td>';
        echo '<td><button  class="btn btn-success btnClass" data-key =' . $row['user_id'] . ' >Delete</button></td>';
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

    $(".btnClass").click(function(e) {

      e.preventDefault();
      let user_id = $(this).data('key');
      let data = {
        user_id: user_id
      }

      $.ajax({
        type: "POST",
        data: data,
        url: "../response/deleteFromAdmin.php",
        success: function(response) {
          if (response) {
            console.log(response);
            alert("Successfully deleted");

            window.location.reload();
          }
        }
      });
    });


    $(".adminLogout").click(function(e){
      e.preventDefault();

      let simply = $(this).data("key");
      let data = {
        "saa":"man"
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
  </script>
</body>

</html>