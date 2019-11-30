<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h2>What have you Lost?</h2>
      <nav class="navbar navbar-light bg-light">
       <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" type="search" name = "searchid" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name = "serachbtn">Search</button>
       </form>
     </nav>

     <?php
          require('conn.php');
          if(isset($_POST['serachbtn']))
          {
            
            $name = $_POST['searchid'];
            echo $name;
            $sql = "SELECT description_about_item,place_of_found FROM items WHERE description_about_item ='".$name."'";
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
              while($row = $result->fetch_assoc())
              {
                echo "<table border = 1>";
                echo "<tr><th>Item</th><th>Item PLace</th></tr>";
                echo "<tr><td>".$row['description_about_item']."</td><td>".$row['place_of_found']."</td></tr>";
              
              }
              
            }
            else
            {
              echo "<script> alert('search not found')</script>";
            }
          }
          


     ?>

    </div>
  </body>
</html>
