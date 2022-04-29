<?php
namespace App\Helpers;
use Session;

class Wsneofeeder {

    public static function runWS($data,$type='json',$url=false){
		//global $url;
		if(!$url){
			$feeder_akun = Session::get('neofeeder_akun');
			if($feeder_akun){
				$url = $feeder_akun->url;
			}
		}
		$url = $url."/ws/live2.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		if ($type == 'xml'){
			$headers[] = 'Content-Type: application/xml';			
		}else{
			$headers[] = 'Content-Type: application/json';				
		}
		
		//echo $url;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($data){
			if ($type == 'xml'){
				/* contoh xml:
				<?xml
				version="1.0"?><data><act>GetToken</act><username>agus</username><passwo
				rd>abcdef</password></data>
				*/
				$data = stringXML($data);
			}else{
				/* contoh json:
				{"act":"GetToken","username":"agus","password":"abcdef"}
				*/
				$data = json_encode($data);
			}				
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;	
	}
	
	public static function stringXML($data){
		$xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		self::array_to_xml($data, $xml);
		return $xml->asXML();
	}
	
	public static function array_to_xml( $data, &$xml_data ){		
		foreach($data as $key => $value){
			if(is_array($value)){
				$subnode = $xml_data->addChild($key);
				self::array_to_xml($value, $subnode);
			}else{
				//$xml_data->addChild("$key",htmlspecialchars("$value"));
				$xml_data->addChild("$key",$value);
			}
		}
	}
	
	public static function token($username, $password){		
		$type = 'json'; 
		$data = array('act'=>'GetToken', 'username'=>$username,'password'=>$password);
		$tokenn = self::runWS($data, $type);
		return 	$tokenn; 	
	}
	
	public static function getdictionary($token,$act,$fungsi) {
	   $data = array('act'=>$act,'token'=>$token,'fungsi'=>$fungsi);
	   $ret = self::runWS($data);
	   return json_decode($ret);
	}
	
	public static function getrecord($token, $table, $filter=false, $ctype='JSON') {
	   $ret = self::runWS(array('token'=>$token, 'act'=>$table, 'filter'=>$filter),$ctype);
	   return json_decode($ret);
	}	

	public static function getrecordset($token, $table, $filter=false, $order=false, $limit=false, $offset=false, $ctype='JSON') {
		$ret = self::runWS(array('token'=>$token,'act'=>$table, 'filter'=>$filter, 'order'=>$order, 'limit'=>$limit, 'offset'=>$offset),$ctype);
		return json_decode($ret);
	}
   
 
	public static function insertws($token, $table, $records, $ctype='JSON') {
	   return self::runWS(array('token'=>$token, 'act'=>$table, 'record'=>$records),$ctype);
	}
   
	public static function updatews($token,$table,$records,$key,$ctype='JSON') {
	   return self::runWS(array('token'=>$token, 'act'=>$table, 'key'=>$key,'record'=>$records),$ctype);
	}
	public static function deletews($token,$table,$key,$ctype='JSON') {
	   return self::runWS(array('token'=>$token, 'act'=>$table,'key'=>$key),$ctype);
	}
	
	
	public static function cekkoneksifeeder(){
		$feeder_akun = Session::get('neofeeder_akun');
		$dataws = array('act'=>'GetToken','username'=>$feeder_akun->username,'password'=>$feeder_akun->password);
		$returnws = self::runWS($dataws,false,$feeder_akun->url);
		$returnws = json_decode($returnws);
		if($returnws->error_code != 0){
			return $returnws->error_desc;			
		}else{
			return FALSE;
		}
	}

	
}