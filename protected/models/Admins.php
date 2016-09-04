<?php

/**
 * This is the model class for table "admins".
 *
 * The followings are the available columns in table 'admins':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $plain
 * @property string $timestamp
 */
class Admins extends CActiveRecord{
	public $new_password;
	public $confirm_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admins';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password,new_password,confirm_password', 'required',"on"=>"settings"),
			array("email","email","on"=>"settings"),
			array("email,username","unique","on"=>"settings"),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password',"message"=>Yii::t("validate","Passwords are not matching!"),"on"=>"settings"),
			array("password","old_checkup","on"=>"settings"),

			array("username,email,password,role,confirm_password","required","on"=>"admins"),
			array("email","email","on"=>"admins"),
			array("email,username","unique","on"=>"admins"),
			array("password","length","max"=>20,"min"=>6,"on"=>"admins"),
			array('confirm_password', 'compare', 'compareAttribute'=>'password',"message"=>Yii::t("validate","Passwords are not matched!"),"on"=>"admins"),

			array("username,email,role","required","on"=>"adminss"),
			array("email","email","on"=>"adminss"),
			array("email,username","unique","on"=>"adminss"),
			array("password","checkPass","on"=>"adminss"),

			array('id, username, email, password, plain, timestamp', 'safe', 'on'=>'search'),
		);
	}

	public function old_checkup(){
		$p = $this->password;
		$uid = Yii::app()->user->id;
		$res = Yii::app()->db->createCommand()
				->select("password")
				->from("admins")
				->where("id=:uid",array(":uid"=>$uid))
				->queryRow();
		if(! CPasswordHelper::verifyPassword($this->password,$res['password'])){
			$this->addError('password', Yii::t("validate","Wrong password!"));
		}
	}
	
	public function checkPass(){
		if($this->password!=""){
			if($this->password != $this->confirm_password){
				$this->addError('confirm_password', Yii::t("validate","Passwords are not matchedd!"));
			}
		}
	}

	protected function beforeSave(){
		if(parent::beforeSave()){
			if($this->getScenario()=='settings'){
				$this->password = CPasswordHelper::hashPassword($this->new_password);
				$this->plain = $this->confirm_password;
			}elseif($this->getScenario()=='admins'){
				$this->password = CPasswordHelper::hashPassword($this->password);
				$this->plain = $this->confirm_password;
			}elseif($this->getScenario()=='adminss'){
				if($this->password != ""){
					$this->password = CPasswordHelper::hashPassword($this->password);
					$this->plain = $this->confirm_password;
				}
			}
		return true;
		}else{
			return false;
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'plain' => 'Plain',
			'timestamp' => 'Timestamp',
		);
	}

	public function validatePassword($password){
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('plain',$this->plain,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	function get_the_user($uid = 0) {
		return Yii::app()->db->createCommand()
				->select("*")
				->from("users")
				->where("id=:uid",array(":uid"=>$uid))
				->limit(1,0)
				->queryRow();
	}

	function the_users_api($uid, $offset = 0, $limit = 25) {
		return Yii::app()->db->createCommand()
				->select("user_api.*, users.username")
				->from("user_api")
				->join("users","users.id=user_api.user_id")
				->where("user_id=:uid",array(":uid"=>$uid))
				->queryAll();
	}

	function get_users_transactions($offset = 0, $limit = 25,  $where = null) {
		
	$trans = Yii::app()->db->createCommand()
		->select('transactions.*, users.username')
		->from('transactions')
		->join('users', 'users.id=transactions.user_id')
		->where($where)
		->limit($limit,$offset)
		->queryAll();

		return $trans;
	}

	function the_users_transactions($uid, $offset = 0, $limit = 25, $where = null) {
	$trans = Yii::app()->db->createCommand()
				->select('transactions.*, users.username')
				->from('transactions')
				->join('users', 'users.id=transactions.user_id')
				->where($where)
				->limit($limit,$offset)
				->queryAll();
	 return $trans;
	}

	function get_trans_calc($duration = 'today') {

		if( ! date_default_timezone_get())
			date_default_timezone_set('Asia/Kolkata');

		switch($duration) {
			case 'year':
				$tm_from = strtotime('now - 1 year');
				$tm_to = strtotime('now');
			break;
			case 'month':
				$tm_from = strtotime('now - 1 month');
				$tm_to = strtotime('now');
			break;
			case 'week':
				$tm_from = strtotime('now - 1 week');
				$tm_to = strtotime('now');
			break;
			case 'today':
			default:
				$tm_from = strtotime('now - 1 day');
				$tm_to = strtotime('now');
			break;
		}
		
		$date_range = (object) array(
			'from' => $tm_from,
			'to' => $tm_to
		);
		$resultSet = Yii::app()->db->createCommand()
						->select("t1.currency, t1.currency_short, count(t1.currency) as transactions, t1.type, t1.timestamp")
						->from("(SELECT * FROM transactions AS t2 WHERE UNIX_TIMESTAMP(t2.timestamp) >= $tm_from AND UNIX_TIMESTAMP(t2.timestamp) <= $tm_to ) AS t1")
						->group("t1.currency")
						->queryAll();
		$data = array (
			'date_range' => $date_range,
			'core_trans' => $resultSet
		);

		return $data;
	}

	function get_trans_currency_calc($duration = 'today', $where = null) {
		// Check default timezone
		if( ! date_default_timezone_get())
			date_default_timezone_set('Asia/Kolkata');
		// calculate duration
		switch($duration) {
			case 'year':
				$tm_from = strtotime('now - 12 month');
				$tm_to = strtotime('now');
			break;
			case 'month':
				$tm_from = strtotime('now - 1 month');
				$tm_to = strtotime('now');
			break;
			case 'week':
				$tm_from = strtotime('now - 1 week');
				$tm_to = strtotime('now');
			break;
			case 'today':
			default:
				$tm_from = strtotime('now - 1 day');
				$tm_to = strtotime('now');
			break;
		}
		
		$date_range = (object) array(
			'from' => $tm_from,
			'to' => $tm_to
		);
		$and_where = null;
		if( is_null($where) or empty($where) ) {
			$and_where = null;
		}else if( is_array($where) ){
			foreach($where as $column => $value) {
				$and_where .= " AND `t2`.`". $column . "` = '" .$value . "'";
			}
		}
		$resultSet = Yii::app()->db->createCommand()
					->select("t1.currency, t1.currency_short, count(t1.type) as transactions, t1.type, t1.timestamp")
					->from("( SELECT * FROM transactions AS t2 WHERE UNIX_TIMESTAMP(t2.timestamp) >= $tm_from AND UNIX_TIMESTAMP(t2.timestamp) <= $tm_to $and_where) AS t1")
					->group("t1.currency, t1.type")
					->queryAll();
		// response data
		$data = array (
			'date_range' => $date_range,
			'core_trans' => $resultSet
		);
	 return $data;
	}

	function get_ccurrencies($offset = 0, $limit = 25){
		return Yii::app()->db->createCommand()
				->select("*")
				->from("ccurrencies")
				->order("id")
				->limit($limit,$offset)
				->queryAll();
	}

	function get_the_ccurrency($cid) {
		return Yii::app()->db->createCommand()
				->select("*")
				->from("ccurrencies")
				->where("id=:cid",array(":cid"=>$cid))
				->limit(1,0)
				->queryRow();
	}

	function get_all_ccurrencies() {
		return Yii::app()->db->createCommand()
					->select("*")
					->from("ccurrencies")
					->queryAll();
	}

	function get_ccurrency_pairs($offset = 0, $limit = 25) {
		return Yii::app()->db->createCommand()
				->select("*")
				->from("ccurrency_pair")
				->order("pid desc")
				->limit($limit,$offset)
				->queryAll();
	}

	function get_withdraw_request($offset, $limit, $status){
		$resultSet = Yii::app()->db->createCommand()
						->select("withdrawals.*, users.username")
						->from("withdrawals")
						->join("users","users.id=withdrawals.user_id")
						->where(array("in","withdrawals.status",$status))
						->limit($limit,$offset)
						->queryAll();
	 return $resultSet;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admins the static model class
	 */

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

}