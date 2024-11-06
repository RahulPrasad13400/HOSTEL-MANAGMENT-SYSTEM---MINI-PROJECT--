

<?php	
include("dbcon.php");
$bid = $_GET['id'];
$sql = "delete from booking where  bid=".$bid;

$conn->query($sql);

 header('location:viewbooking.php');



?>

