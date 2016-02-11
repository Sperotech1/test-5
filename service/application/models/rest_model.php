<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_model extends CI_Model {

 public function __construct()

 {

  parent::__construct();


 }
 



public function get_settings()

 {

	$sql = "select TYPE,DESCRIPTION from SETTINGS";



        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetAll($sql);
        $CI->closeConnection();
        return $data;
  
   
  

 }
 
 public function get_company()

 {

	$sql = "select COMPANY_ID,  COMPANY_NAME,  COMPANY_ADDRESS,  COMPANY_EMAIL,  COMPANY_CONTACT,  COMPANY_WEBSITE from company_info c where C.IS_ACTIVE='Y' order by COMPANY_NAME";

        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetAll($sql);
        $CI->closeConnection();
        return $data;
  
   
  

 }
 
 public function get_company_by_id($id)

 {

	$sql = "select COMPANY_ID,  COMPANY_NAME,  COMPANY_ADDRESS,  COMPANY_EMAIL,  COMPANY_CONTACT,  COMPANY_WEBSITE from company_info c where C.IS_ACTIVE='Y' and COMPANY_ID=".$id;

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

        $stmt = $CI->PrepareSP("BEGIN PKG_COMPANY.InsertData(:stmt,:inSt); END;");
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stmt, ":inSt", $inSt);
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
 
 public function login($usrinfo)

 {

	$sql = "select USER_ID,EMPLOYEE_ID,USER_EMAIL,USER_PASSWORD from user_info u where 
	upper(U.USER_EMAIL)=trim(upper('".$usrinfo['email']."'))";



        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->getRow($sql);
        $CI->closeConnection();
        return $data;
  
   
  

 }



}

?>