<?php
class UsersViewAction extends CAction{

	private static $controller;
	private $user;
	public function run(){
		self::$controller = $this->getController();
	  $this->_usersAccountView();
	}

	private function _usersAccountView() {
		$uid = $_GET['uid'];
		$this->user = Users::model()->findByPk($uid);
		$this->user->setScenario("adUp");
		$this->user->password = '';
		$data['user'] = $this->user;
	 self::$controller->render("users_view_account",  $data);		
	}
}