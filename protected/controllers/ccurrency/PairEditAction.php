<?php
class PairEditAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->_ccurrencyPairEdit();
	}

	private function _ccurrencyPairEdit(){
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