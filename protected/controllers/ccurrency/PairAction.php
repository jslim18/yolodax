<?php
class PairAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	$this->_ccurrencyPair();
	}

	private function _ccurrencyPair() {

		$limit = 10;
	$criteria=new CDbCriteria();
		$count=CcurrencyPair::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
		$data['cpairs'] = Admins::model()->get_ccurrency_pairs($offset,$limit);
	 self::$controller->render('ccurrency_pair', $data);
	}

}