<?php


class ClientProxy {
    
    var $client;
    var $wsdlURL;
    var $headerParams;
    var $labServerID;
            
   function __construct($labServerID, $couponID, $couponPasskey)
    {
    $ini_array = parse_ini_file("config.ini");
    ini_set('display_errors',1);
    error_reporting(-1); 
    //Parse config.ini parameters
    $this->wsdlURL = $ini_array["wsdlURL"];
    $this->labServerID = $labServerID;
    //Set SOAP Headers
    $this->headerParams = array('couponID'=>$couponID, 'couponPasskey'=>$couponPasskey);

    //Set Body parameters

     //Create SOAP Client
     $this->client = new SoapClient($this->wsdlURL, array('trace' => 1));
     $header = new SOAPHeader('http://ilab.mit.edu', 'sbAuthHeader', $this->headerParams); 
     $this->client->__setSoapHeaders($header);
 
    }
    
    function getLabInfo(){
        
        $params = array('labServerID' =>$this->labServerID);
        
        //set cookie
        //$this->client->__setCookie('ASP.NET_SessionId', 'thhxz5551x1b1tmzvww2da45');
        $result = $this->client->__soapCall('GetLabInfo',array($params));
    

    return  $result->GetLabInfoResult;

    }
    
    //returns an Object with status report
    function getExperimentStatus($experimentID){
        
       //$this->client->__setCookie('ASP.NET_SessionId', 'thhxz5551x1b1tmzvww2da45'); 
       $params = array('experimentID' =>$experimentID);        
       $result = $this->client->__soapCall('GetExperimentStatus',array($params));
       
       return $result->GetExperimentStatusResult->statusReport;
       //var_dump($result);
    }
    
    function retrieveResults($experimentID){
        
       //$this->client->__setCookie('ASP.NET_SessionId', 'thhxz5551x1b1tmzvww2da45'); 
       
       $params = array('experimentID' =>$experimentID);        
       $result = $this->client->__soapCall('RetrieveResult',array($params));
       
       return $result->RetrieveResultResult->experimentResults;
       //var_dump($result);
    }
    //Return Object with validation protocol
    function validate($experimentSpecXml){
        
        $params = array('labServerID' =>$this->labServerID, 
                        'experimentSpecification'=>$experimentSpecXml);
        $result = $this->client->__soapCall('Validate',array($params));
        
        return $result;
    }

    public function submit($experimentSpecXml){

        $params = array('labServerID' =>$this->labServerID,
                        'experimentSpecification'=>$experimentSpecXml,
                        'priorityHint'=>'1',
                        'emailNotification'=>false);
        $result = $this->client->__soapCall('Submit',array($params));

        return $result;
    }


}


?>


