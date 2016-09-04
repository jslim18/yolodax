<?php
class ListNewsAction extends CAction{
	private static $controller;

	public function run(){
	 self::$controller = $this->getController();
	 $limit = 10;
	 	$criteria=new CDbCriteria();
		$count=News::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
		$q = Yii::app()->db->createCommand()
				->select("*")
				->from("news")
				->order("id desc")
				->limit($limit,$offset)
				->queryAll();
		$data['total'] = $count;
		$data['news'] = $q;
	 self::$controller->render("/admin/list_news",$data);
	}
}