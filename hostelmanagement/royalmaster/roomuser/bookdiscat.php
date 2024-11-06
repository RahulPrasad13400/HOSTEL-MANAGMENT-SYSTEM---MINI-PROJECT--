<?php
session_start();

								
if(isset($_SESSION['email']))
{
	include("headerlogout.php");
}
else
{
	include("header.php");
}
		
?>



<?php require('../config/autoload.php'); ?>

<?php
$dao=new DataAccess();
?>
<?php    
if(isset($_SESSION['email']))
{ 	
   
$name=$_SESSION['email'];
?>
 <h7 class="title-w3-agileits title-black-wthree"><?php // echo $name ?></h7>

<?php } ?>
<h3 class="title-w3-agileits title-black-wthree">HOME</h3>
						<div class="priceing-table-main">
            <?php
			//echo "asdfasdf";
			 $q="select * from category";

$info=$dao->query($q);

			$i=0;          
			 while($i<count($info))
			
{ $s=$info[$i]["image"];
		?>		 <div class="col-md-3 price-grid">
					<div class="price-block agile">
						<div class="price-gd-top">
						<img style="width:300; height:300" src=<?php echo BASE_URL."upload/".$info[$i]["image"]; ?> alt=" " class="img-responsive" />
							<?php /*?> <h4>Deluxe Room</h4><?php */?>
                              <h4><?php echo $info[$i]["type_name"]?></h4> 
                             
						</div>
						<div class="price-gd-bottom">
							   <div class="price-list">
									
							</div>
							<div class="price-selet">
                            
			<a href="bookroom.php?id=<?= $info[$i]["type_id"]?>" >VIEW</a>
							</div>
						</div>
					</div>
				</div>
				<?php 
				$i++;
				} ?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	
	
		<?php include("footer.php");	?>
	
