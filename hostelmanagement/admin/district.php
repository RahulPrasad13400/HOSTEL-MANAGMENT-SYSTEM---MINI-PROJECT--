<?php 

 require('../config/autoload.php'); 
include("header.php");

$file=new FileUpload();
$elements=array(
        "distname"=>"");


$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('distname'=>"district name");

$rules=array(
    "distname"=>array("required"=>true,"minlength"=>3,"maxlength"=>30,"alphaonly"=>true)
    

     
);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	


$data=array(

       
        'distname'=>$_POST['distname'],

        
         
    );
  
    if($dao->insert($data,"district"))
    {
        echo "<script> alert('New record created successfully');</script> ";

    echo"  <script>  window.location.replace('district.php'); </script>";

//header('location:district.php');
    }
    else
        {echo "<script> alert('failed');</script> ";
} ?>


<?php
    
}
else
echo $file->errors();
}




?>
<html>
<head>
</head>
<body>

 <form action="" method="POST" enctype="multipart/form-data">

    <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Dashboard</h2>
                           </div>
                        </div>
                     </div> 

<div class="row">
                    <div class="col-md-12">
district name:

<?= $form->textBox('distname',array('class'=>'form-control')); ?>
<?= $validator->error('distname'); ?>

</div>
</div>

<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


