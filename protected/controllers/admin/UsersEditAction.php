<?php
class UsersEditAction extends CAction{

	private static $controller;
	private $user;
	public function run(){
		self::$controller = $this->getController();
	  $this->_usersAccountEdit();
	}

	private function _usersAccountEdit() {
		$uid = $_GET['uid'];
		$this->user = Users::model()->findByPk($uid);
		$this->user->setScenario("adUp");
		if(isset($_POST['Users'])){
			$this->updateUser();
		}
		$this->user->password = '';
		$data['user'] = $this->user;
	 self::$controller->render("users_edit_account",  $data);		
	}

	private function updateUser(){
	 $u = $_POST['Users'];
	 $this->user->email = $u['email'];
	 $this->user->skype = $u['skype'];
	 $this->user->verify = $u['verify']?1:0;
	 $this->user->status = $u['status']?1:0;
	 $this->user->is_g2a = $u['is_g2a']?"yes":'no';
	 $this->user->IC_status = $u['IC_status']?"yes":"no";
	 $this->user->billing_address_status = $u['billing_address_status']?"yes":"no";
 	 $this->user->password = $_POST['password'];
	 if($this->user->validate()){
	//echo '<pre>'; print_r($this->user);die;
		 $this->user->save();
	  Yii::app()->user->setFlash("success","User information has been updated successfully!");
	  self::$controller->redirect(Yii::app()->getBaseUrl()."/admin/users/?action=edit");
	 }
	}

}