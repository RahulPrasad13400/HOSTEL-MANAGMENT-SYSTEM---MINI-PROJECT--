<?php 

 require('../config/autoload.php'); 
include("oghead.php");

$dao=new DataAccess();
$file=new FileUpload();
$info=$dao->getData('*','roomtype','tid='.$_GET['id']);

$elements=array(
        "tname"=>$info[0]['tname']);




$form=new FormAssist($elements,$_POST);




$labels=array('tname'=>"type name" );

$rules=array(
    "tname"=>array("required"=>true,"minlength"=>2,"maxlength"=>30,"alphaspaceonly"=>true),
   
     
);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	

		
$data=array(

        'tname'=>$_POST['tname'],
      
    );
    $condition='tid='.$_GET['id'];
    if($dao->update($data,"roomtype",$condition))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:type.php');
    }
    else
        {$msg="Registration failed";} ?>

<span style="color:red;"><?php  ?></span>

<?php
    
}

}




?>
<html>
<head>
</head>
<body>

 <form action="" method="POST" enctype="multipart/form-data">
 


<div class="row">
                    <div class="col-md-6">
Type name:

<?= $form->textBox('tname',array('class'=>'form-control')); ?>
<?= $validator->error('tname'); ?>

</div>
</div>



<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


