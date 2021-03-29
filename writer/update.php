<?php include('C:\xampp\htdocs\class12\class_files\crud.php') ?>
<?php

$con['id']=$_POST['id'];

if(isset($_POST['name'])){
	$data['name']=$_POST['name'];
	$data['dob']=$_POST['dob'];
	$data['dod']=$_POST['dod'];
}else{
	$data['status']=0;
}
$data['updated_at']=date('Y-m-d H:i:s');

$crud=new crud();
$rs=$crud->common_update('writer',$data,$con);
if($rs['success']==1)
	echo 'success';
else
	echo $rs['msg'];


?>