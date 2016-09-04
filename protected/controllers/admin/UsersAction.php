<?php
class UsersAction extends CAction{

	private static $controller;
	private $user;
	public function run(){
		self::$controller = $this->getController();
		$action = $_GET['action'];
		switch($action){
			case 'edit':
				$this->_usersEdit($action);
			break;
			case 'usr_api':
				$this->_usersAPIEdit($action);
			break;
			case 'apis':
				$this->_usersAPIs($action);
			break;
			case 'trans':
				$this->_usersTransactions($action);
			break;
			case 'usr_trans':
				$this->_usersTransactionEdit($action);
			break;
			case 'acc_mverified':
				$this->_usersAccountMadeVerified($action);
			break;
			default:
				echo '<h2>Invalid action.</h2>';
			break;
		}
	}

	private function _usersEdit($action = null) {
	$criteria=new CDbCriteria();
		$count=Users::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		$data['total'] = $count;
		$data['pages'] = $pages;
		$data['users']=Users::model()->findAll($criteria);

	self::$controller->render("users_edit",$data);
	}

	private function _usersAPIs($action = null) {
		$limit = 20;
	$criteria=new CDbCriteria();
		$count=UserApi::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;
	 $data['apis']=Yii::app()->db->createCommand()
	 				->select("user_api.*,users.username")
					->from("user_api")
					->join("users","users.id=user_api.user_id")
					->limit($limit,$offset)
					->queryAll();
					
	 $data['action'] = $action;
	self::$controller->render("users_apis",$data);
	}

	private function _usersAPIEdit($action = null) {
		$uid = $_GET['uid'];
		$data['action'] = $action;

		$data['user'] = Admins::model()->get_the_user($uid);
		$apis = Admins::model()->the_users_api($uid);
		$data['total'] = count($apis);
		$data['apis'] = $apis;
	 self::$controller->render("users_apis",  $data);
	}

	private function _usersTransactions($action) {
		$page = @$_GET['page'];
		$where = $request = $_GET;
		unset($where['page']);
		unset($where['action']);
	 $limit = 20;
	 $bh = array();
		if(is_array($where)){foreach($where as $k=>$v){$bh[]="`$k`='$v'";}}
	 	$criteria=new CDbCriteria();
	 	$criteria->condition = implode(" and ",$bh);
		$count=Transactions::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;

		$data['query_string'] = json_encode((object)$request);
		$data['where'] = $where;
		$data['action'] = $action;
		$myw = array("and");
		if(is_array($where)){foreach($where as $k=>$v){$myw[]="`$k`='$v'";}}

		$data['transactions'] = Admins::model()->get_users_transactions($offset, $limit, $myw);
		$data['pairs'] = Yii::app()->db->createCommand()
							->select("cpair_slug")
							->from("ccurrency_pair")
							->queryAll();
	 self::$controller->render("users_transactions",  $data);
	}

	private function _usersTransactionEdit($action) {
		$uid = @$_GET['uid'];
		$page = @$_GET['page'];
		$where = $request = $_GET;
		unset($where['page']);
		unset($where['action']);
	 $limit = 20;
	 $bh = array();
	    $where['user_id']=$where['uid'];
	    unset($where['uid']);
		if(is_array($where)){foreach($where as $k=>$v){$bh[]="`$k`='$v'";}}
	 	$criteria=new CDbCriteria();
	 	$criteria->condition = implode(" and ",$bh);
		$count=Transactions::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=$limit;
		$pages->applyLimit($criteria);
	 $data['total'] = $count;
	 $data['pages'] = $pages;
		$offset = @$_GET['page'] ? ($_GET['page']-1)*$pages->pageSize : 0;

		$data['query_string'] = json_encode((object)$request);
		$data['where'] = $where;
		$data['action'] = $action;
		$myw = array("and");
		$myw[]="`user_id`='$uid'";
		if(is_array($where)){foreach($where as $k=>$v){$myw[]="`$k`='$v'";}}

		$data['transactions'] = Admins::model()->the_users_transactions($uid, $offset, $limit, $myw);
		$data['pairs'] = Yii::app()->db->createCommand()
					->select("cpair_slug")
					->from("ccurrency_pair")
					->queryAll();
	 self::$controller->render("users_transactions",  $data);
	}
}