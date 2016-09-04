<?php
class GoogleAuthAction extends CAction{

	private static $controller;
	public function run(){
	 self::$controller = $this->getController();
	 self::$controller->render('/admin/g2a');
	}
}