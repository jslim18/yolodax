<?php
class WithdrawHistoryAction extends CAction{

	public function run(){
	$uid = Yii::app()->user->id;
		$limit = 10;
	$criteria=new CDbCriteria();
	$criteria->condition = "user_id=$uid";
		$count=Withdrawals::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
	$res = Yii::app()->db->createCommand()
				->select("*")
				->from("withdrawals")
				->where("user_id=:uid",array(":uid"=>$uid))
				->order("wid desc")
				->limit($limit,$offset)
				->queryAll();
	$data['withs'] = $res;
		 Yii::app()->controller->render('withdraw_history',$data);
	}

}