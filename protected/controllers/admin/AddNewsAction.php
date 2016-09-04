<?php
class AddNewsAction extends CAction{
	private static $controller;
	private static $model;

	public function run(){
		self::$controller = $this->getController();
		self::$model = new News;
		self::ajax_validation();
		if(isset($_POST['News'])){$this->add_news();	}
	  $data['model'] = self::$model;
	 self::$controller->render("/admin/add_news",$data);
	}

	private static function ajax_validation(){
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-add-form'){
			echo CActiveForm::validate(self::$model);
			Yii::app()->end();
		}
	}
	
	private function add_news(){
		self::$model->attributes = $_POST['News'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages","Your news has been added successfully!"));
		self::$controller->redirect(Yii::app()->baseUrl."/content/list_news");
	}
}