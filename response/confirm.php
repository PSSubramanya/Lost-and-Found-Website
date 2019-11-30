<?php 
require("../conn.php");    
$founder_id = $_POST['founder_id'];
$lost_id = $_POST['lost_id'];
$item_id = $_POST['item_id'];
$query = "INSERT INTO `lost_and_found`(loser_id,founder_id,item_id) VALUES('$lost_id','$founder_id','$item_id')";
$res = mysqli_query($conn,$query);
$updateQuery = "UPDATE  `items` SET status = 'CONFIRMED' WHERE item_id = '$item_id'";
$res = mysqli_query($conn,$updateQuery);
if($res){
    echo $res;
}

?>