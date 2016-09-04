<?php
class EditNewsAction extends CAction{
	private static $controller;
	private static $model;

	public function run(){
	 $id = @$_GET['id'];
	 self::$controller = $this->getController();
	 self::$model = News::model()->findByPk($id);
	 if(isset($_POST['News'])){$this->updateNews();	 }
		 $data['model'] = self::$model;
		 $data['id'] = $id;
	 self::$controller->render("/admin/edit_news",$data);
	}
	
	private function updateNews(){
		 self::$model->headline = $_POST['News']['headline'];
		 self::$model->news = $_POST['News']['news'];
		 if(self::$model->validate()){self::$model->save();
			Yii::app()->user->setFlash("success","News has been updated successfully!");
			self::$controller->redirect(Yii::app()->baseUrl."/content/list_news");
		 }
	}
}