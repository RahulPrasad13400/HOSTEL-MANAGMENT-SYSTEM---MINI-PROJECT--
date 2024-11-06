<?php require('../config/autoload.php');
    include("header.php");	
    $dao=new DataAccess();
?>
			


<section class="accomodation_area section_gap">
            <div class="container">

            
          

                <div class="section_title text-center">
                    <h2 class="title_color">Special Accomodation</h2>
                    <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast,</p>
                </div>
               
                <div class="row mb_30">
                <?php
			    $q="select * from room";
                $info=$dao->query($q);

			$i=0;          
			 while($i<count($info))
			
{ $s=$info[$i]["rimage"];
	
		?>	
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img src=<?php echo BASE_URL."uploads/".$info[$i]["rimage"]; ?> alt="">
                                <a href="roombooking.php?id=<?= $info[$i]["rid"]?>" class="btn theme_btn button_hover">Book Now</a>

                               
                            </div>
                            <a href="#"><h4 class="sec_h4"> <?php echo $info[$i]["rno"]?></h4></a>
                            <h5><?php echo $info[$i]["rrate"]?><small>/Day</small></h5>
                           
                         
                        </div>
                    </div>
                    <?php 
				$i++;
				} ?>
                </div>

               
            </div>
        </section>