<?php

/**
 * This is the model class for table "withdrawals".
 *
 * The followings are the available columns in table 'withdrawals':
 * @property string $wid
 * @property string $user_id
 * @property string $amount
 * @property string $currency
 * @property string $currency_short
 * @property string $fee_charged
 * @property string $amount_received
 * @property string $address
 * @property string $status
 * @property string $created
 * @property string $updated
 */
class Withdrawals extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public $otp;
	public function tableName()
	{
		return 'withdrawals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		return array(
			array('user_id, amount, currency, currency_short, address', 'required'),
			array("amount","numerical","min"=>1),
			array("amount","checkSmall"),
			array("otp","checkOtp"),
		);
	}


	public function checkSmall(){
		$am = $this->amount;
		$uid = Yii::app()->user->getId();
		$amounts = Amounts::model()->find("user_id=:uid",array(":uid"=>$uid));
		$locked = Users::model()->locked_data($uid);
		$withdraw = Users::model()->withdraw_data($uid);
		$c = $this->currency;
		$av = @$amounts->$c - @$locked[$c] - @$withdraw[$c];
	  if($am > $av){
		  $this->addError('amount', Yii::t("validate","Amount cann't be greater than available!"));
	  }
	}
	
	public function checkOtp(){
	if(Yii::app()->user->getState("is_g2a") == "yes"){
		if($this->otp == ""){
			$this->addError('otp', Yii::t("validate","Password can't be blank!"));
			return true;
		}elseif(! Yii::app()->g2a->verify_key(Yii::app()->user->getState("secret"), $this->otp)){
			$this->addError('otp', Yii::t("validate","Wrong password!"));
			return true;
		}		
	}else{return true;}

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
			'wid' => 'Wid',
			'user_id' => 'User',
			'amount' => 'Amount',
			'currency' => 'Currency',
			'currency_short' => 'Currency Short',
			'fee_charged' => 'Fee Charged',
			'amount_received' => 'Amount Received',
			'address' => 'Address',
			'status' => 'Status',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria->compare('wid',$this->wid,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('currency_short',$this->currency_short,true);
		$criteria->compare('fee_charged',$this->fee_charged,true);
		$criteria->compare('amount_received',$this->amount_received,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Withdrawals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}