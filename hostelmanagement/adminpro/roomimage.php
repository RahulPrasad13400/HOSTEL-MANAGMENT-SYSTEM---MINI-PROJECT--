<?php 

 require('../config/autoload.php'); 
include("oghead.php");

$file=new FileUpload();
$elements=array(
        "rno"=>"","rfloor"=>"","rrate"=>"","rimage"=>"","tid"=>"" );


$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('rno'=>"room no","rfloor"=>"room floor","rrate"=>"room rate","rimage"=>"room Image","tid"=>"type id" );

$rules=array(
    "rno"=>array("required"=>true,"minlength"=>2,"maxlength"=>30,"integeronly"=>true,"unique"=>array("field"=>"rno","table"=>"room")),
    "rfloor"=>array("required"=>true,"minlength"=>1,"maxlength"=>5,"integeronly"=>true),
    "rrate"=>array("required"=>true,"minlength"=>1,"maxlength"=>5,"integeronly"=>true),
    "tid"=>array("required"=>true,"minlength"=>1,"maxlength"=>5,"integeronly"=>true),
        "rimage"=> array('filerequired'=>true)
     
);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	
if($fileName=$file->doUploadRandom($_FILES['rimage'],array('.jpg','.png','.jpeg'),100000,1,'../uploads'))
		{
$data=array(

        'rno'=>$_POST['rno'],
        'rfloor'=>$_POST['rfloor'],
        'rrate'=>$_POST['rrate'],
       'rimage'=>$fileName,
          'tid'=>$_POST['tid'],
        'status'=>1,
    );
  
    if($dao->insert($data,"room"))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:roomimage.php');
    }
    else
        {$msg="Registration failed";} ?>

<span style="color:red;"><?php  ?></span>

<?php
    
}
else
echo $file->errors();
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
Rno:

<?= $form->textBox('rno',array('class'=>'form-control')); ?>
<?= $validator->error('rno'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
rfloor:

<?= $form->textBox('rfloor',array('class'=>'form-control')); ?>
<?= $validator->error('rfloor'); ?>

</div>
</div>


<div class="row">
                    <div class="col-md-6">
rrate:

<?= $form->textBox('rrate',array('class'=>'form-control')); ?>
<?= $validator->error('rrate'); ?>

</div>
</div>


<div class="row">
                    <div class="col-md-6">       


rimage:

<?= $form->fileField('rimage',array('class'=>'form-control')); ?>
<span style="color:red;"><?= $validator->error('rimage'); ?></span>

</div>
</div>


<div class="row">
                    <div class="col-md-6">
tid:

<?php
     $options = $dao->createOptions('tname','tid',"roomtype");
     echo $form->dropDownList('tid',array('class'=>'form-control'),$options); ?>
<?= $validator->error('tid'); ?>

</div>
</div>
<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


