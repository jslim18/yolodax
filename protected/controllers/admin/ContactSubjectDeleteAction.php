<?php
class ContactSubjectDeleteAction extends CAction{

	public function run(){
		$id = $_POST['aid'];
	 Yii::app()->db->createCommand()
	 		->delete("contact_subjects","id=:id",array(":id"=>$id));
	 echo $id;
	 Yii::app()->end();
	}

}