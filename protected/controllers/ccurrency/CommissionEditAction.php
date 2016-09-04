<?php
class CommissionEditAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 $pid = @$_GET['cid'];
		$data['model'] = self::$model = Commission::model()->findByPk($pid);
		$data['pair'] = CcurrencyPair::model()->findAll();
			if(isset($_POST['Commission'])){
				$this->message="Commission pair has been updated successfully!";
				$this->saveCommission();
			}
	 self::$controller->render('commission_edit', $data);
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

}