<?php
class PermissionsAction extends CAction{

	private static $controller;
	private static $model;
	private $message;

	public function run(){
	 self::$controller = $this->getController();
	 $data['roles'] = Roles::model()->findAll();
	 if(isset($_POST['update_perms'])){
		 foreach($_POST['act'] as $k=>$v){
			 $temp ="";
			 foreach($data['roles'] as $rl){
				$temp .= (@$v[$rl->id][0]=="on") ? @$rl->id."="."1" : @$rl->id."="."0";
				$temp .= ",";
			 }
				@$acts[$k] = $temp;
		 }
		 $trans = Yii::app()->db->beginTransaction();
		 try{

		foreach($acts as $k=>$v){
		/*
		$udp['perms'] = $v;
		 Yii::app()->db->createCommand()
		 		->update("permissions",$udp,"act_id=:aid",array(":aid",$k));
		 */
		 Yii::app()->db->createCommand("update permissions set perms='$v' where act_id='$k'")->execute();
		}
		$trans->commit();
		}catch(Exception $ex){$trans->rollback();}
	 }
	$data['acts'] = Yii::app()->db->createCommand()
						->select("m.controllers,m.actions,p.act_id,p.perms")
						->from("my_acts m")
						->leftJoin("permissions p","p.act_id=m.id")
						->order("m.controllers")
						->queryAll();
	 self::$controller->render('/admin/permissions',$data);
	}

	private function allRoles(){
	 $allRoles = Roles::model()->findAll();
	 $roles = array(""=>"-Select-");
	 if(count($allRoles)>0 ){foreach($allRoles as $k){$roles[$k['id']]=$k['role_name'];}}
	 return $roles;
	}

	private function saveAdmins(){
		self::$model->attributes = $_POST['Admins'];
		if(self::$model->validate()){
			if(self::$model->save()){$this->refresh();}
		}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
		self::$controller->redirect(Yii::app()->baseUrl."/admin/admins");
	}

}
