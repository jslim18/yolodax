<?php

class ApiController extends Controller{
		public $layout='//layouts/vcoin';

		public function filters(){

                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
                return array(
						array('deny',
                              'actions'=>array('api',),
                              'users'=>array('admin','?'),
                              'deniedCallback' => function() {
									Yii::app()->user->logout();
									Yii::app()->session->open();
									Yii::app()->user->setFlash("error",Yii::t("messages","You have to login first!"));
									Yii::app()->controller->redirect(Yii::app()->request->baseUrl."/login");
							    }
                        ),
                );
        }

	public function actions(){
		return array(
			"api" 			=> "application.controllers.api.ApiAction",
		);
	}

}
