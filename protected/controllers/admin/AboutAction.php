<?php
class AboutAction extends CAction{
	private static $controller;

	public function run(){
		self::$controller = $this->getController();
		 if(isset($_POST['submit'])){
		  $con = $_POST['content'];
		  $content = Contents::model()->find("title=:title",array(":title"=>'about_us'));
		  $content->content = $con;
		  $content->save();
		   Yii::app()->user->setFlash("success",Yii::t("messages","About us content has been updated successfully!"));
		 }
		 $q = Yii::app()->db->createCommand()
		 		->select("content")
				->from("contents")
				->where("title=:title",array(":title"=>'about_us'))
				->limit(1,0)
				->queryRow();
		 $data['content'] = $q;
	 self::$controller->render("/admin/aboutUs",$data);
	}
}