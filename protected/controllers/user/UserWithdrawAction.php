<?php
class UserWithdrawAction extends CAction{

	public function run(){
		$model = new Withdrawals;

		if(isset($_POST['Withdrawals'])){
			$model->attributes = $_POST['Withdrawals'];
			if($model->validate()){
				$model->save();
			 $msg = "<span style='color:#00FF00;'>Request has been saved successfully!</span>";
			 echo json_encode(array("msg"=>"success","result"=>$msg));
			}else{
			 $error = "<ul style='color:#FF0000;'>";
				if(count($model->getErrors()) > 0 ){foreach($model->getErrors() as $k){
					$error.="<li>".$k[0]."</li>";
				}}
			 $error .="</ul>";
			 echo json_encode(array("msg"=>"error","result"=>$error));
			}
		}
	}
}