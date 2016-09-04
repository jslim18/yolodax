<?php
 $locked = $this->user_model->locked_data(@$this->session->userdata('uid'));
?>

<li class="widget color-blue hig" style="background:#fff;">  <div class="ancmnt" id="my_funds">
<div class="widget-head">	
<h3>My Funds </h3>
</div>
	<div class="widget-content">
                    <div class="ancmntbox">
	<table border="0" cellpadding="0" cellpadding="0" width="100%">
  <tr>
    <th>Type</th>
    <th>Balance</th>
    <th class="blue">Locked</th>
    <th>Totals</th>
  </tr>
  <tr>
    <td>BTC</td>
    <td><?=@$amounts->bitcoin?></td>
    <td><?=@($locked['bitcoin'])?@($locked['bitcoin']):0?></td>
    <td><?=@($amounts->bitcoin + $locked['bitcoin'])?></td>
  </tr>
  <tr>
    <td>LTC</td>
    <td><?=@$amounts->litecoin?></td>
    <td><?=@($locked['litecoin'])?@($locked['litecoin']):0?></td>
    <td><?=@($amounts->litecoin + $locked['litecoin'])?></td>
  </tr>
  <tr>
    <td>NMC</td>
    <td><?=@$amounts->namecoin?></td>
    <td><?=@($locked['namecoin'])?@($locked['namecoin']):0?></td>
    <td><?=@($amounts->namecoin + $locked['namecoin'])?></td>
  </tr>
  <tr>
    <td>USD</td>
    <td><?=@$amounts->USD?></td>
    <td><?=@($locked['USD'])?@($locked['USD']):0?></td>
    <td><?=@($amounts->USD + $locked['USD'])?></td>
  </tr>
  <tr>
    <td>EUR</td>
    <td><?=@$amounts->EUR?></td>
    <td><?=@($locked['EUR'])?@($locked['EUR']):0?></td>
    <td><?=@($amounts->EUR + $locked['EUR'])?></td>
  </tr>  
</table>

	</div>
 </div>
 </div>
</li>
