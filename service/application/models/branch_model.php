<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch_model extends CI_Model {

 public function __construct()

 {

  parent::__construct();


 }
 



 
 public function get_branch()

 {

	$sql = "select b.BRANCH_ID,c.COMPANY_NAME,  b.BRANCH_NAME,  b.BRANCH_ADDRESS,  b.BRANCH_EMAIL,  b.BRANCH_CONTACT from branch_info b,company_info c where B.COMPANY_ID=C.COMPANY_ID and b.IS_ACTIVE='Y' and b.is_delete='N' order by BRANCH_NAME";

        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetAll($sql);
        $CI->closeConnection();
        return $data; 

 }
 
 public function get_branch_by_id($id)

 {

	$sql = "select b.BRANCH_ID,b.COMPANY_ID,  b.BRANCH_NAME,  b.BRANCH_ADDRESS,  b.BRANCH_EMAIL,  b.BRANCH_CONTACT from branch_info b where b.IS_ACTIVE='Y' and b.is_delete='N' and b.BRANCH_ID=".$id;

        $CI = new oracleconnection();
        $CI->createConnection();
        $data = $CI->GetRow($sql);
        $CI->closeConnection();
        return $data;   
  
 }
 
 public function save_branch($doc)

 {	
       
        $CI = new oracleconnection();
        $CI->createConnection();
        $inSt = -1;
        //echo "here". $doc;
       // exit;

        $stmt = $CI->PrepareSP("BEGIN PKG_BRANCH.InsertData(:stmt,:inSt); END;");//COMPANY
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);//stmt
        oci_bind_by_name($stmt, ":inSt", $inSt);//inSt
        $clob->writeTemporary($doc);
        $CI->Execute_procedure($stmt);
        $CI->closeConnection();
        
        return @$inSt;
  
   
  

 }
 
 
 public function edit_branch($doc)

 {
       
        $CI = new oracleconnection();
        $CI->createConnection();
        $inSt = -1;
        //echo "here". $doc;
       // exit;

        $stmt = $CI->PrepareSP("BEGIN PKG_BRANCH.EditData(:stmt,:inSt); END;");
       
        $clob = $CI->createClob();
      
        //authorize_action
        oci_bind_by_name($stmt, ':stmt', $clob, -1, OCI_B_CLOB);
        oci_bind_by_name($stmt, ":inSt", $inSt);
        $clob->writeTemporary($doc);
        $CI->Execute_procedure($stmt);
        $CI->closeConnection();
        
        return @$inSt;
  
   
  

 }
 /*
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
 

*/

}

?>