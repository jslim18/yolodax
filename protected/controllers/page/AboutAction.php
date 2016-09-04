<?php
class AboutAction extends CAction{

	public function run(){
		$controller = $this->getController();
		$data['about'] = Yii::app()->db->createCommand()
							->select("content")
							->from("contents")
							->where("title='about_us'")
							->queryRow();
	 $controller->render("about",$data);
	}
}