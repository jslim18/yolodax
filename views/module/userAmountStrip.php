<script>
//setTimeout("location.reload(true);",2000);
</script>
<?php 
error_reporting(E_ALL);

$amounts = json_decode(json_encode($amounts),1);
?>
<p>
	<span id="calc_hard" style="float:left;">
		<?=(float)(@$amounts[$cinfo['hard']]-@$with[$cinfo['hard']])?></span><?=$cinfo['hard']?>
	<span>
	<span><?=' '.$cinfo['coin_short']?></span>
	<span id="calc_coin">
		<?=(float)(@$amounts[$cinfo['coin']]-@$with[$cinfo['coin']])?>
	</span>
</p>