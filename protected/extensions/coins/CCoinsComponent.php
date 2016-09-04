<?php
error_reporting(0);

class jsonRPCServer {
	public static function handle($object) {
		if (
			$_SERVER['REQUEST_METHOD'] != 'POST' || 
			empty($_SERVER['CONTENT_TYPE']) ||
			$_SERVER['CONTENT_TYPE'] != 'application/json'
			) {
			return false;
		}
		$request = json_decode(file_get_contents('php://input'),true);
		try {
			if ($result = @call_user_func_array(array($object,$request['method']),$request['params'])) {
				$response = array (
									'id' => $request['id'],
									'result' => $result,
									'error' => NULL
									);
			} else {
				$response = array (
									'id' => $request['id'],
									'result' => NULL,
									'error' => 'unknown method or incorrect parameters'
									);
			}
		} catch (Exception $e) {
			$response = array (
								'id' => $request['id'],
								'result' => NULL,
								'error' => $e->getMessage()
								);
		}
		
		if (!empty($request['id'])) {
			header('content-type: text/javascript');
			echo json_encode($response);
		}
		
		return true;
	}
}

class jsonRPCClient {
	private $debug;

	private $url;

	private $id;

	private $notification = false;

	public function __construct($url,$debug = false) {
		$this->url = $url;
		empty($proxy) ? $this->proxy = '' : $this->proxy = $proxy;
		empty($debug) ? $this->debug = false : $this->debug = true;
		$this->id = 1;
	}

	public function setRPCNotification($notification) {
		empty($notification) ?
							$this->notification = false
							:
							$this->notification = true;
	}
	
	public function __call($method,$params) {
		if (!is_scalar($method)) {
			throw new Exception('Method name has no scalar value');
		}

		if (is_array($params)) {
			$params = array_values($params);
		} else {
			throw new Exception('Params must be given as array');
		}
		
		if ($this->notification) {
			$currentId = NULL;
		} else {
			$currentId = $this->id;
		}
		
		$request = array(
						'method' => $method,
						'params' => $params,
						'id' => $currentId
						);
		$request = json_encode($request);
		$this->debug && $this->debug.='***** Request *****'."\n".$request."\n".'***** End Of request *****'."\n\n";
		
		$opts = array ('http' => array (
							'method'  => 'POST',
							'header'  => 'Content-type: application/json',
							'content' => $request
							));
		$context  = stream_context_create($opts);
		if ($fp = fopen($this->url, 'r', false, $context)) {
			$response = '';
			while($row = fgets($fp)) {
				$response.= trim($row)."\n";
			}
			$this->debug && $this->debug.='***** Server response *****'."\n".$response.'***** End of server response *****'."\n";
			$response = json_decode($response,true);
		} else {
			throw new Exception('Unable to connect to '.$this->url);
		}
		
		if ($this->debug) {
			echo nl2br($debug);
		}
		
		if (!$this->notification) {
			if ($response['id'] != $currentId) {
				throw new Exception('Incorrect response id (request id: '.$currentId.', response id: '.$response['id'].')');
			}
			if (!is_null($response['error'])) {
				throw new Exception('Request error: '.$response['error']);
			}
			
			return $response['result'];
			
		} else {
			return true;
		}
	}
}

class CCoinsComponent extends CApplicationComponent{

	private $coin;
	private $user;
	private $password;
	private $host;
	private $port;

	public function setCoin($c = array()){
		$this->coin		 = $c['coin'];
		$this->user		 = $c['user'];
		$this->password	 = $c['password'];
		$this->host		 = $c['host'];
		$this->port		 = $c['port'];
	}

	public function whichCoin(){
	return $this->coin;
	}

	private function makeClient(){
	$user = $this->user;
	$pass = $this->password;
	$host = $this->host;
	$port = $this->port;
	$obj = new jsonRPCClient("http://$user:$pass@localhost:$port/");
	 return $obj;
	}

	public function getInfo(){
		try{
		 $client = $this->makeClient();
		 return $client->getinfo();
		}catch(Exception $ex){
		 return array("errors"=>"There is an error in the server!");
		 }
	}
	
	public function getNewAddress($add){
		try{
		 $client = $this->makeClient();
		 return $client->getnewaddress($add);
		}catch(Exception $ex){
		 return array("errors"=>"There is an error in the server!");
		}	
	}
	
	public function getAddressesByAccount($acc){
		try{
		 $client = $this->makeClient();
		 return $client->getaddressesbyaccount($acc);
		}catch(Exception $ex){
		 return array("errors"=>"There is an error in the server!");
		}		
	}

	public function getTransaction($txid=NULL){
		try{
		 $client = $this->makeClient();
		 return $client->gettransaction($txid);
		}catch(Exception $ex){
		 return array("errors"=>"There is an error in the server!");
		}
	}



}