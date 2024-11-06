

<?php	
include("dbcon.php");
$bid = $_GET['id'];
$sql = "update roomtype set status=2 where  tid=".$bid;

$conn->query($sql);

 header('location:viewtype.php');



?>

