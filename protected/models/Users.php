<?php

class Users extends CActiveRecord{

	public $verification_link;
	public $new_password1;
	public $new_password2;
	public $calls;
	
	
	public function tableName(){
		return 'users';
	}

	public function rules(){

		return array(
			array('username, password, email,IC,billing_address,phone_number,country', 'required',"message"=>Yii::t("validate", "Please enter value for {attribute}"),"on"=>"insert"),
			array("username,email,IC,phone_number","unique","message"=>Yii::t("validate","{attribute} already exists!"),"on"=>"insert"),
			array("email","email","message"=>Yii::t("validate","Email format is wrong!")),
			array( 'terms', 'required', 'requiredValue'=>1,"message"=>Yii::t("validate","You should accept the terms & conditions!"),"on"=>"insert"),
			array('username, password, email', 'length', 'max'=>128,"on"=>"insert"),
			//array('password','match',"pattern"=>'/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',"message"=>"Password must have 1 Uppercase, 1 lower case, 1 digit and 8 chars!"),
			array('confirm_password', 'required',"message"=>Yii::t("validate","Confirm password is required!"),"on"=>"insert"),
			array('confirm_password', 'compare', 'compareAttribute'=>'password',"message"=>Yii::t("validate","Passwords are not matching!"),"on"=>"insert"),
            array('confirm_password', 'length', 'min'=>6, 'max'=>40,'on'=>"insert"),
			array('captcha', 'activeCaptcha',"on"=>"insert"),

			array("password,IC,billing_address,phone_number,country","required","message"=>Yii::t("validate","Passsword is required!"),"on"=>"update"),
			array("email","required","message"=>Yii::t("validate","Email is required!"),"on"=>"update"),
			array("email","check_email","on"=>"update"),
			array("skype","check_skype","on"=>"update"),
			array("password","check_old_password","on"=>"update"),

			array('password, new_password1,new_password2', 'required',"message"=>Yii::t("validate","{attribute} is required!"),"on"=>"updatePass"),
			array('new_password1','length', 'min'=>6,'max'=>12,"message"=>Yii::t("validate","Password can contain 6-12 characters!"),"on"=>"updatePass"),
			array('new_password2', 'compare', 'compareAttribute'=>'new_password1',"message"=>Yii::t("validate","Passwords are not matching!"),"on"=>"updatePass"),
			array('password','check_old_password',"on"=>"updatePass"),

			array("email,IC,billing_address","required","on"=>"adUp"),
			array("email","email","on"=>"adUp"),
			array("email","unique","on"=>"adUp"),
			array("skype","check_skypeAD","on"=>"adUp"),

			array("avatar","file","on"=>"fileUpload","message"=>"Image is required!","types"=>"jpg,gif,png","wrongType"=>"This is not image file!"),
		);
	}

	public function check_skypeAD(){
	 if($this->skype != ""){
	  $res = Yii::app()->db->createCommand()
	  			->select("skype")
				->from("users")
				->where("skype=:skype",array(":skype"=>$this->skype))
				->andWhere("id<>:id",array(":id"=>$this->id))
				->queryAll();
	  if(sizeof($res)>0){
		  $this->addError('email', Yii::t("validate","This skype is already registered!"));
	  }
	 }else{return true;}

	}


	protected function beforeSave(){

		if(parent::beforeSave()){
			if($this->getScenario()=='insert'){
				$this->password = $this->hashPassword($this->password);
				//$this->confirm_password = "";
				return true;
			}elseif($this->getScenario()=='update'){
				$this->confirm_password = $this->password;
				$this->password = $this->hashPassword($this->password);
				return true;
			}elseif($this->getScenario()=='updatePass'){
				$this->confirm_password = $this->new_password1;
				$this->password = $this->hashPassword($this->new_password2);
				return true;
			}elseif($this->getScenario()=='adUp'){
				$this->confirm_password = $this->password;
				$this->password = $this->hashPassword($this->password);
				return true;
			}
			
		return true;
		}else{
			return false;
		}
	}

