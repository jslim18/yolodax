<?php
class OrderHistoryAction extends CAction{

	public function run(){
		$uid = Yii::app()->user->id;
		$limit = 20;
	$criteria=new CDbCriteria();
	$criteria->condition = "user_id=$uid";
		$count=Transactions::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
		$data['orders'] = Yii::app()->db->createCommand()
							->select("*")
							->from("transactions")
							->where("user_id=:uid",array(":uid"=>$uid))
							->order("timestamp")
							->limit($limit,$offset)
							->queryAll();
		$data['av_pairs'] = Yii::app()->db->createCommand()
							->select("cpair_slug")
							->from("ccurrency_pair")
							->queryAll();

	 $this->getController()->render('order_history',$data);
	}
}