<?php

class DepositsAction extends CAction{

	private static $controller;

	public function run(){
		self::$controller = $this->getController();
	 $limit = 20;
	 	$criteria=new CDbCriteria();
		$count=Addresses::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
		$q = Yii::app()->db->createCommand()
				->select("a.*,u.username")
				->from("addresses a")
				->leftJoin("users u","u.id=a.user_id")
				->order("a.created_at desc")
				->limit($limit,$offset)
				->queryAll();
		$data['total'] = $count;
		$data['all'] = $q;
	 self::$controller->render("deposits",$data);
	}

}