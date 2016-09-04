<?php
class GetchatAction extends CAction{

	public function run(){
		 $uid = Yii::app()->user->id;
	error_reporting(0);
	 if(intval(trim($_POST['q'])) > 0){
	  $from = intval(trim($_POST['q']));
	 }else{
	  $from = 0;
	 }

	 $rt = ChatHistory::model()->get_chat($from);
	 $keys = array_keys($rt);
	 $str = implode("",$rt);
	 $last = @end($keys);
	 header("Content-type:json/application");
	 echo json_encode(array("text"=>$str,"last"=>$last));
	}

}