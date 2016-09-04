<?php
class ArchiveAction extends CAction{

	public function run(){
		$controller = $this->getController();
		$limit = 2;
		$data['total'] = Yii::app()->db->createCommand()
							->select("count(*) as total")
							->from("news")
							->queryRow()['total'];
		$data['news'] = Yii::app()->db->createCommand()
							->select("*")
							->from("news")
							->order("id desc")
							->limit("$limit,0")
							->queryAll();

	    $controller->render("news",$data);
	}
}