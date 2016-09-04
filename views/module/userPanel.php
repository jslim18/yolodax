   <div class="ancmnt">
	<div class="widget-head">
                  <h3>User panel</h3>
    </div>
	<div style="min-height:77px;" class="widget-content">
	<div class="ancmntbox">
	<ul class="usrpnllisting">
		<li><a href="<?=base_url()."user/trade_history"?>">My Trade History</a></li>
		<li><a href="<?=base_url()."user/order_history"?>">My Active Orders</a></li>
		<?php if($cinfo['coin']=='bitcoin'){?>
		<li><a href="<?=base_url()."user/funds"?>">BTC Deposit</a></li>
		<li><a href="<?=base_url()."user/funds"?>">BTC Withdraw</a></li>
		<?php }elseif($cinfo['coin']=='litecoin'){?>
		<li><a href="<?=base_url()."user/funds"?>">LTC Deposit</a></li>
		<li><a href="<?=base_url()."user/funds"?>">LTC Withdraw</a></li>
		<?php }elseif($cinfo['coin']=='namecoin'){?>
		<li><a href="<?=base_url()."user/funds"?>">NMC Deposit</a></li>
		<li><a href="<?=base_url()."user/funds"?>">NMC Withdraw</a></li>
		<?php }?>
	</ul>
	</div>
	</div>
    <div>
    </div>
    </div>
