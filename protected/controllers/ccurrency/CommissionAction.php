<?php
class CommissionAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 self::$model = new Commission;
	 $data['model'] = self::$model;
	 $data['pair'] = CcurrencyPair::model()->findAll();
		if(isset($_POST['Commission'])){
			$this->message="Pair commission has been added successfully!";
			$this->saveCommission();
		}
	 $data['comms'] = Commission::model()->findAll();
	 self::$controller->render('commission',$data);
	}

	private function _ccurrencyPair($action) {
		$data['model'] = self::$model = new CcurrencyPair;
		$data['ccurr'] = Admins::model()->get_all_ccurrencies();
			if(isset($_POST['CcurrencyPair'])){
				$this->message="New pair has been added successfully!";
				$this->savePair();
			}
		$limit = 2;
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

	private function saveCommission(){
		self::$model->attributes = $_POST['Commission'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/commission");
	}

	private function _ccurrencyPairDelete($action){
		$pid = $_GET['cpid'];
		Yii::app()->db->createCommand()
				->delete("ccurrency_pair","pid=:pid",array(":pid"=>$pid));
		echo $pid;
		Yii::app()->end();
	}

	private function _ccurrencyPairEdit($action){
	 $pid = @$_GET['cpid'];
		$data['model'] = self::$model = CcurrencyPair::model()->findByPk($pid);
		$data['ccurr'] = Admins::model()->get_all_ccurrencies();
			if(isset($_POST['CcurrencyPair'])){
				$this->message="Pair has been updated successfully!";
				$this->savePair();
			}
		$data['cpairs'] = Admins::model()->get_ccurrency_pairs();
	 self::$controller->render('ccurrency_pair_edit', $data);
	}

}