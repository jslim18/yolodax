<?php

class CcurrencyController extends Controller{
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
			"edit"				=> "application.controllers.ccurrency.EditAction",
			"add"				=> "application.controllers.ccurrency.AddAction",
			"list"				=> "application.controllers.ccurrency.ListAction",
			"delete"			=> "application.controllers.ccurrency.DeleteAction",
			"pair"				=> "application.controllers.ccurrency.PairAction",
			"pair_add"			=> "application.controllers.ccurrency.PairAddAction",
			"pair_edit"			=> "application.controllers.ccurrency.PairEditAction",
			"pair_delete"		=> "application.controllers.ccurrency.PairDeleteAction",
			"withdraw"			=> "application.controllers.ccurrency.WithdrawAction",
			"withdraw_complete"	=> "application.controllers.ccurrency.WithdrawCAction",
			"withdraw_cancel"	=> "application.controllers.ccurrency.WithdrawCdAction",
			"withdraw_export"	=> "application.controllers.ccurrency.WithdrawExportAction",
			"getmorerequests"	=> "application.controllers.ccurrency.LoadMoreAction",
			"trading"			=> "application.controllers.ccurrency.TradingAction",
			"commission"		=> "application.controllers.ccurrency.CommissionAction",
			"commission_edit"	=> "application.controllers.ccurrency.CommissionEditAction",
			"commission_delete"	=> "application.controllers.ccurrency.CommissionDeleteAction",
			"audit"				=> "application.controllers.ccurrency.AuditAction",
			"audit_wallet"		=> "application.controllers.ccurrency.AuditWalletAction",
			"import"			=> "application.controllers.ccurrency.ImportAction",
			"import_list"		=> "application.controllers.ccurrency.ImportListAction",
			"import_delete"		=> "application.controllers.ccurrency.ImportDeleteAction",
		);
	}

}