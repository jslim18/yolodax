<?php
class DelUserOrderAction extends CAction{

	public function run(){
		$uid = Yii::app()->user->id;
		if($uid != ""){
			$id = substr($_POST['q'],3);
			$res = Yii::app()->db->createCommand()
							->select("done_status")
							->from("transactions")
							->where("id=:id",array(":id"=>$id))
							->andWhere("user_id=:uid",array(":uid"=>$uid))
							->limit(1,0)
							->queryRow();
			if($res['done_status'] == "Not_Done"){
$trans = Yii::app()->db->beginTransaction();
	try{/*			
		Yii::app()->db->createCommand()
			->delete("transactions","id=:id and user_id=:uid",array(":id"=>$id,":uid"=>$uid));
		*/
		Yii::app()->db->createCommand("delete from transactions where id='$id' and user_id='$uid' and done_status='Not_Done'")->execute();
		$trans->commit();
	}catch(Exception $ex){$trans->rollback();}
			}elseif($res['done_status'] == "Partial"){
$trans = Yii::app()->db->beginTransaction();
try{
	Yii::app()->db->createCommand("update transactions set done_status='Done',amount=(how_much+commission) where id='$id'")->execute();
	$trans->commit();
}catch(Exception $ex){$trans->rollback();}
			}

			echo json_encode(array("status"=>"ok","msg"=>"Done"));die;
		}
	}	
}