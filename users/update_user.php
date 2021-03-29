<?php include('C:\xampp\htdocs\class11\class_files\crud.php') ?>
<?php

$con['id']=$_POST['id'];

if(isset($_POST['status']))
	$data['active_status']=$_POST['status'];
else
	$data['status']=0;

$crud=new crud();
$rs=$crud->common_update('user',$data,$con);
if($rs['success']==1)
	echo 'success';
else
	echo "error";


?>