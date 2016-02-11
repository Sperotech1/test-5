<?php

if ( ! defined('BASEPATH') )
    exit( 'No direct script access allowed' );

class Oracleconnection
{
   

   private $user="";
   //var $password="rmsdb786";
   private $password="";
   var $conn;
	public function __construct()
    {
        //session_start();
		
	 $this->db="localhost:1521/orcl.mshome.net";
	//$this->db="orcl";
      $this->user="spthms";
      $this->password="spthms";
      //$this->conn=oci_connect($this->user,$this->password,$this->db);
    }
    function createConnection() 
	{
		$this->conn=oci_connect($this->user,$this->password,$this->db);
		if (!$this->conn) 
		{	
			$e = OCIError();  // For OCILogon errors pass no parameter
			
			
			//$this-> throwOCIError($e);
			
		}
		return $this->conn;
	}
	
	function createClob()
	{
		 $clob = oci_new_descriptor($this->conn, OCI_D_LOB);
		 return $clob;
	}
	function PrepareSP($query)
	{
		return oci_parse($this->conn, $query);
	}
	function InParameter($stmt,$value,$field)
	{
		
		oci_bind_by_name($stmt,$field,$value);
	}
	function OutParameter($stmt,& $value,$field,$size=NULL)
	{
		if($size==NULL)
		{
		oci_bind_by_name($stmt,$field,$value);
		}else
		{
		oci_bind_by_name($stmt,$field, $value,$size);
		}
	}
	function Execute_procedure($stmt)
	{
			if(!$stmt){
			$e = OCIError($this->conn);
			//$this-> throwOCIError($e);
		}
		if(oci_execute($stmt, OCI_DEFAULT)){
			$this->commit();
			return "success";
		}
		else{
			$e = OCIError($stmt);
			//$this-> throwOCIError($e);
		}
	}
	function Execute($query)
	{
		//$connection=$this->createConnection();
		$stmt = oci_parse($this->conn,$query);
		//if error in creating statement
		if(!$stmt){
			$e = OCIError($this->conn);
			//$this-> throwOCIError($e);
		}
		if(oci_execute($stmt, OCI_DEFAULT)){
			$this->commit();
			return "success";
		}
		else{
			$e = OCIError($stmt);
			//$this-> throwOCIError($e);
		}
		// echo $conn . " inserted hallo\n\n";
	} 
	
	 
	function commit() 
	{
		oci_commit($this->conn);
	}
	function getRow($query) 
	{
		$select_stmt = oci_parse($this->conn,$query);
		oci_execute($select_stmt,OCI_DEFAULT);
		return oci_fetch_array($select_stmt, OCI_RETURN_NULLS);
		//return $select_stmt;
	}
	
	function getAll($query) 
	{
		$select_stmt = oci_parse($this->conn,$query);
		oci_execute($select_stmt,OCI_DEFAULT);
		//return oci_fetch_array($select_stmt, OCI_ASSOC);
		$nrrows=oci_fetch_all($select_stmt,$data,null, null, OCI_FETCHSTATEMENT_BY_ROW);
		return $data;
		//return $select_stmt;
	}
	function closeConnection()
	{
		 oci_close($this->conn);
	}
   
}

?>