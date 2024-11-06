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
const diffDays=2;
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
session_start();
if(isset($_SESSION['email']))
{ 
include("headerlogout.php");
}
else
{
	include("header.php");
}?>

<?php 	
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
	//   header('location:login1.php');
	echo"<script >location.href = 'login1.php'</script>";

  }
  else
  {
$name=$_SESSION['email'];
$itid = $_GET['id'];
 $q1="select * from subcat where room_id=".$itid ;

$info1=$dao->query($q1);
$iname=$info1[0]["room_no"];
$itemname = $iname;
$fees = $info1[0]["fees"];;
$advance = $_POST["advance"];
$_SESSION['advance']=$advance;	  
$status=1;
$date1=date('Y-m-d',time());
$datefrom = $_POST["datefrom"];
$todate = $_POST["todate"];
$balance=$_POST["balance"];	
$diffDays=$_POST["days"];	  
$_SESSION['days']=$diffDays;
 
$total=$_POST["total"]	  ;
	  
	  
	  
	  $sql1=(" select b.room_id from cart as b where (('$fromdate' between datefrom and todate)or('$fromdate' <= datefrom))and(('$todate' between datefrom and todate)or('$todate' >=todate))");
	  echo($sql1);
	$info=$dao->query($sql1);
	  //print_r($info);
	  ///$value="";
	  $i=0;
			 while($i<count($info))
			
			 	{
			 $value=$info[$i]["room_id"];
				 echo($value);
			 }
	  
	  
	  

$sql = "INSERT INTO cart(userid,room_id,room_no,fees,advance,status,date,datefrom,todate,days,total,balance) VALUES ('$name','$itid','$itemname','$fees','$advance','$status','$date1','$datefrom','$todate','$diffDays','$total','$balance')";

$conn->query($sql);
	  
	  
	// echo $sql;
 //header('location:viewcart.php');
echo"<script >location.href = 'payments.php'</script>";
}}

?>


<?php
$dao=new DataAccess();
?>

<?php	$iid=$_GET['id']; 

 $fromdate=$_SESSION['fdate'];
$todate=$_SESSION['todate'];

			 $q="select * from subcat where room_id=".$iid ;

$info=$dao->query($q);
$iname=$info[0]["room_no"];
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
            <h3>ROOM Details</h3>
            <img style="width:300; height:300" src=<?php echo BASE_URL."upload/".$info[0]["simage"]; ?> alt=" " class="img-responsive" />
        </div>
	  <div class="upper-right">
        <div class="content">
            <h3>Details</h3>
            <div style="display: block;">
                <label for="name"><u>ROOM NO:</u></label>
                
                <label for="name"><?php echo $info[0]["room_no"]; ?></label><br>
                  <label for="name"><u>RENT PER DAY:</u></label>
                
                <label for="name"><?php echo $info[0]["fees"]; ?></label><br>
                 <label for="fees">PRICE:</label><br>
                <input id="fees" name="fees" type="text" value="<?php echo $info[0]["fees"];  ?>" readonly style="margin-top: 8px;"><br>
                   
                 
				<label for="fromdate">From date:</label><br>
				
                <input id="fromdate" name="fromdate" type="text" value="<?php echo $fromdate ;?>"   style="margin-top: 8px;"><br>
                <label for="todate">To Date:</label><br>
                <input id="todate" name="todate" type="text" value="<?php echo $todate; ?>" <input id="days" name="days" type="hidden" readonly style="margin-top: 8px;"><br>
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
<?php include("footer.php");?>
</html>