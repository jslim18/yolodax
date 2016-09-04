<?php
class GetTradeHistoryAction extends CAction{


	public function run(){
			  $last = 0;
	 if(count($_POST)>0){
	 $last = @$_POST['last']?$_POST['last']:0;
	 $coin = $_POST['coin'];
	 $hard = $_POST['hard'];
	  $trades = Users::model()->trade_history($coin,$hard,$last);
	  $temp = array();
	  if(sizeof($trades)>0){
	  	$last = $trades[0]['id'];
	  foreach($trades as $k){
	   $temp[] = array("timestamp"=>date("d.m.Y H:i",strtotime($k['timestamp'])),"type"=>$k['type'],
	   				  "rate"=>floatval($k['rate'])." ".$k['hard_currency'],"amount"=>floatval($k['amount'])." ".$k['currency_short'],
					  "total"=>floatval($k['total'])." ".$k['hard_currency']);
	  }
	  echo json_encode(array("data"=>$temp,"last"=>$last));
	  }
	  else{echo json_encode(array("data"=>NULL,"last"=>$last));}
	 }
	}


}
