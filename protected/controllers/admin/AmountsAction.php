<?php
class AmountsAction extends CAction{

	private static $controller;
	public function run(){
		self::$controller = $this->getController();
	 $data['amounts'] = Yii::app()->db->createCommand()
	 				->select("a.*, u.username")
					->from("amounts a")
					->join("users u","u.id=a.user_id")
					->order("a.id desc")
					->queryAll();
	 $data['currs'] = Yii::app()->db->createCommand()
	 			->select("currency,currency_short")
				->from("ccurrencies")
				->queryAll();
	 self::$controller->render("/admin/amounts",$data);
	}
}