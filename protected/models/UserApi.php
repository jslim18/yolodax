<?php

/**
 * This is the model class for table "user_api".
 *
 * The followings are the available columns in table 'user_api':
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $key
 * @property string $secret
 * @property string $permission
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserApi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_api';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id, key, secret, permission, status', 'required','message'=>Yii::t("validate","You should enter a value!")),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name','unique','message'=>Yii::t("validate","Api is already registered with this name!")),
			array('name','match',"pattern"=>'/^[a-z_0-9]+$/',"message"=>Yii::t("validate","Name should have lowercase,underscore and digits only!")),
			array('name','length','max'=>'50','min'=>'5',"message"=>Yii::t("validate","Name should contain 5-50 characters!"))

		);
	}


	protected function beforeValidate(){
		if(parent::beforeValidate()) {
			$uid = Yii::app()->user->id;
			$this->user_id = $uid;
			$this->key = $this->get_key($uid);
			$this->secret = $this->get_secret($uid);;
			$this->permission = 'info,';
			$this->status = '1';

		}
	 return true;	
	}

	private function get_key($uid=0){
	 $k = md5(time()+$uid);
	 return $k;
	}

	private function get_secret($uid=0){
	 return sha1(sha1("This is virtual-coin user_$uid api!!").'_'.sha1(time()));
	}

	public function update_app(){
	 $keys = @array_keys($_POST['perm']);
	 $uid = Yii::app()->user->id;
		$udp['permission'] = @implode(",",$keys);
		$id = $_POST['appid'];
		$udp['updated_at'] = date("Y-m-d H:i:s");
	 Yii::app()->db->createCommand()
	 		->update("user_api",$udp,"id=:id and user_id=:uid",array(":id"=>$id,":uid"=>$uid));
	}

	public function disable_app(){
	 $uid = Yii::app()->user->id;
	   $id = $_POST['appid'];
	   $udp['status'] = $_POST['stat'];
	   $udp['updated_at'] = date("Y-m-d H:i:s");
	 Yii::app()->db->createCommand()
	 		->update("user_api",$udp,"id=:id and user_id=:uid",array(":id"=>$id,":uid"=>$uid));
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
			'name' => 'Name',
			'user_id' => 'User',
			'key' => 'Key',
			'secret' => 'Secret',
			'permission' => 'Permission',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('secret',$this->secret,true);
		$criteria->compare('permission',$this->permission,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserApi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
