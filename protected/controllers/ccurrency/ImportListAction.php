<?php
class ImportListAction extends CAction{

	public $controller;

	public function run(){
	 $this->controller = $this->getController();
		$limit = 20;
	$criteria=new CDbCriteria();
		$count=Imports::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
	 $data['adds']=Yii::app()->db->createCommand()
	 				->select("*")
					->from("imports")
					->limit($limit,$offset)
					->queryAll();
	 $this->controller->render("import_list",$data);
	}

}