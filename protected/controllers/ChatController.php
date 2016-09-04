<?php

class chatController extends Controller{
		public $layout='none';

		public function filters(){

                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
                return array(
						array('deny',
                              'actions'=>array('instChat'),
                              'users'=>array('admin','?'),
                              'deniedCallback' => function() {
									Yii::app()->user->logout();
									Yii::app()->session->open();								  
									Yii::app()->user->setFlash("error",Yii::t("messages","You have to login first!"));
									Yii::app()->controller->redirect(Yii::app()->request->baseUrl."/login");
							    }
                        ),
                        array('allow',
                              'actions'=>array('getChat'),
                              'users'=>array('*'),
                        ),

                );
        }

	public function actions(){
		return array(
			"getChat"		=> "application.controllers.chat.GetchatAction",
			"instChat"		=> "application.controllers.chat.InstchatAction",
		);
	}

}