	private function verification_email(){
		$data['user'] = $this->username;
		$data['link'] = $this->verification_link;
	//$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
	$sub = 'Account verification - CryptoCoinExchange';
	$temp = '/welcome/verification';
	$this->sendMail('pkumar.sgit143@gmail.com',$this->email,$sub,$temp,$data);
	}

	public function sendMail($from,$to,$sub,$temp,$data){
	$mailer = Yii::app()->mailer;
	$mailer->Host = 'smtp.gmail.com';
	$mailer->IsSMTP();
	$mailer->IsHTML(true);
	$mailer->SMTPAuth = true;
	$mailer->SMTPSecure = "ssl";

	$mailer->From = $from;
	$mailer->FromName = 'CryptCoinExchagne';
	$mailer->AddReplyTo('no-reply@cryptocoinexchange.com');
	$mailer->AddAddress($to);
	$mailer->Port = "465";
	$mailer->Username = Yii::app()->params["smtpUser"];
	$mailer->Password = Yii::app()->params["smtpPass"];
	$mailer->Subject = $sub;

	$mailer->Body = Yii::app()->controller->renderPartial($temp, $data,true);
	$mailer->Send();
	}

	private function verification_link(){
	$t = time();
	$code = md5("/" . $this->email . "/" . $this->id . "/".$t."/");
	$bc = $this->hashPassword($code)."~~~".$code."~~~".$t;
	 $this->verification_link = Yii::app()->getBaseUrl(true)."/welcome/verify?u=".$this->email."&c=".$code;
	 $this->verification_code = $bc;
	 $this->verification_email();
	}

	protected function afterSave(){
		$session = Yii::app()->session;
		$prefixLen = strlen(CCaptchaAction::SESSION_VAR_PREFIX);
		foreach($session->keys as $key){
				if(strncmp(CCaptchaAction::SESSION_VAR_PREFIX, $key, $prefixLen) == 0)
						$session->remove($key);
		}
	  if($this->isNewRecord){
		  $this->verification_link();
		  $c = $this->verification_code;
		  $uid = $this->id;
		  $udp['verification_code'] = $c;
		  Yii::app()->db->createCommand()->update("users",$udp,"id=:id",array(":id"=>$uid));
	   $amounts = new Amounts;
	   $amounts->user_id = $this->id;
	   $amounts->save();
	  }
	}

	public function check_email(){
		$email = $this->email;
		$uid = Yii::app()->user->id;
	  $res = Yii::app()->db->createCommand()
	  			->select("email")
				->from("users")
				->where("email=:email and id<>:uid",array(":email"=>$email,":uid"=>$uid))
				->queryAll();
	  if(sizeof($res)>0){
		  $this->addError('email', Yii::t("validate","This email is already registered!"));
	  }
	}

	public function check_skype(){
		$skype = $this->skype;
		$uid = Yii::app()->user->id;
	  $res = Yii::app()->db->createCommand()
	  			->select("skype")
				->from("users")
				->where("skype=:skype and id<>:uid",array(":skype"=>$skype,":uid"=>$uid))
				->queryAll();
	  if(sizeof($res)>0){
		  $this->addError('skype', Yii::t("validate","This skype is already registered!"));
	  }
	}

	public function check_old_password(){
		$p = $this->password;
		$uid = Yii::app()->user->id;
		$res = Yii::app()->db->createCommand()
	  			->select("password")
				->from("users")
				->where("id=:uid",array(":uid"=>$uid))
				->queryRow();
		if(! CPasswordHelper::verifyPassword($this->password,$res['password'])){
			$this->addError('password', Yii::t("validate","Wrong password!"));
		}
	}

	public function activeCaptcha(){
		$code = Yii::app()->controller->createAction('captcha')->verifyCode;
		if ($code != $this->captcha)
			$this->addError('captcha', Yii::t("validate","Wrong value of captcha!"));
	}

