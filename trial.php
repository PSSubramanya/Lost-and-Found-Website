<?php
require('conn.php');
session_start();
// $data = $_POST['key'];
// echo $data;
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

<body>
  <!-- <div class="container"> -->
  <!-- Just an image -->
  <nav class="navbar navbar-dark primary-color">
    <a class="navbar-brand" href="#">
      <!-- <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="mdb logo"> -->
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
  <!-- <nav class="navbar navbar-light bg-light">
      <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" type="search" name="searchid" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="serachbtn">Search</button>
      </form>
    </nav> -->

  <!-- <nav class="navbar navbar-dark default-color">
        <form class="form-inline" method="post">
          <input class="form-control mr-sm-2" type="search" name="searchid" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="serachbtn">Search</button>
        </form>
      </nav> -->
  <div class="container">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">';
      <thead>
        <tr>
          <th class="th-sm">Serial No
          </th>
          <th class="th-sm">Description
          </th>
          <th class="th-sm">Image
          </th>
          <th class="th-sm">Claim
          </th>
        </tr>
      </thead>
      <tbody>
        <?php

        // if(isset($_POST['serachbtn']))
        // {
        //   $name = $_POST['searchid'];
        //   echo $name;
        $sql = "SELECT * FROM items where NOT status = 'CONFIRMED'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

          $i = 0;
          while ($row = $result->fetch_assoc()) {
            $key = $row['item_id'];
            // echo "<tr><td>".$row['description_about_item']."</td><td>".$row['place_of_found']."</td></tr>";
            echo '<tr>';
            echo '<td>' . ($i + 1) . "</td>";
            echo '<td>' . $row["description_about_item"] . '</td>';
            if ($row['image_of_item'] == "") {
              echo '<td></td>';
            } else {
              echo '<td><img src = "images/found_uploaded/' . $row['image_of_item'] . '" width=50px></td>';
            }
            // echo'<td>'.$row['place_of_found'].'</td>';                
            echo "<td><button type='submit' class='btn btn-success claim' data-key=$key>Claim</button></td>";
            echo '</tr>';
            $i += 1;
          }
          // '.$row['image_of_item'].'
        }

        ?>
    </table>
    </tbody>
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
      $("#dtBasicExample").DataTable();
      $(".dataTables_length").addClass("bs-select");
    });
  </script>
  <script>
    $(document).ready(function() {
      $('.claim').click(function(e) {
        e.preventDefault();

        let key = $(this).data('key');
        console.log("booo = " + key);
        let data = {
          'key': key
        }
        $.ajax({
          type: 'POST',
          data: data,
          url: "response/trialResponse.php",
          success: function(data) {
            if (data) {
              window.location.href = "details.php?key=" + data;
            } else {
              console.log("no data");
            }
          }
        });
      });
    });
  </script>
</body>

</html>