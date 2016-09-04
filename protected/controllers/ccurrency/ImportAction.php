<?php

class ImportAction extends CAction{

	public $controller;
	private static $model;
	private $message;
	private $files;
	private $currency;
	private $Addresseslist;

	public function run(){
	 $this->controller = $this->getController();

	 $data['currency'] = Yii::app()->db->createCommand()
									->select("currency")
									->from("ccurrencies")
									->queryAll();

	 $data['model'] = self::$model = new ImportedFiles;
	 if(isset($_POST['upload_submit'])){
		self::$model->attributes = $_POST['ImportedFiles'];
		self::$model->files = CUploadedFile::getInstance(self::$model,'files');
		self::$model->timestamp = date("Y-m-d H:i:s");
		if( self::$model->validate() ){
		 $t = date("Y_m_d_H_i_s")."_".self::$model->files->name;

		 self::$model->files->saveAs("./imports/".$t);
		 self::$model->files = $t;
		 $this->currency = self::$model->currency;
		 $this->files = "./imports/".$t;
			 if( self::$model->save() ){
			  $this->importingFile();
			  $this->message = "File has been imported successfully!";
			  $this->refresh();
			}
		}
	 }

	 $this->controller->render("import",$data);
	}

	private function importingFile(){
	 $i=0;$keys=array();$output=array();$add = array();$lines= array();
		$handle=fopen($this->files, "r");
		if($handle){
			 while(($line = fgetcsv($handle)) !== false){
				$i++;
				if($i==1){$keys=$line;}
				elseif($i>1){
					$attr=array();
					if(! in_array(@$line[1],$add)){
						foreach($line as $k=>$v){
							$attr[strtolower($keys[$k])]=$v;
						}
					}
				 $add[] = @$line[1];
				 $attr['currency'] = $this->currency;
				 $attr['uploaded_file'] = $this->files;
				 $attr['timestamp'] = date("Y-m-d H:i:s");
					 if(sizeof($attr)==5){
						 $output[]=$attr;
					 }
				}
			 }
		 fclose($handle);
		}
	 if(sizeof($output)>0){
	  $this->Addresseslist = $output;
	  $this->importingToDb();
	 }else{
	  return true;
	 }
	}

	private function importingToDb(){
	$trans = Yii::app()->db->beginTransaction();
	 try{
		 foreach($this->Addresseslist as $k){
		  try{
		   Yii::app()->db->createCommand()
					 ->insert("imports",$k);
			}catch(Exception $ex){}
		 }
	  $trans->commit();
	 }catch(Exception $ex){$trans->rollback();}
	}

	private function refresh(){
		Yii::app()->user->setFlash("success",Yii::t("messages",$this->message));
	 $this->controller->redirect(Yii::app()->getBaseUrl()."/ccurrency/import");
	}


}