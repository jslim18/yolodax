<?php
class PasswordResetAction extends CAction{

	public function run(){
	$controller = $this->getController();
	$email = @$_GET['u'];
	$code = @$_GET['c'];
	$url = Yii::app()->getBaseUrl(true)."/welcome/password_reset?u=".$email."&c=".$code;
	$data['url'] = $url;
		if($email && $code){

		$res = Yii::app()->db->createCommand()
			 ->select(array("id","email","password_reset_code"))
			 ->from(array("users"))
			 ->where("email='$email' and password_reset='1' and password_reset_code like '%~~~$code~~~%'")
			 ->limit(1,0)
			 ->queryRow();

		  if($res){
  			$bc = explode("~~~",$res['password_reset_code']);
			$code = md5("/".$res['email']."/".$res['id']."/".$bc[2]."/");
			if(CPasswordHelper::verifyPassword($code,$bc[0]) && $code == $bc[1]){
			  if(isset($_POST['password_reset_submit'])){
			    if($_POST['password']=="" or $_POST['password']==NULL){
				Yii::app()->user->setFlash("error1","Password field can't be empty!");
				 $this->getController()->redirect($url);
				}elseif(strlen($_POST['password']) < 6){
				Yii::app()->user->setFlash("error1","Password should be at least 6 character long!");
				 $this->getController()->redirect($url);
				}elseif($_POST['password']==$_POST['confirm_password']){
				 $pl = $_POST['password'];
				 $bc = CPasswordHelper::hashPassword($pl);
				 $upd['password']=$bc;
				 $upd['confirm_password'] = $pl;
				 $upd['password_reset']='0';
				 $upd['password_reset_code']='';
				 Yii::app()->db->createCommand()
				 			->update("users",$upd,'id=:id',array(":id"=>$res['id']));
				 $this->getController()->render("/welcome/password_set");
				}else{
				Yii::app()->user->setFlash("error1","Passwords are not matching!");
				 $this->getController()->redirect($url);
				}
			  }else{
			   $this->getController()->render("/welcome/password_reset_form",$data);
			  }
			}else{
			 $this->getController()->render("/welcome/session_expire");
			}
		  }else{
		    $this->getController()->render("/welcome/session_expire");
		  }
		}else{
		 $this->getController()->render("/welcome/404");
		}
	}


}