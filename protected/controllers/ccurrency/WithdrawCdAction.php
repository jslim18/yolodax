<?php

class WithdrawCdAction extends CAction{

	private static $controller;

	public function run(){
	 self::$controller = $this->getController();
	 $this->updateRecord();
		$limit = 20;
	$criteria=new CDbCriteria();
	$criteria->condition = "status in ('cancelled')";
		$count=Withdrawals::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
		$data['action_title'] = 'Cancelled';
		$data['action'] = Yii::app()->getBaseUrl(true)."/ccurrency/withdraw_cancel";
		$data['url'] = 'ccurrency/withdraw_cancel';
		$data['widreqs'] = Admins::model()
						->get_withdraw_request($offset, $limit, array('cancelled'));
		$data['type'] = "cancelled";
	 self::$controller->render('withdrawal_requests', $data);
	}

	private function updateRecord(){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			if($_POST['wid']!="" && $_POST['with_action']!=""){
			 $upd['status'] = $_POST['with_action'];
			 $widss = explode(",",$_POST['wid']);
			$trans = Yii::app()->db->beginTransaction();
			try{
			 foreach($widss as $k){
			  Yii::app()->db->createCommand()
				  		->update('withdrawals',$upd,"wid=:id", array(':id'=>$k));
			 }
			$trans->commit();
			}catch(Exception $ex){$trans->rollback();}
			 Yii::app()->user->setFlash("success","Action has been performed successfully!");
			 self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/withdraw");
			}else{
			 Yii::app()->user->setFlash("success","Action could not be performed!");
			 self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/withdraw");
			}
		}
	}


}