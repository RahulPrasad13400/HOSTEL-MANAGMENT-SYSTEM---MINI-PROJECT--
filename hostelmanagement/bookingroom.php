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

<?php include("header.php");	
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

	   
$email=$_SESSION['email'];
$drid = $_GET['id'];
$q1="select * from doctor where drid=".$drid ;

$info1=$dao->query($q1);
$drname=$info1[0]["drname"];
$drname = $drname;
$fees = $_POST["fees"];
$adate = $_POST["adate"];

$time = $_POST["time"];
$status=1;
$date1=date('Y-m-d',time());
$sql = "INSERT INTO booking(uname,adate,drid,fees,drname,cdate,ctime,status) VALUES ('$email','$adate' ,'$drid','$fees','$drname','$date1','$time',$status')";


$conn->query($sql);
echo $sql;
 //header('location:view.php');
}



?>


<?php
$dao=new DataAccess();
?>

<?php	$id=$_GET['id']; 



			 $q="select * from doctor where drid=".$id ;

$info=$dao->query($q);
$drname=$info[0]["drname"];
?>
 
   

<form action="" method="POST" enctype="multipart/form-data">

 <div class="upper">
        <div class="upper-left">
<?php 
if(isset($_SESSION['email']))
{ 
   $pname=$_SESSION['emailid'];
?>

 <h7 class="title-w3-agileits title-black-wthree"><?php  echo $pname ?></h7>

<?php } ?>
            <h3>doctor</h3>
            <img style="width:300; height:300" src=<?php echo BASE_URL."uploads/".$info[0]["drimage"]; ?> alt=" " class="img-responsive" />
        </div>
        <div class="content">
            <h3>Details</h3>
            <div style="display: block;">
                <label for="name">Doctor Name:</label><br>
                <label for="name"><?php echo $info[0]["drname"]; ?></label><br>

           

                 <label for="fees">Fees:</label><br>
                <input id="pname" name="fees" type="text" value="<?php echo $info[0]["fees"];  ?>" readonly style="margin-top: 8px;"><br>

                <label for="adate">Appointment Date:</label><br>
                <input id="adate" name="adate" type="date" style="margin-top: 8px;"><br>
                <label for="time">Appointment time:</label><br>
                <input id="time" name="time" type="text" style="margin-top: 8px;"><br>
                
            </div>
        </div>
    </div>
    <div class="lower">
        <div class="btn-grp">
                <button class="buttons" name="btn_insert" id="btn-1">submit</button>
          
        </div>
    </div>
    </form>
</body>

</html>