<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myxml {
	function array2xml($array, $xml = false){
    if($xml === false){
        $xml = new SimpleXMLElement('<root/>');
    }
    foreach($array as $key => $value){
        if(is_array($value)){
            $this->array2xml($value, $xml->addChild($key));
        }else{
            $xml->addChild($key, $value);
        }
    }
    return $xml->asXML();
     }
	 	 
 /*function arrayToXml($thisNodeName,$input)
 {
        if(is_numeric($thisNodeName))
            throw new Exception("cannot parse into xml. remainder :".print_r($input,true));
        if(!(is_array($input) || is_object($input))){
            return "<$thisNodeName>$input</$thisNodeName>";
        }
        else{
            $newNode="<$thisNodeName>";
            foreach($input as $key=>$value){
                if(is_numeric($key))
                    $key=substr($thisNodeName,0,strlen($thisNodeName)-1);
                $newNode.=arrayToXml($key,$value);
            }
            $newNode.="</$thisNodeName>";
            return $newNode;
        }
    }*/


		 
	 function xml2array($xmlstring) {
        $xml = simplexml_load_string($xmlstring);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
return $array;
    }
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */