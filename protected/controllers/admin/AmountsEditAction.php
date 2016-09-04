<?php
class AmountsEditAction extends CAction{

	private static $controller;

	public function run(){
		self::$controller = $this->getController();
	 $id = @$_GET['id'];
	 $data['id']=$id;
	 if(isset($_POST['amount_edit']) && isset($_POST['Amounts'])){
		$am = Amounts::model()->find('user_id=:user_id and id=:id', array(':user_id'=>$_POST['Amounts']['user_id'],":id"=>$id));

		/*
		foreach($_POST['Amounts'] as $k=>$v){
		
		}
		print_r($_POST['Amounts']);die;
		*/
		$am->setAttributes($_POST['Amounts']);
		$am->setScenario("adUpdate");
		if($am->validate()){
		  $am->saveAttributes($_POST['Amounts']);
		  $this->refresh();
		}
	  $data['model'] = $am;
	 }
	 $data['amounts'] = Yii::app()->db->createCommand()
							->select("a.*, u.username")
							->from("amounts a")
							->join("users u","u.id=a.user_id")
							->where("a.id=:id",array(":id"=>$id))
							->order("a.id desc")
							->limit(1,0)
							->queryRow();
	 $data['currs'] = Yii::app()->db->createCommand()
							->select("currency, currency_short")
							->from("ccurrencies")
							->queryAll();
	 self::$controller->render("/admin/amounts_edit",$data);
	}

	private function refresh(){
		Yii::app()->user->setFlash("success","User amount has been updated successfully!");
		self::$controller->redirect(Yii::app()->baseUrl."/admin/amounts");
	}
}