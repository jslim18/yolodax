<script>
function ovver(msg){

var overlay = '<div id="blk_bkg_pop" style="position:fixed; z-index:499; left:0; top:0; right:0; bottom:0; background:#000; opacity:.9;">';
overlay += '<div class="ppblo">';
overlay += '<div class="ppma" style="width:auto;">';
overlay += '<div class="mnhd mnhd2" style="width:auto;">';
overlay += '<h2>'+msg+'&nbsp;<img src="images/loader64.gif" align="absmiddle" style="display:inline;float:right;"/></h2>';
overlay += '</div>';
overlay += '</div>';
overlay += '</div>';
overlay += '</div>';
	return overlay;
}


var BUY = null;
var SELL = null;
var BUYRATE = null;
var SELLRATE = null;
var TOTAL = null;
$(document).ready(function(){
callUserAmount();
	$('#buy').keyup(function(){
		var buy = Number($(this).val()).toFixed(8);
		var rate = Number($('#buy_rate').val()).toFixed(8);
		if(isNaN(buy)){
			$(this).css({border: "1px solid #FF0000"});
		}else if(buy < 0){
			$(this).css({border: "1px solid #FF0000"});
		}else{
			$(this).css({border: ""});
			BUY = buy; BUYRATE = rate;
			TOTAL = (BUY*BUYRATE).toFixed(8);
		 $('#buy_total,#all_total').html(TOTAL+"&nbsp;<?=$cinfo['hard']?>");
		}
	});
	$('#sell').keyup(function(){
		var sell = Number($(this).val()).toFixed(8);
		var rate = Number($('#sell_rate').val()).toFixed(8);
		if(isNaN(sell)){
			$(this).css({border: "1px solid #FF0000"});
		}else if(sell < 0){
			$(this).css({border: "1px solid #FF0000"});
		}else{
			$(this).css({border: ""});
			SELL = sell; SELLRATE = rate;
			TOTAL = (SELL*SELLRATE).toFixed(8);
		 $('#sell_total,#all_total').html(TOTAL+"&nbsp;<?=$cinfo['hard']?>");
		}
	});

	$('#buy_rate').keyup(function(){
		var buy = Number($('#buy').val()).toFixed(8);
		var rate = Number($(this).val()).toFixed(8);
		if(isNaN(buy)){
			$(this).css({border: "1px solid #FF0000"});
		}else if(buy < 0){
			$(this).css({border: "1px solid #FF0000"});
		}else{
			$(this).css({border: ""});
			BUY = buy; BUYRATE = rate;
			TOTAL = (BUY*BUYRATE).toFixed(8);
		 $('#buy_total,#all_total').html(TOTAL+"&nbsp;<?=$cinfo['hard']?>");
		}
	});
	$('#sell_rate').keyup(function(){
		var sell = Number($('#sell').val()).toFixed(8);
		var rate = Number($(this).val()).toFixed(8);
		if(isNaN(sell)){
			$(this).css({border: "1px solid #FF0000"});
		}else if(sell < 0){
			$(this).css({border: "1px solid #FF0000"});
		}else{
			$(this).css({border: ""});
			SELL = sell; SELLRATE = rate;
			TOTAL = (SELL*SELLRATE).toFixed(8);
		 $('#sell_total,#all_total').html(TOTAL+"&nbsp;<?=$cinfo['hard']?>");
		}
	});

	$('#do_buy').click(function(){
	$('#buy').val(0);
	$('#buy_total,#all_total').html("0&nbsp;<?=$cinfo['hard']?>");
	 var data = {buy:BUY,rate:BUYRATE,pair:"<?=$cpair ?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"}

	 if(BUY > 0 && TOTAL > 0 ){
	 <?php if(Yii::app()->user->id!=""){?>
	  	 $('.headerfull').after(ovver("Processing"));
	 $.ajax({url: "<?=Yii::app()->baseUrl."/user/buy"?>",
	 		data: data,
		    type: "post",
		 success: function(ret){
		  var RET = JSON.parse(ret);
		  if(RET.status == true){
			  setTimeout(function(){$('#blk_bkg_pop').remove();},1000);
		  work_to_buy(BUY*BUYRATE);
		   BUY = 0;
		  active_recursive();
		  buy_recursive();
		  callUserAmount();
		  }else{
			  $('#blk_bkg_pop').remove();
			  $('.headerfull').after(ovver(RET.message));
			  setTimeout(function(){$('#blk_bkg_pop').remove();},1000);
		  }
		  
		 }
	 })
	 <?php }else{?>
	 //$("#signin").click();
	 window.location.href= "<?php echo Yii::app()->baseUrl."/login"?>"
	 <?php }?>
	 }else{
	 	$('#buy').css({border: "2px solid #FF0000"});
	 }

	});
	$('#do_sell').click(function(){
	$('#sell').val(0);
	$('#sell_total,#all_total').html("0&nbsp;<?=$cinfo['hard']?>");
	 var data = {sell:SELL,rate:SELLRATE,pair:"<?=$cpair ?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"}
	 if(SELL > 0 && TOTAL > 0){
	 <?php if(Yii::app()->user->id!=""){?>
 	 $('.headerfull').after(ovver("Processing"));
	 $.ajax({url: "<?=Yii::app()->baseUrl."/user/sell"?>",
	 		data: data,
		    type: "post",
		 success: function(ret){
		  var RET = JSON.parse(ret);
		  if(RET.status == true){
			  setTimeout(function(){$('#blk_bkg_pop').remove();},1000);
		  work_to_sell(SELL);
		   SELL = 0;
		  buy_recursive();
		  active_recursive();
		  callUserAmount();
		  }else{
			  $('#blk_bkg_pop').remove();
			  $('.headerfull').after(ovver(RET.message));
			  setTimeout(function(){$('#blk_bkg_pop').remove();},1000);
		  }

		 }
	 })

	 <?php }else{?>
	 //$("#signin").click();
	 window.location.href= "<?php echo Yii::app()->baseUrl."/login"?>"
	 <?php }?>
	 
	 }else{
	 	$('#sell').css({border: "2px solid #FF0000"});
	 }
	 
	});
});



