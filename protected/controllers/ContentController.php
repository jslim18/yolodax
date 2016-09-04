<?php

class ContentController extends Controller{
		public $layout='//layouts/vadmin';

		public function filters(){
                return array(
                        'accessControl',
                );
        }

        public function accessRules(){

			$role = Yii::app()->user->getState('roles');
			//$act = Yii::app()->db->createCommand("select m.actions from permissions p join my_acts m on (m.id=p.act_id) where p.perms like '%$role=1,%'")->queryAll();
			$act = Yii::app()->db->createCommand()
						->select("m.actions")
						->from("permissions p")
						->join("my_acts m","m.id=p.act_id")
						->where("p.perms like '%$role=1,%'")
						->queryAll();
			foreach($act as $k){@$actions[]=$k['actions'];}
			if(in_array($this->action->id,$actions) && ($role >= 1) ){return array( array("allow") );}
			elseif($this->action->id == "index" and ($role >= 1 or !isset($role)) ){return array( array("allow") );}
			else{
				if(!isset($role)){$this->redirect(Yii::app()->baseUrl."/admin");}
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
			"about"				=> "application.controllers.admin.AboutAction",
			"terms"				=> "application.controllers.admin.TermsAction",
			"add_news"			=> "application.controllers.admin.AddNewsAction",
			"list_news"			=> "application.controllers.admin.ListNewsAction",
			"delete_news"		=> "application.controllers.admin.DeleteNewsAction",
			"edit_news"			=> "application.controllers.admin.EditNewsAction",
		);
	}

}
