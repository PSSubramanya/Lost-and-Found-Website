<?php 
    require("../conn.php");
    $user_id =  $_POST['user_id'];
    
    $sql = "DELETE FROM user WHERE user_id = $user_id";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo true;
    }

?>