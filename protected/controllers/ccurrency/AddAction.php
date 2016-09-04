<?php
class AddAction extends CAction{

	private static $model;
	private static $controller;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
		$this->_ccurrencyAdd();
	}

	private function _ccurrencyAdd() {
	 self::$model = new Ccurrencies;
	 if(isset($_POST['Ccurrencies'])){
		$this->message="New currency has been added successfully!";
		$this->currencySave();
	 }
	 $data['model'] = self::$model;
	 self::$controller->render('ccurrency_add',$data);
	}
	
	private function currencySave(){
		self::$model->attributes = $_POST['Ccurrencies'];
		if(self::$model->validate()){
			if(self::$model->save()){
			$query = sprintf('Alter table amounts add %s decimal(16,8) NOT NULL DEFAULT 0', $_POST['Ccurrencies']['currency']);
			Yii::app()->db->createCommand($query)->execute();
			$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/ccurrency/list");
	}

}