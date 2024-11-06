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
	  var fees=document.getElementById("fees").value;  
	  var advance=document.getElementById("advance").value; 
	  var datefrom=document.getElementById("datefrom").value;
	  var todate=document.getElementById("todate").value;
// 	  var balance=fees-advance; 
//	  var total=todate-datefrom;
	
	
	
	const date1 = new Date(datefrom);
const date2 = new Date(todate);
const diffTime = Math.abs(date2 - date1);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

var	tot= (fees*(diffDays+1));
	var b=tot-advance;
	
	  //alert(diffDays);
	document.getElementById("total").value = tot;
	document.getElementById("balance").value = b;
	document.getElementById("days").value = diffDays;
	
}
</script>
    
</head>

<body>

	<?php
//session_start();
require('../config/autoload.php'); 
if(isset($_SESSION['email']))
{ 
include("header.php");
}
else
{
	include("header.php");
}?>

<?php 	
include("dbcon.php");

?>

<?php 

$iid = "";
$iname = "";
$name="";
$dao=new DataAccess();
?>



<?php
if(isset($_POST["btn_insert"]))
{

   
$name=$_SESSION['email'];
$itid = $_GET['id'];
 $q1="select * from room where rid=".$itid ;

 $info=$dao->query($q1);
 //$uemail=$info1[0]["uemail"];
$rid=$info[0]["rid"];
$rno=$info[0]["rno"];

$rrate = $info[0]["rrate"];;
$advance = $_POST["advance"];
$_SESSION['advance']=$advance;	  
$status=1;
$date1=date('Y-m-d',time());
$fdate = $_POST["datefrom"];
$tdate = $_POST["todate"];
$balance=$_POST["balance"];	

 
$total=$_POST["total"];


$sql = "INSERT INTO booking(uemail,rid,rno,rrate,bdate,fdate,tdate,advance,total,balance) VALUES ('$name','$rid','$rno','$rrate','$date1','$fdate','$tdate','$advance','$total','$balance')";

$conn->query($sql);
	  
	  
	 echo $sql;
 //header('location:viewcart.php');
echo"<script >location.href = 'viewbooking.php'</script>";
}


?>


<?php
$dao=new DataAccess();
?>

<?php	$iid=$_GET['id']; 



			 $q="select * from room where rid=".$iid ;

$info=$dao->query($q);
$iname=$info[0]["rno"];
?>
 
   

<form action="" method="POST" enctype="multipart/form-data">

 <div class="upper">
        <div class="upper-left">
<?php 
if(isset($_SESSION['email']))
{ 
   $name=$_SESSION['email'];
?>

 
<?php } ?>
            <h3>ROOM DETAILS</h3>
            <img style="width:300; height:300" src=<?php echo BASE_URL."uploads/".$info[0]["rimage"]; ?> alt=" " class="img-responsive" />
        </div>
	  <div class="upper-right">
        <div class="content">
            <h3>Details</h3>
            <div style="display: block;">
                <label for="name"><u>ROOM NO:</u></label>
                
                <label for="name"><?php echo $info[0]["rno"]; ?></label><br>
                  <label for="name"><u>RENT PER DAY:</u></label>
                  <input id="fees" name="fees" type="text" value="<?php echo $info[0]["rrate"];  ?>" readonly style="margin-top: 8px;"><br>
				<label for="datefrom">FROM DATE:</label><br>
                <input id="datefrom" name="datefrom" type="date" min="<?php echo date("Y-m-d"); ?>" style="margin-top: 8px;"><br>
				<label for="todate">TO DATE:</label><br>
                <input id="todate" name="todate" type="date" min="<?php echo date("Y-m-d"); ?>"  style="margin-top: 8px;"><br>				
				 <input id="days" name="days" type="hidden" readonly style="margin-top: 8px;"><br>
				<label for="advance">ADVANCE:</label><br>
                <input id="advance" name="advance" type="text" onkeyup="showtotal()" style="margin-top: 8px;"><br>
				<label for="total">TOTAL:</label><br>
                <input id="total" name="total" type="text" readonly style="margin-top: 8px;"><br>
				 <label for="balance">BALANCE</label><br>
                <input id="balance" name="balance" type="text" readonly style="margin-top: 8px;"><br><br>
                
				
				
			</div>
            </div>
        </div>
   
         <div class="btn-grp">
			 <button class="buttons" name="btn_insert" id="btn-1">PROCEED</button>
               
					 </div>
        </div>
    </div>
    </form>
</body>

</html>