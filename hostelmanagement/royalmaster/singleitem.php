<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta http-equiv="X-UA-Compatible">
    <title>Document</title>
    <link rel="stylesheet" href="ui.css">
    
    <script>
function showtotal() {
//alert(str);
	  var price=document.getElementById("price").value;  
	   var qty=document.getElementById("qty").value; 
	   var total=price*qty; 
	   //alert(total);
	   document.getElementById("total").value = total;
}
</script>
    
</head>

<body>

<?php include("userheader.php");	
include("dbcon.php");

?>

<?php require('../config/autoload.php'); 

$iid = "";
$iname = "";
$name="";
$dao=new DataAccess();
?>



<?php
if(isset($_POST["btn_insert"]))
{
if(!isset($_SESSION['email']))
   {
	   header('location:login.php');
  }
  else
  {
$name=$_SESSION['uemail'];
$rid = $_GET['rid'];
$q10="select * from room where rid=".$rid ;
$info121=$dao->query($q10);
$rfloor=$info1[0]["rfloor"];$rfloor = $rfloor;
$rno = $_POST["rno"];
$rrate = $_POST["rrate"];

$q1="select * from room where rid=".$rid ;


$bdate=date('Y-m-d',time());
$sql = "INSERT INTO booking('uid',rid,rno,rfloor,rrate,rtype,bdate,status) VALUES ('$uid' ,'$rid','$rno ','$rfloor','$rrate','$rtype','$bdate','$status')";

$conn->query($sql);
 header('location:viewcart.php');
}

{
echo "<script> alert('not suffient stock'); </script>";
}
}

?>


<?php
$dao=new DataAccess();
?>

<?php	$rid=$_GET['rid']; 



			 $q="select * from room where rid=".$id ;

$info=$dao->query($q);
$rno=$info[0]["rno"];
?>
 
   

<form action="" method="POST" enctype="multipart/form-data">

 <div class="upper">
        <div class="upper-left">
<?php 
if(isset($_SESSION['email']))
{ 
   $name=$_SESSION['email'];
?>

 <h7 class="title-w3-agileits title-black-wthree"><?php  echo $name ?></h7>

<?php } ?>
            <h3>Product Details</h3>
            <img style="width:300; height:300" src=<?php echo BASE_URL."uploads/".$info[0]["itimage"]; ?> alt=" " class="img-responsive" />
        </div>
        <div class="content">
            <h3>Details</h3>
            <div style="display: block;">
                <label for="name">Item Name:</label><br>
                
                <label for="name"><?php echo $info[0]["itnme"]; ?></label><br>
                 <label for="roomno">Room No:</label><br>
                <input id="roomno" name="offerprice" type="text" value="<?php echo $info[0]["offerprice"];  ?>" readonly style="margin-top: 8px;"><br>
                <label for=roomfloor">Room Floor:</label><br>
                <input id="roomfloor" name=roomfloor" type="text" onkeyup="showtotal()" style="margin-top: 8px;"><br>
                <label for="roomrate">Room Rate</label><br>
                <input id="roomrate" name="roomrate" type="text" readonly style="margin-top: 8px;"><br>
               
            </div>
        </div>
    </div>
    <div class="lower">
        <div class="btn-grp">
                <button class="buttons" name="btn_insert" id="btn-1">Book Now</button>
          
        </div>
    </div>
    </form>
</body>

</html>