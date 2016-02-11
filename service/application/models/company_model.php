<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {

 public function __construct()

 {

  parent::__construct();


 }
 



 
 public function get_company()

 {

	$sql = "select COMPANY_ID,  COMPANY_NAME,  COMPANY_ADDRESS,  COMPANY_EMAIL,  COMPANY_CONTACT,  COMPANY_WEBSITE from company_info c where C.IS_ACTIVE='Y' and is_delete='N' order by COMPANY_NAME";

        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetAll($sql);
        $CI->closeConnection();
        return $data;
  
   
  

 }
 
 public function get_company_by_id($id)

 {

	$sql = "select COMPANY_ID,  COMPANY_NAME,  COMPANY_ADDRESS,  COMPANY_EMAIL,  COMPANY_CONTACT,  COMPANY_WEBSITE from company_info c where C.IS_ACTIVE='Y' and is_delete='N' and COMPANY_ID=".$id;

        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetRow($sql);
        $CI->closeConnection();
        return $data;
  
   
  

 }
 
 public function save_company($doc)

 {

	
       
        $CI = new oracleconnection();
        $CI->createConnection();
        $inSt = -1;
        //echo "here". $doc;
       // exit;

        $stmt = $CI->PrepareSP("BEGIN PKG_COMPANY.InsertData(:stmt,:inSt); END;");//COMPANY
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);//stmt
        oci_bind_by_name($stmt, ":inSt", $inSt);//inSt
        $clob->writeTemporary($doc);
        $CI->Execute_procedure($stmt);
        $CI->closeConnection();
        
        return @$inSt;
  
   
  

 }
 
 public function edit_company($doc)

 {

	
       
        $CI = new oracleconnection();
        $CI->createConnection();
        $inSt = -1;
        //echo "here". $doc;
       // exit;

        $stmt = $CI->PrepareSP("BEGIN PKG_COMPANY.EditData(:stmt,:inSt); END;");
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stmt, ":inSt", $inSt);
        $clob->writeTemporary($doc);
        $CI->Execute_procedure($stmt);
        $CI->closeConnection();
        
        return @$inSt;
  
   
  

 }
 public function delete_company($doc)

 {

	
       
        $CI = new oracleconnection();
        $CI->createConnection();
        $inSt = -1;
        //echo "here". $doc;
       // exit;

        $stmt = $CI->PrepareSP("BEGIN PKG_COMPANY.DeleteData(:stmt,:inSt); END;");
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stmt, ":inSt", $inSt);
        $clob->writeTemporary($doc);
        $CI->Execute_procedure($stmt);
        $CI->closeConnection();
        
        return @$inSt;
  
   
  

 }
 



}

?>