function callUserAmount(){
var data = {pair:"<?=$cpair ?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"}
$.ajax({url: "<?=Yii::app()->baseUrl."/welcome/useramount"?>",
	 		data: data,
		    type: "post",
		 success: function(ret){
		 	$("#userAmountStrip").html(ret);
		 }
	 })
}

function work_to_buy(lock){
var ac = Number($('#calc_hard').html());
var rem = (ac - Number(lock)).toFixed(8);
$('#calc_hard').html(""+rem);
}
function work_to_sell(lock){
var ac = Number($('#calc_coin').html());
var rem = (ac - Number(lock)).toFixed(8);
$('#calc_coin').html(""+rem);
}
</script>
<?php $amounts = json_decode(json_encode($amounts),1); ?>

<div class="calcboxmain" >
	<div class="clb1" id="userAmountStrip">

	</div>
	<div class="clb2">
		<p><?php echo @floatval($settings['ask'])?> <?=$cinfo['hard']?></p>
	</div>
	<div class="clb3">
		<p>bid :<span style="color:#3584eb; margin:0px;  float:none; font-weight:bold;" > <?= @floatval($settings['bid'])?> <?=$cinfo['hard']?></span> <span>ASk :<span style="color:#cd0000; margin:0px;  float:none;font-weight:bold;" > <?=@floatval($settings['ask'])?> <?=$cinfo['hard']?></span></span></p>
	</div>
	<div class="clb4">
		<input id="do_buy" type="button" value="Buy <?=$cinfo['coin_short']?>" class="clb4btn"/>
		<input id="buy" type="text" value="0" class="clb4inp"/>
		<span style="font-size:11px;">Quantity</span>
		<input id="buy_rate" type="text" value="<?=@floatval($settings['ask'])?>" class="clb4inp"/>
		<span style="font-size:11px;">Price</span>
		<p id="buy_total">0 <?=$cinfo['hard']?></p>
	</div>

	<div class="clb4">
		<input id="do_sell" type="button" value="Sell <?=$cinfo['coin_short']?>" class="clb4btn"/>
		<input id="sell" type="text" value="0" class="clb4inp"/>
		<span style="font-size:11px;">Quantity</span>
		<input id="sell_rate" type="text" value="<?=@floatval($settings['bid'])?>" class="clb4inp"/>
		<span style="font-size:11px;">Price</span>
		<p id="sell_total">0 <?=$cinfo['hard']?></p>
	</div>
	<div class="clb5">
		<p>Total: <span id="all_total">0 <?=$cinfo['hard']?> </span></p>
		<p>Fee: <span><?php echo $fee?>&nbsp;% </span></p>
	</div>
	</div>
