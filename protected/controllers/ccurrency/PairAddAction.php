<?php
class PairAddAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	$this->_ccurrencyPair();
	}

	private function _ccurrencyPair() {
		$data['model'] = self::$model = new CcurrencyPair;
		$data['ccurr'] = Admins::model()->get_all_ccurrencies();
			if(isset($_POST['CcurrencyPair'])){
				$this->message="New pair has been added successfully!";
				$this->savePair();
			}
	 self::$controller->render('ccurrency_pair_add', $data);
	}
	
	private function savePair(){
		self::$model->attributes = $_POST['CcurrencyPair'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/pair");
	}

}