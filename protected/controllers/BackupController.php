<?php

class BackupController extends Controller{
		public $layout='';

	public function actions(){
		return array(
			"take_backup"		=> "application.controllers.backup.TakeBackUpAction",
			"depositing"		=> "application.controllers.backup.DepositingAction",
			"confirming"		=> "application.controllers.backup.ConfirmingAction",
		);
	}

}