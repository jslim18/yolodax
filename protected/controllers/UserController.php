<?php

class UserController extends Controller{
		public $layout='//layouts/vcoin';

		public function filters(){

                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
                return array(
						array('deny',
                              'actions'=>array('profile','logout','funds',"sell","buy","edit_profile",
							  					"deluserorder","change_password","avatar","trade_history",
												"order_history","user_order_history","load_cur",
												"withdraw","g2a"),
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
			"profile" 			=> "application.controllers.user.ProfileAction",
			"funds" 			=> "application.controllers.user.FundsAction",
			"sell"	 			=> "application.controllers.user.SellAction",
			"buy" 				=> "application.controllers.user.BuyAction",
			"edit_profile" 		=> "application.controllers.user.EditProfileAction",
			"logout" 			=> "application.controllers.user.LogoutAction",
			"deluserorder"		=> "application.controllers.user.DelUserOrderAction",
			"change_password"	=> "application.controllers.user.ChangePasswordAction",
			"avatar"			=> "application.controllers.user.AvatarAction",
			"load_cur"			=> "application.controllers.user.LoadCurAction",
			"withdraw"			=> "application.controllers.user.UserWithdrawAction",
			"g2a"				=> "application.controllers.user.GoogleAuthAction",
			"trade_history"		=> "application.controllers.user.TradeHistoryAction",
			"order_history"		=> "application.controllers.user.OrderHistoryAction",
			"withdraw_history"	=> "application.controllers.user.WithdrawHistoryAction",
			"user_order_history" => "application.controllers.user.UserOrderHistoryAction",
		);
	}

}
