<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('create_pdf')) {

    function create_pdf($html_data, $file_name = "") {
        if ($file_name == "") {
            $file_name = 'report' . date('dMY');
        }
        require 'mpdf/mpdf.php';
        $mypdf = new mPDF();
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_name . '.pdf', 'D');
    }
    
    

}

if (!function_exists('multipage_pdf')) {

    function multipage_pdf($html_data, $file_name = "",$header="",$footer="") {
        if ($file_name == "") {
            $file_name = 'report' . date('dMY');
        }
        require 'mpdf/mpdf.php';
        $mypdf = new mPDF();
        $total_page=count($html_data);
      
 
        $mypdf->SetHTMLHeader($header); 
        $mypdf->SetHTMLFooter($footer); 
        
        foreach($html_data as $h)
        {
			$total_page--;
			 $mypdf->WriteHTML($h);
			 if($total_page>0)
			 {
			 	
			 	$mypdf->AddPage();
			 }
		}
        
       
        $mypdf->Output($file_name . '.pdf', 'D');
    }
    
    

}