<?php
class TradeHistoryAction extends CAction{
	

	public function run(){
		 $uid = Yii::app()->user->id;
		$limit = 20;
	$criteria = new CDbCriteria();
	$criteria->condition = "user_id=$uid and done_status='Done'";
		$count=Transactions::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
	$res = Yii::app()->db->createCommand()
				->select("*")
				->from("transactions")
				->where("user_id=:uid",array(":uid"=>$uid))
				->andWhere("done_status=:ds",array(":ds"=>"Done"))
				->order("id desc")
				->limit($limit,$offset)
				->queryAll();
	$data['trades'] = $res;
		 Yii::app()->controller->render('trade_history',$data);
	}
	
	
}
