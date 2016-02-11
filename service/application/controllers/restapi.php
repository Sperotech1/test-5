<?php
require(APPPATH.'libraries/REST_Controller.php');
 
class Restapi extends REST_Controller
{
    public function __construct()
 {
  parent::__construct();
   
  $this->load->model('rest_model');
   $this->load->model('company_model');
   $this->load->model('branch_model');
  
  
  
 // if(!$this->session->userdata('user_id'))redirect('user/index', 'refresh');
 }
	
 
  
  
 
	
	function settings_get()
    {
       

        $settings=array();
		//$user = new StdClass;
        $result = $this->rest_model->get_settings();
        foreach($result as $r)
        {
			$settings[$r['TYPE']]=$r['DESCRIPTION'];
		}
		
        if($settings)
        {
           
		   
		    $this->response( $settings, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function company_get()
    {
       

        $result=array();
		//$user = new StdClass;
        $result = $this->company_model->get_company();
        
        if($result)
        {
           
		   
		    $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    function branch_get()
    {
       

        $result=array();
        //$user = new StdClass;
        $result = $this->branch_model->get_branch();
        
        if($result)
        {
           
           
            $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    function companydetail_post()
    {
       

        $result=array();
        $cid=$this->input->post('cid');
        $result['STATUS']=0;
		//$user = new StdClass;
        $result['DATA'] = $this->company_model->get_company_by_id($cid);
        
        if(!empty($result['DATA']))
        {
           
		   $result['STATUS']=1;
		    $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response($result, 404);
        }
    }
    function branchdetail_post()
    {
       

        $result=array();
        $bid=$this->input->post('bid');
        $result['STATUS']=0;
        //$user = new StdClass;
        $result['DATA'] = $this->branch_model->get_branch_by_id($bid);
        
        if(!empty($result['DATA']))
        {
           
           $result['STATUS']=1;
            $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response($result, 404);
        }
    }
    
    
     function saveCompany_post()
    {
       

        $result=array();
		//$user = new StdClass;
		$data=$this->input->post('data');
		/*$data="<statement><rowrecord><COMPANY_NAME>test2</COMPANY_NAME><COMPANY_EMAIL>razib833@yahoo.com</COMPANY_EMAIL><COMPANY_CONTRACT>01718060804</COMPANY_CONTRACT><COMPANY_ADDRESS>dhaka</COMPANY_ADDRESS><INSERT_BY>1</INSERT_BY></rowrecord></statement>";
		*/
		
		$result['company_status']="0";
       $output = $this->company_model->save_company($data);
        
       
        if($output==1)
        {
			$result['company_status']="1";
		}
        
        if($result)
        {
           
		   
		    $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    function saveBranch_post()
    {
       

        $result=array();
        //$user = new StdClass;
        $data=$this->input->post('data');
        /*$data="<statement><rowrecord><COMPANY_NAME>test2</COMPANY_NAME><COMPANY_EMAIL>razib833@yahoo.com</COMPANY_EMAIL><COMPANY_CONTRACT>01718060804</COMPANY_CONTRACT><COMPANY_ADDRESS>dhaka</COMPANY_ADDRESS><INSERT_BY>1</INSERT_BY></rowrecord></statement>";
        */
        
        $result['branch_status']="0";
       $output = $this->branch_model->save_branch($data);
        
       
        if($output==1)
        {
            $result['branch_status']="1";
        }
        
        if($result)
        {
           
           
            $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function updateCompany_post()
    {      

        $result=array();
		//$user = new StdClass;
		$data=$this->input->post('data');
		
		
		$result['company_status']="0";
       $output = $this->company_model->edit_company($data);
        
       
        if($output==1)
        {
			$result['company_status']="1";
		}
        
        if($result)
        {
           
		   
		    $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        
        
        }
    }
    function updateBranch_post()
    {      

        $result=array();
        //$user = new StdClass;
        $data=$this->input->post('data');
        
        
        $result['branch_status']="0";
       $output = $this->branch_model->edit_branch($data);
        
       
        if($output==1)
        {
            $result['branch_status']="1";
        }
        
        if($result)
        {
           
           
            $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        
        
        }
    }
    
    function deleteCompany_post()
    {
       

        $result=array();
		//$user = new StdClass;
		$data=$this->input->post('data');
		
		
		$result['company_status']="0";
       $output = $this->company_model->delete_company($data);
        
       
        if($output==1)
        {
			$result['company_status']="1";
		}
        
        if($result)
        {
           
		   
		    $this->response( $result, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
	function login_post()
    {
       

        $login_info=array();
		//$user = new StdClass;
		$user_info['email']=$this->input->post('email');
		$user_info['password']=$this->input->post('password');
		
		//$user_info['email']="admin@hms.com";
		//$user_info['password']="123456";
        $result = $this->rest_model->login($user_info);
        if(empty($result))
        {
			$login_info['STATUS']=0;
		}else
		{
			if($result['USER_PASSWORD']==$user_info['password'])
			{
				$login_info['STATUS']=1;
				$login_info['DATA']['user_email']=$result['USER_EMAIL'];
				$login_info['DATA']['user_id']=$result['USER_ID'];
				$login_info['DATA']['employee_id']=$result['EMPLOYEE_ID'];
			}else
			{
				$login_info['STATUS']=0;
			}
		}
       
    /*    foreach($result as $r)
        {
			$settings[$r['TYPE']]=$r['DESCRIPTION'];
		}
	*/
        if($login_info)
        {
           
		   //$this->API_model->update($data);
          // $message = array('id' => '1','Book Name' => "name",'Book Price' => "price",'Book Author' => "author",'message' => 'Added a resource');
		    $this->response( $login_info, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
	
   
}
?>