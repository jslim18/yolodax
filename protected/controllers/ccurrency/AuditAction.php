<?php
class AuditAction extends CAction{

	private $controller;

	public function run(){
	 $this->controller = $this->getController();
		 $data['deposited'] = Ccurrencies::model()->getDepositedAmount();
		 $bl =  Ccurrencies::model()->getUserBalances();
		 $data['balances'] = $bl['amt'];
		 $data['curs'] = $bl['curs'];
		 $data['commission'] = Ccurrencies::model()->getActualCommission($bl['curs']);

	 $this->controller->render('audit',$data);
	}

}