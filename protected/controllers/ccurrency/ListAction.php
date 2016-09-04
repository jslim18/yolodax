<?php
class ListAction extends CAction{

	private static $model;
	private static $controller;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->_ccurrencyEdit();
	}
	private function _ccurrencyEdit() {
		$limit = 10;
	$criteria=new CDbCriteria();
		$count=Ccurrencies::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
	 $data['currs'] = Admins::model()->get_ccurrencies($offset,$limit);
	 self::$controller->render('edit', $data);
	}

}