<?php
class TermsAction extends CAction{
	private static $controller;

	public function run(){
		self::$controller = $this->getController();
		 if(isset($_POST['submit'])){
		  $con = $_POST['content'];
		  $content = Contents::model()->find("title=:title",array(":title"=>'terms_privacy_conditions'));
		  $content->content = $con;
		  $content->save();
		   Yii::app()->user->setFlash("success",Yii::t("messages","Terms & conditions has been updated successfully!"));
		 }
		 $q = Yii::app()->db->createCommand()
		 			->select("content")
					->from("contents")
					->where("title=:title",array(":title"=>'terms_privacy_conditions'))
					->limit(1,0)
					->queryRow();
		 $data['content'] = $q;
	 self::$controller->render("/admin/terms",$data);
	}
}