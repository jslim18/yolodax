<?php
class GoogleAuthAction extends CAction{

	private static $model;
	private static $controller;

	public function run(){
		self::$controller = $this->getController();
	 $data['uri'] = 'user/g2a';

	 self::$controller->render('g2a',$data);
	}

}