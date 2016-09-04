<?php
class EditAction extends CAction{

	private static $model;
	private static $controller;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->_ccurrencyUpdate();
	}

	private function _ccurrencyUpdate() {
	 $cid = @$_GET["cid"];
		$data['model'] = self::$model = Ccurrencies::model()->findByPk($cid);
		if(isset($_POST['Ccurrencies'])){
			$this->message="Currency has been updated successfully!";
			$this->currencySave();
		}
	 self::$controller->render('ccurrency_update', $data);
	}

	private function currencySave(){
		self::$model->attributes = $_POST['Ccurrencies'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/list");
	}

}