<?php

class AdminController extends Controller{
		public $layout='//layouts/vadmin';

		public function filters(){		
                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
	
			$role = Yii::app()->user->getState('roles');
			$act = Yii::app()->db->createCommand()
						->select("m.actions")
						->from("permissions p")
						->join("my_acts m","m.id=p.act_id")
						->where("p.perms like '%$role=1,%'")
						->queryAll();
			$actions = array();
			foreach($act as $k){$actions[]=$k['actions'];}
			if(in_array($this->action->id,$actions) && ($role >= 1) ){return array( array("allow") );}
			elseif($this->action->id == "index" and ($role >= 1 or !isset($role)) ){return array( array("allow") );}
			else{

				if(!isset($role)){
					if( $this->action->id=="logsf" ){
						Yii::app()->user->logout();
						$this->redirect(Yii::app()->baseUrl."/admin");
					}elseif($this->action->id=="index"){
						//print_r($_POST);die;
					}else{$this->redirect(Yii::app()->baseUrl."/admin");}
				}
				elseif($role == 'user'){$this->redirect(Yii::app()->baseUrl."/user/profile");}
				else{return array( array("deny","deniedCallback"=>function(){
																	Yii::app()->controller->render("/admin/my404");
																	})
										 );
					}
			}
			
        }

	public function actions(){
		return array(
			"index"				=> "application.controllers.admin.IndexAction",
			"users"				=> "application.controllers.admin.UsersAction",
			"users_edit"		=> "application.controllers.admin.UsersEditAction",
			"users_view"		=> "application.controllers.admin.UsersViewAction",
			"trans"				=> "application.controllers.admin.TransAction",
			"settings"			=> "application.controllers.admin.SettingsAction",
			"admins"			=> "application.controllers.admin.AdminsAction",
			"admins_add"		=> "application.controllers.admin.AdminsAddAction",
			"admins_edit"		=> "application.controllers.admin.AdminsEditAction",
			"admins_delete"		=> "application.controllers.admin.AdminsDeleteAction",
			"amounts"			=> "application.controllers.admin.AmountsAction",
			"amounts_edit"		=> "application.controllers.admin.AmountsEditAction",
			"deposits"			=> "application.controllers.admin.DepositsAction",
			"roles"				=> "application.controllers.admin.RolesAction",
			"roles_add"			=> "application.controllers.admin.RolesAddAction",
			"roles_edit"		=> "application.controllers.admin.RolesEditAction",
			"roles_delete"		=> "application.controllers.admin.RolesDeleteAction",
			"permissions"		=> "application.controllers.admin.PermissionsAction",
			"contact_subject"	=> "application.controllers.admin.ContactSubjectAction",
			"contact_subject_edit"	=> "application.controllers.admin.ContactSubjectEditAction",
			"contact_subject_delete"=> "application.controllers.admin.ContactSubjectDeleteAction",
			"contact_requests"	=> "application.controllers.admin.ContactRequestsAction",
			"request"			=> "application.controllers.admin.RequestAction",
			"request_del"		=> "application.controllers.admin.RequestDeleteAction",
			"g2a"				=> "application.controllers.admin.GoogleAuthAction",
			"logsf"				=> "application.controllers.admin.LogsfAction",
			"logout"			=> "application.controllers.admin.LogoutAction",
		);
	}

}
