<?php

class VerifyAction extends CAction{

	public function run(){
	$controller = $this->getController();
	$email = @$_GET['u'];
	$code = @$_GET['c'];
		if($email && $code){
		$res = Yii::app()->db->createCommand()
					->select("id,email,verification_code")
					->from("users")
					->where("email=:email",array(":email"=>$email))
					->andWhere("verify=:verify",array(":verify"=>0))
					->andWhere(array("like","verification_code","%~~~$code~~~%"))
					->limit(1,0)
					->queryAll();
		  if(count($res)>0){
		   $res = $res[0];
  		    $bc = explode("~~~",$res['verification_code']);
			$code = md5("/".$res['email']."/".$res['id']."/".$bc[2]."/");
			if(CPasswordHelper::verifyPassword($code, $bc[0]) && $code==$bc[1]){
			$udp['verify']=1;
			$udp['status']=1;
			$udp['verification_code']='';
			Yii::app()->db->createCommand()
						->update("users",$udp,"id=:id",array(":id"=>$res['id']));

			 $controller->render("/welcome/account_verify");
			}else{
			 $controller->render("/welcome/session_expire");
			}
		  }else{
		    $controller->render("/welcome/session_expire");
		  }
		}else{
		 $controller->render("/welcome/404");
		}
	}


}