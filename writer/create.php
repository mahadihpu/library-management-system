<?php include('C:\xampp\htdocs\class12\class_files\crud.php') ?>
<?php

$data['name']=$_POST['name'];
$data['dob']=$_POST['dob'];
$data['dod']=$_POST['dod'];
$data['status']=1;
$data['created_at']=date('Y-m-d H:i:s');
$data['updated_at']=date('Y-m-d H:i:s');

$crud=new crud();
$rs=$crud->common_insert('writer',$data);
if($rs['success']==1)
	echo 'success';
else
	echo $rs['msg'];


?>