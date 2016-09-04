<?php

class TradeAction extends CAction{	

	public function run(){
	$uid = Yii::app()->user->id;
	$av_pair = Yii::app()->db->createCommand()
				->select("cpair_slug")
				->from("ccurrency_pair")
				->queryAll();
	$pair = (@$_GET['pair'])?$_GET['pair']:@$av_pair[0]['cpair_slug'];
	$cinfo = Users::model()->currency_type($pair);
	$data['fee'] = Users::model()->getCommissionRate($pair);
	  if(count($cinfo)>0){
		if($uid){
			$data['cpair'] = $pair;
			$data['av_pair'] = $av_pair;
			$data['cinfo'] = $cinfo;
			$data['amounts'] = Users::model()->get_user_calc($uid,$cinfo['coin']);
			$data['with'] = Users::model()->withdraw_data($uid);
			$data['settings'] = Users::model()->get_curset($cinfo['coin'],$cinfo['hard']);
			Yii::app()->controller->render('/user/user_trade',$data);
		}else{
			$data['cpair'] = $pair;
			$data['av_pair'] = $av_pair;
			$data['cinfo'] = $cinfo;
			$data['amounts'] = Users::model()->get_user_calc(0,$cinfo['coin']);
			$data['settings'] = Users::model()->get_curset($cinfo['coin'],$cinfo['hard']);
			Yii::app()->controller->render('/welcome/user_trade',$data);
		}
	  }else{
		redirect("/trade");
	  }

	}
	
	
}