	public function relations(){
		return array(
		);
	}

	public function locked_data($uid){
	  $res1 = Yii::app()->db->createCommand()
	  			->select("currency,sum(amount-how_much-commission) as amount")
				->from("transactions")
				->where("type=:type",array(":type"=>'SELL'))
				->andWhere("user_id=:uid",array(":uid"=>$uid))
				->andWhere(array("in","done_status",array('Partial','Not_Done')))
				->group("currency")
				->queryAll();

	  	  $res2 = Yii::app()->db->createCommand()
	  			->select("hard_currency as currency,sum(total-(rate*how_much)-(rate*commission)) as amount")
				->from("transactions")
				->where("type=:type",array(":type"=>'BUY'))
				->andWhere("user_id=:uid",array(":uid"=>$uid))
				->andWhere(array("in","done_status",array('Partial','Not_Done')))
				->group("hard_currency")
				->queryAll();
	  $rt = array();
	  if($res1 != null){
		foreach($res1 as $kk){
			$rt[$kk['currency']] = floatval($kk['amount']);
		}  
	  }
	  if($res2 != null){
		foreach($res2 as $kk){
			$rt[$kk['currency']] = floatval($kk['amount']);
		}  
	  }
	  $ch = $this->ch();
	  foreach($rt as $k=>$v){
		  $rt[$ch[$k]]=$v;
	  }
	  return $rt;
	}

	public function withdraw_data($uid=0){
	  $res = Yii::app()->db->createCommand()
						->select("sum(amount) as amount,currency")
						->from("withdrawals")
						->where("user_id=:uid",array(":uid"=>$uid))
						->andWhere("status!=:sta",array(":sta"=>"cancelled"))
						->group("currency")
						->queryAll();

	  $rt = array();
	  if($res != null){foreach($res as $kk){
		$rt[$kk['currency']] = floatval($kk['amount']);
	  }}
	  $ch = $this->ch();
	  foreach($rt as $k=>$v){
		  @$rt[$ch[$k]]=$v;
	  }
	  return $rt;
	}

