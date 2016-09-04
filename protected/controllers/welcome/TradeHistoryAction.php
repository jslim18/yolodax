<?php
class TradeHistoryAction extends CAction{


	public function run(){
		$data = Users::model()->get_high_low($_POST['pair'],$_POST['to']);
		echo json_encode(array("data"=>$data));
	}


}
