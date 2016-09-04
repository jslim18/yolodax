<?php

class CCoinsConfigComponent extends CApplicationComponent{

	public function bitcoinConfig(){
		return array("coin"=>"bitcoin",
					 "user"=>"bitcoin_user",
					 "password"=>"bitcoin_password",
					 "port"=>"8332");
	}

	public function namecoinConfig(){
	return array("coin"=>"namecoin",
				 "user"=>"namecoin_user",
				 "password"=>"namecoin_password",
				 "port"=>"8336");
	}

	public function litecoinConfig(){
	return array("coin"=>"litecoin",
				 "user"=>"litecoin_user",
				 "password"=>"litecoin_password",
				 "port"=>"9432");
	}

	public function peercoinConfig(){
	return array("coin"=>"peercoin",
				 "user"=>"peercoin_user",
				 "password"=>"peercoin_password",
				 "port"=>"9876");
	}

}
?>
