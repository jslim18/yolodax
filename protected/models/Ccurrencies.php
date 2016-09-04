<?php

/**
 * This is the model class for table "ccurrencies".
 *
 * The followings are the available columns in table 'ccurrencies':
 * @property string $id
 * @property string $currency
 * @property string $currency_short
 * @property integer $active
 * @property string $created
 */
class Ccurrencies extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ccurrencies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('currency, currency_short', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('currency_short', 'length',"min"=>3,"max"=>"5"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, currency, currency_short, active, created', 'safe', 'on'=>'search'),
		);
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
			'currency' => 'Currency',
			'currency_short' => 'Currency Short',
			'active' => 'Active',
			'created' => 'Created',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('currency_short',$this->currency_short,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ccurrencies the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function getDepositedAmount(){
		$res = Yii::app()->db->createCommand()
	 				->select("currency,sum(amount) as total")
					->from("addresses")
					->where("is_used=:iu",array(":iu"=>"yes"))
					->group("currency")
					->queryAll();
		$temp = array();
		foreach($res as $k){
			$temp[$k['currency']] = $k['total'];
		}
	 return $temp;
	}

	public function getUserBalances(){
	 $res = Yii::app()->db->createCommand()
				->select('currency')
				->from('ccurrencies')
				->queryAll();
		$tt = $curs = array();
		foreach($res as $k){
		 $cur = $k['currency'];
			$tt[] = "sum($cur) as $cur";
			$curs[$cur] = 0;
		}
	 $select = implode(",",$tt);
	 return array("curs"=>$curs,
	 			  "amt"=>Yii::app()->db->createCommand()
								->select("$select")
								->from("amounts")
								->queryRow());
	}

	public function getCommissions(){
	 $commB = Yii::app()->db->createCommand()
	 					->select("sum(commission) as buy_comm,currency")
						->from("transactions")
						->where(array("in","done_status",array('Partial','Done')))
						->andWhere("type=:ty",array(":ty"=>"BUY"))
						->group("currency")
						->queryAll();
	 $margin = Yii::app()->db->createCommand()
	 					->select("sum(hrd_c) as margin,hard_currency")
						->from("transactions")
						->where(array("in","done_status",array('Partial','Done')))
						->andWhere("type=:ty",array(":ty"=>"BUY"))
						->group("hard_currency")
						->queryAll();
	 $commS = Yii::app()->db->createCommand()
	 					->select("sum(hrd_c) as sell_comm,hard_currency")
						->from("transactions")
						->where(array("in","done_status",array('Partial','Done')))
						->andWhere("type=:ty",array(":ty"=>"SELL"))
						->group("hard_currency")
						->queryAll();
	$cb = $mr = $cs = array();
	$ch = Users::model()->ch();
	foreach($commB as $k){
		$cb[$k['currency']] = $k['buy_comm'];
	}
	foreach($margin as $k){
		$mr[$ch[$k['hard_currency']]] = $k['margin'];
	}
	foreach($commS as $k){
		$cs[$ch[$k['hard_currency']]] = $k['sell_comm'];
	}
	 return array("buy_comm"=>$cb,
	 			  "sell_comm"=>$cs,
				  "margin"=>$mr);
	}

	public function getActualCommission($curs){
		$com = $this->getCommissions();
		$total = array();
		foreach($com['buy_comm'] as $k=>$v){
			$curs[$k] = $curs[$k]+$v;
		}
		foreach($com['sell_comm'] as $k=>$v){
			$curs[$k] = $curs[$k]+$v;
		}
		foreach($com['margin'] as $k=>$v){
			$curs[$k] = $curs[$k]+$v;
		}
	 return $curs;
	}

}