<?php
class InstchatAction extends CAction{

	public function run(){
			$_POST['uid'] = Yii::app()->user->id;
			$username = Yii::app()->user->name;
			$q = $_POST['q'];
			$model = new ChatHistory;
			$model->user_id = Yii::app()->user->id;
			$text = "<li><h2>$username:</h2><span>&nbsp;$q</span></li>";
			$model->chat = $text;
			if($model->validate()){
				$model->save();
			}
	}
}