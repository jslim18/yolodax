<?php
class GetTotalAction extends CAction{

	public function run(){
		$pair = $_POST['p'];
		$rlt = Users::model()->get_total($pair);	
		echo json_encode(array("amount"=>(float)$rlt['amount'],"total"=>(float)$rlt['total']));
	}


}
