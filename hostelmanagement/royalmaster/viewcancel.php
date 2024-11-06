<?php require('../config/autoload.php'); 
include("dbcon.php");
?>

<?php include("header.php");	?>

<?php
$dao=new DataAccess();

   $name=$_SESSION['email'] ;
 if(isset($_POST["payment"]))
{
    
    echo"<script> location.replace('payments.php'); </script>";
}
   if(isset($_POST["purchase"]))
{
     header('location:displaycategory.php');
}
if(isset($_SESSION['email']))
   {
	  
	   $sql = "select sum(total)as t from booking where status=1 and  uemail='$name'";
$result = $conn->query($sql);
	   $row = $result->fetch_assoc();
	   $total=$row["t"];
	   
	   $_SESSION['amount']=$total; 
	   
	    ?>
       
       
       
       
 <div class="container_gray_bg" id="home_feat_1">
    <div class="container">
    	<div class="row">
            <div class="col-md-12">
            
            <H1><center> CART DETAILS </center> </H1>
                <table  border="1" class="table" style="margin-top:100px;">
                    <tr>
                    <th>Sl No</th>
                        <th>Room No</th>
                        <th>Room Rate</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total</th>
                       
                        <th>CANCEL</th>
                     
                      
                    </tr>
<?php
    
    $actions=array(
    
    
    'delete'=>array('label'=>'Cancel','link'=>'cancelitem.php','params'=>array('id'=>'bid'),'attributes'=>array('class'=>'btn btn-success'))
    
    );

    $config=array(
        'srno'=>true,
        'hiddenfields'=>array('bid')
        
        
    );

   $condition="uemail='".$name."' and status=2";
   
   $join=array(
       
    );  
	$fields=array('bid','rno','rrate','fdate','tdate','total');

    $users=$dao->selectAsTable($fields,'booking as c',$condition,$join,$actions,$config);
    
    echo $users;
                                     
    ?>

             
                </table>
            </div>    


            <div class="row">
 <div class="col-md-3">
TOTAL AMOUNT:
<input type="text" class="form-control" value="<?php echo $total; ?>" readonly name="total"/>

</div>
<form action="" method="POST" enctype="multipart/form-data">


</form>
</div>

            
            
            
        </div><!-- End row -->
    </div><!-- End container -->
    </div><!-- End container_gray_bg -->

<?php } ?>