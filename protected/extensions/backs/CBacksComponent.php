<?php

class CBacksComponent extends CApplicationComponent{
	private static $conn;
	private $tables;
	private $content;

	private function dataTables($tables = '*'){
		self::$conn = Yii::app()->db;
		self::$conn->createCommand("SET NAMES 'utf8'")->execute();
		if($tables == '*'){
			$tables = array();
			$result = self::$conn->createCommand('SHOW TABLES')->queryAll();
		  foreach($result as $row){ $tables[] = reset($row);}
		}else{ $tables = is_array($tables) ? $tables : explode(',',$tables); }
	  $this->tables = $tables;  	
	}

	private function backupContent(){
	 $this->dataTables();
		$return='';
		foreach($this->tables as $table){
			$result = self::$conn->createCommand("SELECT * FROM `$table`")->queryAll();
			$num_fields = @count($result[0]);
			$total = @count($result);
			$return.= 'DROP TABLE IF EXISTS `'.$table.'`;';

			$row2 = self::$conn->createCommand("SHOW CREATE TABLE `$table`")->queryRow();
			$return.= "\n\n".$row2['Create Table'].";\n\n";

			for ($i = 0; $i < $total; $i++){
					$row = array_values($result[$i]);
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) {
					  $row[$j] = addslashes($row[$j]);
					   $row[$j] = str_replace("\n","\\n",$row[$j]);
					  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					 if ($j<($num_fields-1)) { $return.= ','; }
					}
				  $return.= ");\n";
			}
			$return.="\n\n\n";
		}
	 $this->content = $return;
	}

	private function backupFile(){
	 $this->backupContent();	
		if(!is_dir("protected/backups")){
			mkdir("protected/backups",0777);
		}

		$handle = fopen('protected/backups/db-backup-'.date("Y_m_d_H_i_s").'.sql','w+');
	  fwrite($handle,$this->content);
	 fclose($handle);
	}

	public function backup_tables(){
		$this->backupFile();
	}

	public static function callme(){
		echo 'wowowo';
	}
}
?>
