<?php

class crud{
	private $host;
	private $user;
	private $password;
	private $database;
	private $mysqli;
	private $msg;
	
	function __construct(){
		$this->host='localhost';
		$this->user='root';
		$this->password='';
		$this->database='nhippdv67_project';
		
		$this->mysqli=new mysqli($this->host,$this->user,$this->password,$this->database);
	}
	
	public function common_insert($table,$data){
		$q="insert into $table set ";
		if(is_array($data)){
			foreach($data as $k=>$v){
				$q.=" $k='$v', ";
			}
			$q=rtrim($q,', ');
			$rs=$this->mysqli->query($q);
			if($rs)
				$this->msg=array('error'=>0,'success'=>1,'inserted_id'=>$this->mysqli->insert_id);
			else
				$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		}else{
			$this->msg=array('error'=>1,'success'=>0,'msg'=>'Data should be in array format');
		}
		return $this->msg;
	}
	
	public function common_select($table,$fields='*',$where=false,$order=false,$order_format="ASC"){
		$q="select $fields from $table";
		
		if($where && is_array($where)){
			$q.=" where ";
			foreach($where as $k=>$v){
				$q.=" $k='$v' and ";
			}
			$q=rtrim($q,' and ');
		}
		if($order){
			$q.=" order by $order $order_format";
		}
		
		$rs=$this->mysqli->query($q);
		$data = array();
		if($rs->num_rows>0){
			while($r=$rs->fetch_object()){
				$data[]=$r;
			}
		}
		
		if($rs->num_rows>0)
			$this->msg=array('error'=>0,'success'=>1,'msg'=>$data);
		else
			$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		
		return $this->msg;
	}

	public function common_select_single($table,$fields='*',$where=false){
		$q="select $fields from $table";
		
		if($where && is_array($where)){
			$q.=" where ";
			foreach($where as $k=>$v){
				$q.=" $k='$v' and ";
			}
			$q=rtrim($q,' and ');
		}

		$rs=$this->mysqli->query($q);
		if($rs->num_rows>0){
			while($r=$rs->fetch_object()){
				$data=$r;
			}
		}
		
		if($rs->num_rows>0)
			$this->msg=array('error'=>0,'success'=>1,'msg'=>$data);
		else
			$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		
		return $this->msg;
	}

	public function common_update($table,$data,$where){
		$q="update $table set ";
		if(is_array($data)){
			/* this is for setting field and data */
			foreach($data as $k=>$v){
				$q.=" $k='$v', ";
			}
			$q=rtrim($q,', ');
			/* this is for where condition */
			$q.=" where ";
			foreach($where as $k=>$v){
				$q.=" $k='$v' and ";
			}
			$q=rtrim($q,' and ');
			
			$rs=$this->mysqli->query($q);
			if($rs)
				$this->msg=array('error'=>0,'success'=>1);
			else
				$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		}else{
			$this->msg=array('error'=>1,'success'=>0,'msg'=>'Data should be in array format');
		}
		return $this->msg;
	}

	public function common_delete($table,$where){
		$q="delete from $table ";
		if(is_array($where)){
			/* this is for where condition */
			$q.=" where ";
			foreach($where as $k=>$v){
				$q.=" $k='$v' and ";
			}
			$q=rtrim($q,' and ');
			
			$rs=$this->mysqli->query($q);
			if($rs)
				$this->msg=array('error'=>0,'success'=>1);
			else
				$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		}else{
			$this->msg=array('error'=>1,'success'=>0,'msg'=>'Data should be in array format');
		}
		return $this->msg;
	}
	
	
	
	public function common_select_query($query){
		$q="$query";
		$rs=$this->mysqli->query($q);
		$data = array();
		if($rs->num_rows>0){
			while($r=$rs->fetch_object()){
				$data[]=$r;
			}
		}
		
		if($rs->num_rows>0)
			$this->msg=array('error'=>0,'success'=>1,'msg'=>$data);
		else
			$this->msg=array('error'=>1,'success'=>0,'msg'=>$this->mysqli->error);
		
		return $this->msg;
	}

	
}





