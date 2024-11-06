

<?php	
include("dbcon.php");
$bid = $_GET['id'];
$sql = "update room set status=2 where  rid=".$bid;

$conn->query($sql);

 header('location:viewroomimage.php');



?>

