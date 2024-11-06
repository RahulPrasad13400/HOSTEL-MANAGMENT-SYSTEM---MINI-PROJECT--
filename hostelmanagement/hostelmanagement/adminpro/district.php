<?php 

 require('../config/autoload.php'); 
include("oghead.php");

$file=new FileUpload();
$elements=array(
        "tname"=>"");


$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('tname'=>"type name");

$rules=array(
    "tname"=>array("required"=>true,"minlength"=>1,"maxlength"=>30,"alphaspaceonly"=>true)
    

     
);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	


$data=array(

       
        'tname'=>$_POST['tname'],

        
         
    );
  
    if($dao->insert($data,"roomtype"))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:type.php');
    }
    else
        {$msg="Registration failed";} ?>

<span style="color:red;"><?php echo $msg; ?></span>

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

<div class="row">
                    <div class="col-md-6">
type name:

<?= $form->textBox('tname',array('class'=>'form-control')); ?>
<?= $validator->error('tname'); ?>

</div>
</div>

<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


