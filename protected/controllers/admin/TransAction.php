<?php
class TransAction extends CAction{

	private static $controller;

	public function run(){
		self::$controller = $this->getController();
		$action = $_GET['action'];
		switch($action) {
			case 'chart':
				$this->_transChart($action);
			break;
			case 'cchart':
				$this->_transChartData($action);
			break;
			case 'chart_tdata':
				$this->_transChartData($action);
			break;
			default:
				echo '<h2>Invalid action.</h2>';
			break;
		}
	}

	private function _transChart($action) {
		$trans = array();
		$request = @$_GET;
		$ctitle = 'Cryptocurrency Trading Chart';
		$duration = (@$_GET['dur'])?$_GET['dur']:'today';
		$trans_calc = Admins::model()->get_trans_calc($duration);		
		$data = $trans_calc;
		foreach($trans_calc['core_trans'] as $t)  {
			$trans[] = array(
				$t['currency_short'],
				(int) $t['transactions']
			);
		}
		$data['query_string'] = json_encode((object)$request);
		$data['dur'] = $request;
		$data['ctitle'] = $ctitle;
		$data['trans'] = $trans;
	 self::$controller->render("trans_chart",  $data);
	}
	
	private function _transChartData($action) {
		$request = @$_GET;
		$referer = $_SERVER['HTTP_REFERER'];
		$where = null;
		
		$cryptocurrency = array(
			'btc' => 'bitcoin',
			'ltc' => 'litecoin',
			'nmc' => 'namecoin'
		);
		
		$currency = @$_GET['currency'];
		$duration = (@$_GET['dur'])?$_GET['dur']:'today';
		$ctitle = 'Cryptocurrency';
		
		if($request) {
			if( array_key_exists($currency, $cryptocurrency) ) {
				$ctitle .= ' "'. strtoupper($currency) . '" ';
				$where['currency'] = $cryptocurrency[$currency];
			}
		}		
		$ctitle .= 'Trading PieChart';
		$trans = array( array(
			'Type',
			'No. of Transaction'
		) );
		$trans_calc = Admins::model()->get_trans_currency_calc($duration, $where);		
		$data = $trans_calc;
		foreach($trans_calc['core_trans'] as $t)  {
			$trans[] = array(
				$t['type'],
				(int) $t['transactions']
			);
		}
		$data['query_string'] = json_encode((object)$request);
		$data['dur'] = $request;
		$data['ctitle'] = $ctitle;
		$data['trans'] = $trans;
		$data['back'] = $referer;
	 self::$controller->render("trans_chart_currency",  $data);
	}
}