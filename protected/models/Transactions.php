<?php
class Transactions extends CActiveRecord
{
	public function tableName()
	{
		return 'transactions';
	}

	public function rules()
	{

		return array(
			array('user_id, pair, currency, currency_short, hard_currency, amount, rate, type, total, timestamp', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('pair', 'length', 'max'=>15),
			array('currency, hard_currency', 'length', 'max'=>255),
			array('currency_short', 'length', 'max'=>5),
			array('amount, rate, total, how_much', 'length', 'max'=>16),
			array('type', 'length', 'max'=>4),
			array('done_status', 'length', 'max'=>8),

			array('id, user_id, pair, currency, currency_short, hard_currency, amount, rate, type, total, how_much, done_status, timestamp', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}