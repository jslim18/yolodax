<?php

class WelcomeController extends Controller{
		public $layout='//layouts/vcoin';

		public function filters(){

                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
                return array(
						array('deny',
                              'actions'=>array('profile','edit','getactiveorders'),
                              'users'=>array('admin','?'),
                              'deniedCallback' => function() {
												Yii::app()->user->logout();
												Yii::app()->session->open();								  
												Yii::app()->user->setFlash("error",Yii::t("messages","You have to login first!"));
												Yii::app()->controller->redirect(Yii::app()->request->baseUrl."/login");
							    }
                        ),
                        array('allow',
                              'actions'=>array('index','captcha','trade','tradeHistory','getbuyorders','getsellorders','gettotal','verify','password_reset'),
                              'users'=>array('*'),
                        ),
                        array('deny',
                              'actions'=>array('login','signup','forgot'),
                              'users'=>array('@'),
                              'deniedCallback' => function() {
								   Yii::app()->user->setFlash("info",Yii::t("messages","You are already logged-in!"));
								   Yii::app()->controller->redirect(Yii::app()->request->baseUrl."/user/profile"); 
								   }
                        ),

                );
        }

	public function actions(){
		return array(
			"index"				=> "application.controllers.welcome.IndexAction",
			"trade"				=> "application.controllers.welcome.TradeAction",
			"captcha"			=> array("class"=>"CCaptchaAction","backColor"=>0xFFFFFF),
			"signup"			=> "application.controllers.welcome.SignupAction",
			"login"				=> "application.controllers.welcome.LoginAction",
			"forgot"			=> "application.controllers.welcome.ForgotAction",
			"profile"			=> "application.controllers.welcome.ProfileAction",
			"edit" 				=> "application.controllers.welcome.UpdateAction",
			"error" 			=> "application.controllers.welcome.ErrorAction",
			"verify" 			=> "application.controllers.welcome.VerifyAction",
			"password_reset"	=> "application.controllers.welcome.PasswordResetAction",
			"tradeHistory"		=> "application.controllers.welcome.TradeHistoryAction",
			"getbuyorders"		=> "application.controllers.welcome.GetBuyOrdersAction",
			"getsellorders"		=> "application.controllers.welcome.GetSellOrdersAction",
			"gettotal"			=> "application.controllers.welcome.GetTotalAction",
			"gettradehistory" 	=> "application.controllers.welcome.GetTradeHistoryAction",
			"getactiveorders" 	=> "application.controllers.welcome.GetActiveOrdersAction",
			"useramount" 	=> "application.controllers.welcome.UserAmountStripAction",
		);
	}

}
