<?php

class WithdrawExportAction extends CAction{

	private static $controller;

	public function run(){
	if(isset($_POST['with_type']) && $_SERVER['REQUEST_METHOD'] == "POST"){
	$status = $_POST['with_type'];
			$resultSet = Yii::app()->db->createCommand()
						->select("withdrawals.*, users.username")
						->from("withdrawals")
						->join("users","users.id=withdrawals.user_id")
						->where("withdrawals.status in ($status)")
						->queryAll();

		$data = "Currency,Address,Amount"."\n";
		if(sizeof($resultSet)){foreach($resultSet as $row){
		  $data .= $row['currency'].",".$row['address'].",".$row['amount']."\n";
		}}
		header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="Exported.csv"');

	 echo $data; exit();
	}else{
	 $this->getController()->redirect(Yii::app()->getBaseUrl(true)."/ccurrency/withdraw");
	}

	}

}