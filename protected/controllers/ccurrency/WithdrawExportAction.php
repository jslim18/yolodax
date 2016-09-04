<?php

class WithdrawExportAction extends CAction{

	private static $controller;

	public function run(){
	if(isset($_POST['with_type']) && $_SERVER['REQUEST_METHOD'] == "POST"){
	$status = explode(",",$_POST['with_type']);
	$wids = $_POST['wids'];
		$resultSet = Yii::app()->db->createCommand()
					->select("withdrawals.*, users.username")
					->from("withdrawals")
					->join("users","users.id=withdrawals.user_id")
					->where(array("in","withdrawals.status",$status))
					->andWhere("withdrawals.wid in ($wids)")
					->queryAll();

		$data = "";
		if(sizeof($resultSet)){foreach($resultSet as $row){
		 $udp = array("status"=>"completed","updated"=>date("Y-m-d H:i:s"));
		 Yii::app()->db->createCommand()->update("withdrawals",$udp,"wid=:id",array(":id"=>$row['wid']));
		  $data .= $row['currency']."d sendtoaddress '".$row['address']."' '".$row['amount']."' 'comment' 'comment-to'"."\n";
		}}
		$file = date("Y_m_d_H_i")."_Exported.sh";
		header('Content-Type: application/sh');
		header('Content-Disposition: attachement; filename="'.$file.'"');

	 echo $data; exit();
	}else{
	 $this->getController()->redirect(Yii::app()->getBaseUrl(true)."/ccurrency/withdraw");
	}

	}

}