	public function validatePassword($password){
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	public function hashPassword($password){
		return CPasswordHelper::hashPassword($password);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/* code in yii */

	public function get_curset($coin,$hard){
	 $res = Yii::app()->db->createCommand()
	 			->select('max(t.rate) as ask,min(t.rate)as bid, x.last_rate')
				->from("transactions t,(select rate as last_rate from transactions where currency ='$coin' and hard_currency = '$hard' order by id desc) as x")
				->where('t.currency=:coin',array(":coin"=>$coin))
				->andWhere('hard_currency=:hard',array(":hard"=>$hard))
				->queryAll();
	 return $res;
	}

	public function currency_type($ex){
	  $res = Yii::app()->db->createCommand()
	  			->select('cp.cpair_one, cp.cpair_two, cp.cpair_slug, cp.is_trading, c1.currency as one,c1.currency_short as one_short,c2.currency as two,c2.currency_short as two_short')
				->from("ccurrency_pair cp")
				->join("ccurrencies c1","c1.currency=cp.cpair_one")
				->join("ccurrencies c2","c2.currency=cp.cpair_two")
				->queryAll();
		if(count($res)>0){foreach($res as $k){
			$exchange[$k['cpair_slug']] = array("coin"=>$k['cpair_one'],"hard"=>$k['two_short'],"coin_short"=>$k['one_short'],"is_trading"=>$k['is_trading']);
			}
		}
	 return $exchange[$ex];
	}

	public function ch($c=null){
		$res = Yii::app()->db->createCommand()
				->select('currency,currency_short')
				->from('ccurrencies')
				->queryAll();
		foreach($res as $k){
			$tt[$k['currency']] = $k['currency_short'];
			$tt[$k['currency_short']] = $k['currency'];
		}
		if($c==null){return $tt;}else{return $tt[$c];}
	}

	public function get_user_amount($uid=0){
	$data = Yii::app()->db->createCommand()
					->select("*")
					->from("amounts")
					->where("user_id=:uid",array(":uid"=>$uid))
					->limit(1,0)
					->queryRow();

	$res = Yii::app()->db->createCommand()
				->select("*")
				->from("ccurrencies")
				->queryAll();

	foreach($res as $kk){
		$temp[$kk['currency']] = $kk['currency_short'];
	}
	if($data != null){
	foreach($data as $k=>$v){
	 if(array_key_exists($k,$temp) ){
		$tt[$k] = $v;
		$tt[$temp[$k]] = $v;
	 }else{
		$tt[$k] = $v;
	 }
	}}
	
	return @$tt;
	}

	public function get_user_calc($uid,$cur=""){
	$amounts = $this->get_user_amount($uid);
	$lock = $this->locked_data($uid);
	$c = new stdClass();
	if($amounts != null){
	foreach($amounts as $k=>$v){
		if(array_key_exists($k,$lock) ){
			$c->$k = @($v-$lock[$k]);
		}else{$c->$k = $v;}
	}}
	$amounts = $c;	
	return $amounts;
	}

	public function get_sell_orders($coin,$hard,$uid=0){
	$where = '';
	if($uid!=0){
	 //$where .= " and user_id<>$uid";
	}
	 $query = Yii::app()->db->createCommand()
	 			->select("rate,type, sum(amount-how_much-commission) as amount,rate,currency")
				->from("transactions")
				->where("type='SELL'")
				->andWhere("currency=:coin",array(":coin"=>$coin))
				->andWhere("hard_currency=:hard $where",array(":hard"=>$hard))
				->andWhere(array("in","done_status",array('Partial','Not_Done')))
				->group("rate")
				->order("rate asc")
				->queryAll();
		return $query;
	}

	public function get_buy_orders($coin,$hard,$uid=0){
	$where = '';
	if($uid!=0){
	 //$where .= " and user_id<>$uid";
	}
	 	 $query = Yii::app()->db->createCommand()
	 			->select("rate,type, sum(amount-how_much-commission) as amount,rate,currency")
				->from("transactions")
				->where("type='BUY'")
				->andWhere("currency=:coin",array(":coin"=>$coin))
				->andWhere("hard_currency=:hard $where",array(":hard"=>$hard))
				->andWhere(array("in","done_status",array('Partial','Not_Done')))
				->group("rate")
				->order("rate desc")
				->queryAll();
		return $query;
	}

	public function trade_history($coin,$hard,$id=0){
	 $query = Yii::app()->db->createCommand()
	 			->select("*")
				->from("transactions")
				->where("currency=:coin",array(":coin"=>$coin))
				->andWhere("hard_currency=:hard",array(":hard"=>$hard))
				->andWhere("id>:id",array(":id"=>$id))
				->andWhere(array("in","done_status",array('Done')))
				->order("timestamp desc")
				->queryAll();

	 return $query;
	}

	public function get_user_orders($uid,$pair="all",$type="all",$stat="all"){
	$where = '';
	if($pair!="all"){
	 $where.= " and pair='$pair'";
	}
	if($type!="all"){
	 $where.= " and type='$type'";
	}
	if($stat!="all"){
	 $where.=" and done_status='$stat'";
	}

		$q = Yii::app()->db->createCommand()
				->select("*")
				->from("transactions")
				->where("user_id=:uid $where",array(":uid"=>$uid))
				->order("timestamp")
				->queryAll();
	 return $q;
	}

	public function get_user_active_orders($uid,$pair){
	 $q = Yii::app()->db->createCommand()
	 			->select("id,type,user_id,currency,currency_short, hard_currency,rate, (amount-how_much-commission) as amountt, timestamp")
				->from("transactions")
				->where("user_id=:uid",array(":uid"=>$uid))
				->andWhere("pair=:pair",array(":pair"=>$pair))
				->andWhere(array("in","done_status",array('Not_Done','Partial')))
				->order("timestamp")
				->queryAll();
	 return $q;
	}
	
	public function get_high_low($pair='btc_usd',$to='ALL'){
	$cinfo = $this->currency_type($pair);
	$coin = $cinfo['coin'];
	$hard = $cinfo['hard'];
	$d_limit = NULL;
	if($to!="All"){
	 $time = @strtotime($to,time());
	 $d_limit = "and unix_timestamp(timestamp) < $time";
	}																																													

	$mm = Yii::app()->db->createCommand()
			->select("min(rate) as min,max(rate) as max, DATE_FORMAT(timestamp,'%Y-%m-%d') as created_day")
			->from("transactions")
			->where("currency=:coin",array(":coin"=>$coin))
			->andWhere("hard_currency=:hard $d_limit",array(":hard"=>$hard))
			->group("created_day")
			->order("timestamp")
			->queryAll();
	$op = Yii::app()->db->createCommand()
			->select("rate as open,DATE_FORMAT(timestamp,'%Y-%m-%d') as created_day")
			->from("transactions")
			->where("currency=:coin",array(":coin"=>$coin))
			->andWhere("hard_currency=:hard $d_limit",array(":hard"=>$hard))
			->group("created_day")
			->order("timestamp")
			->queryAll();
	$cl = Yii::app()->db->createCommand()
			->select("rate as close,DATE_FORMAT(timestamp,'%Y-%m-%d') as created_day")
			->from("transactions")
			->where("id in (select max(id) as id from transactions  where currency='$coin' and hard_currency='$hard' $d_limit group by DATE_FORMAT(timestamp,'%Y-%m-%d'))")
			->group("created_day")
			->order("timestamp")
			->queryAll();
			$ret = array();$i=0;
			if(count($mm)>0){
			foreach($mm as $k){
			 $ret[] = array('date'=>date("d.m.Y",strtotime($k['created_day'])),
			 				"min"=>$k['min'],
							"open"=>$op[$i]['open'],
							"close"=>$cl[$i]['close'],
							"max"=>$k['max']);
			  $i++;
			 }
			}
	return $ret;
	}	

	function get_total($pair){
		$res = Yii::app()->db->createCommand()
				->select("sum(`amount`-`how_much`-`commission`) as amount, sum(`total`-(`rate`*`how_much`) -(`rate`*`commission`)) as total")
				->from("transactions")
				->where("pair=:pair",array(":pair"=>$pair))
				->andWhere(array("in","done_status",array('Partial','Not_Done')))
				->queryRow();
		return $res;
	}

	public function getCommissionRate($pair = null){
		$comm = Yii::app()->db->createCommand()
					->select("commission")
					->from("commission")
					->where("pair=:pair",array("pair"=>$pair))
					->queryRow();
		return $comm['commission'];
	}

	public function do_buy_for_user(){
	$uid = $_POST['user_id'];
	$buy = floatval($_POST['buy']);
	$rate = floatval($_POST['rate']);
	$total = $buy * $rate;
	$cinfo = $this->currency_type($_POST['pair']);
	$comm = $this->getCommissionRate($_POST['pair']);
	$ch = $this->ch();

		$model = new Transactions;
		$model->user_id=$uid;
		$model->pair=$_POST['pair'];
		$model->currency=$cinfo['coin'];
		$model->currency_short=$cinfo['coin_short'];
		$model->hard_currency=$cinfo['hard'];
		$model->amount=$buy;
		$model->rate=$rate;
		$model->type="BUY";
		$model->total=$total;
		$model->timestamp=date("Y-m-d H:i:s");
		$model->save();
		$record_id = $model->id;
	
	 $this->do_user_trade("SELL",$rate,$cinfo['coin'],$cinfo['hard'],$buy,$uid,$record_id,$ch[$cinfo['hard']],$comm);
	}

	public function do_sell_for_user(){
	$uid = $_POST['user_id'];
	$sell = floatval($_POST['sell']);
	$rate = floatval($_POST['rate']);
	$total = $sell * $rate;
	$cinfo = $this->currency_type($_POST['pair']);
	$comm = $this->getCommissionRate($_POST['pair']);
	$ch = $this->ch();
	
		$model = new Transactions;
		$model->user_id=$uid;
		$model->pair=$_POST['pair'];
		$model->currency=$cinfo['coin'];
		$model->currency_short=$cinfo['coin_short'];
		$model->hard_currency=$cinfo['hard'];
		$model->amount=$sell;
		$model->rate=$rate;
		$model->type="SELL";
		$model->total=$total;
		$model->timestamp=date("Y-m-d H:i:s");
		$model->save();
		$record_id = $model->id;
	
	$this->do_user_trade("BUY",$rate,$cinfo['coin'],$cinfo['hard'],$sell,$uid,$record_id,$ch[$cinfo['hard']],$comm);
	}

	private function do_user_trade($type,$rate,$coin,$hard,$amount,$user_id,$record_id,$ch,$comm){
	
	$o_amount = (float)$amount;
	 if($type == "BUY"){
	$res = Yii::app()->db->createCommand()
			->select("id,(amount-how_much-commission) as am1,user_id,rate")
			->from("transactions")
			->where("type=:type",array(":type"=>$type))
			->andWhere("currency=:coin",array(":coin"=>$coin))
			->andWhere("hard_currency=:hard",array(":hard"=>$hard))
			->andWhere("rate>=:rate",array(":rate"=>$rate))
			->andWhere(array("in","done_status",array('Partial','Not_Done')))
			//->andWhere("user_id<>:user_id",array(":user_id"=>$user_id))
			->group("rate")
			->order("rate desc")
			->limit(1,0)
			->queryAll();
	 }
	 if($type == "SELL"){
	$res = Yii::app()->db->createCommand()
			->select("id,(amount-how_much-commission) as am1,user_id,rate")
			->from("transactions")
			->where("type=:type",array(":type"=>$type))
			->andWhere("currency=:coin",array(":coin"=>$coin))
			->andWhere("hard_currency=:hard",array(":hard"=>$hard))
			->andWhere("rate<=:rate",array(":rate"=>$rate))
			->andWhere(array("in","done_status",array('Partial','Not_Done')))
			//->andWhere("user_id<>:user_id",array(":user_id"=>$user_id))
			->group("rate")
			->order("rate")
			->limit(1,0)
			->queryAll();
	 }

	 if(count($res)>0){
		$trans = Yii::app()->db->beginTransaction();
		try{
	   $am1 = (float)floatval($res[0]['am1']);
	   $id1 = $res[0]['id'];
	   $uid1 = $res[0]['user_id'];
	   $rate1 = $res[0]['rate'];

		  if( round($am1,8) <= round($amount,8) && round($amount,8) > 0){
		   $amount = round(floatval($amount),8)-round(floatval($am1),8);
		   $cm = (round(floatval($am1),8)*round(floatval($comm),8))/100.0;
			$hrdc1 = abs($am1*(round(floatval($rate1),8)-round(floatval($rate),8)));
			$hrdc = ($am1*$rate1*round(floatval($comm),8))/100.0;
		   $cmd=Yii::app()->db->createCommand("update transactions set done_status='Done', how_much= how_much+$am1-$cm, commission=commission+$cm,hrd_c=hrd_c+if(type='BUY',$hrdc1,$hrdc) where id='$id1'")->execute();

			$inc = round(floatval($am1),8) * round(floatval($rate),8);
			$inc1 = round(floatval($am1),8) * round(floatval($rate1),8);
			$incm = (round(floatval($inc),8)*round(floatval($comm),8))/100.0;
			$incm1 = (round(floatval($inc1),8)*round(floatval($comm),8))/100.0;
		   if($type == "BUY"){

			   $hard1 = $ch;
			$cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin-$am1 ,$hard1=$hard1+$inc-$incm where user_id='$user_id'")->execute();
			$cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin+$am1-$cm, $hard1=$hard1-$inc1 where user_id='$uid1'")->execute();
		   }else{
			   $hard1 = $ch;
			$cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin+$am1-$cm, $hard1=$hard1-$inc where user_id='$user_id'")->execute();
			$cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin-$am1, $hard1=$hard1+$inc1-$incm1 where user_id='$uid1'")->execute();
		   }
			$hrdc1 = abs($am1*(round(floatval($rate1),8)-round(floatval($rate),8)));
			$hrdc = ($am1*$rate*round(floatval($comm),8))/100.0;
			   if($amount == 0){
			   $cm = (round(floatval($o_amount),8)*round(floatval($comm),8))/100.0;
			   $cmd=Yii::app()->db->createCommand("update transactions set done_status='Done', how_much= how_much+$o_amount-$cm,commission=commission+$cm, hrd_c=hrd_c+if(type='BUY',$hrdc1,$hrdc) where id='$record_id'")->execute();
			   }else{
				$cm = (round(floatval($am1),8)*round(floatval($comm),8))/100.0;
				$cmd=Yii::app()->db->createCommand("update transactions set done_status='Partial',how_much =how_much+$am1-$cm,commission=commission+$cm, hrd_c=hrd_c+if(type='BUY',$hrdc1,$hrdc) where id='$record_id'")->execute();
			   }
		  }
		  elseif(round($amount,8) > 0){
		   $remain = round(floatval($am1),8)-round(floatval($amount),8);
		   $cm = (round(floatval($amount),8)*round(floatval($comm),8))/100.0;
			$hrdc1 = abs($amount*(round(floatval($rate1),8)-round(floatval($rate),8)));
			$hrdc = ($amount*$rate*round(floatval($comm),8))/100.0;
		   $cmd=Yii::app()->db->createCommand("update transactions set done_status='Done',how_much= how_much+$amount-$cm,commission=commission+$cm, hrd_c=hrd_c+if(type='BUY',$hrdc1,$hrdc) where id='$record_id'")->execute();

			$inc = round(floatval($amount),8) * round(floatval($rate),8);
			$inc1 = round(floatval($amount),8) * round(floatval($rate1),8);
			$incm = (round(floatval($inc),8)*round(floatval($comm),8))/100.0;
			$incm1 = (round(floatval($inc1),8)*round(floatval($comm),8))/100.0;

		  if($type=="BUY"){
			  $hard1 = $ch;
		   $cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin-$amount, $hard1=$hard1+$inc-$incm where user_id= '$user_id'")->execute();
		   $cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin+$amount-$cm, $hard1= $hard1-$inc1 where user_id= '$uid1'")->execute();
		  }else{
			  $hard1 = $ch;
		   $cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin+$amount-$cm, $hard1=$hard1-$inc where user_id= '$user_id'")->execute();
		   $cmd=Yii::app()->db->createCommand("update amounts set $coin=$coin-$amount, $hard1=$hard1+$inc1-$incm1 where user_id= '$uid1'")->execute();
		  }
			$hrdc1 = abs($amount*(round(floatval($rate1),8)-round(floatval($rate),8)));
			$hrdc = ($amount*$rate1*round(floatval($comm),8))/100.0;
			$amount = 0;
		   $cmd=Yii::app()->db->createCommand("update transactions set done_status='Partial',how_much= $am1+how_much-$remain-$cm,commission=commission+$cm,hrd_c=hrd_c+if(type='BUY',$hrdc1,$hrdc) where id='$id1'")->execute();
		 }
		$trans->commit();
		}catch(Exception $ex){$trans->rollback();}

		 if(round($amount,8) > 0){
		  $this->do_user_trade($type,$rate,$coin,$hard,$amount,$user_id,$record_id,$ch,$comm);
		 }else{return true;}

	 }else{return true;}
	}

}