<?php 
  $hidden = array(

	'min_limit' => $min_limit,
	'max_limit' => $max_limit,
	'Withdrawals[user_id]' => $user_id,
	'Withdrawals[fee_charged]' => $fee,
	'Withdrawals[currency]' => $currency,
	'Withdrawals[currency_short]' => $currency_short,
	'amount_available' => $btc
  );
?>
<script type="text/javascript">
 
function send(){
 
   var data=$("#form_withdraw").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("user/withdraw"); ?>',
   data:data,
success:function(data){
				var dd = JSON.parse(data);
                $("#errors").html(dd.result);
				if(dd.msg == "success"){
					$("#loading_cur").fadeOut(2000);
				 window.location.reload();
				}
              },
   error: function(data) {
         alert("Error occured.please try again");
    },
 
  dataType:'html'
  });
 
}
 
</script>
<div id="errors" style="width:100%;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->baseUrl."/user/withdraw",
        'id'=>'form_withdraw',
		'htmlOptions'=>array('onsubmit'=>"send();return false;","style"=>"float:left;"),
        ));
	if(isset($hidden)){foreach($hidden as $k=>$v){
	echo "<input type='hidden' value='$v' name='$k' />";
	}}
?>
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
	<td width="60%" align="left" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
		  <tr>
			<td colspan="2" align="left" valign="top">
				<p>Withdrawal <?php echo $currency_short;?></p>
				<p id="err"></p>
			</td>
		  </tr>
		  <tr>
			<td width="46%" align="left" valign="top" class="bl">Available funds:</td>
			<td width="54%" align="left" valign="top">
				<strong>
					<a id="ac_cur" href="javascript:void(0)" class="blue"><?php echo (float)$btc;?></a> <?php echo $currency_short;?>
				</strong>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" class="bl">Expended limit:</td>
			<td align="left" valign="top"><?php echo $min_limit;?> <?php echo $currency_short;?> &ndash; <?php echo $max_limit;?> <?php echo $currency_short;?></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" class="bl">Hash address:</td>
			<td align="left" valign="top">
	<input name="Withdrawals[address]" placeholder="<?php echo $currency_short;?> Address*" class="input_withdrow" maxlength="50"/>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" class="bl">Amount to withdrawal:</td>
			<td align="left" valign="top">
				<input name="Withdrawals[amount]" placeholder="Amount*" type="text" size="10" class="currency input_withdrow"/>&nbsp;<?php echo $currency_short;?>
			</td>
		  </tr>
		  <?php if(Yii::app()->user->getState("is_g2a") == "yes"){?>
		  <tr>
			<td align="left" valign="top" class="bl">Your OTP:</td>
			<td align="left" valign="top">
				<input name="Withdrawals[otp]" placeholder="Password*" type="text" size="10"/>&nbsp;
			</td>
		  </tr>
		  <?php } ?>
		  <tr>
			<td align="left" valign="top" class="bl" colspan="2">
				<input name="request" type="submit" class="button1" value="Withdrawal" />
			</td>
		  </tr>
		  
		</table>
	</td>
	<td width="40%" align="left" valign="middle">
		<div class="notes">
		 * Min amount for withdrawal - <?php echo $min_limit;?> <?php echo $currency_short;?>. <br />
		 * Be patient, transfer of funds will be before the first confirmation. <br />
		 * Daily limit on withdrawal - <?php echo $max_limit;?> <?php echo $currency_short;?>. <br />
		 * Processing will be completed within 72 hours.
		</div>
	</td>
  </tr>
</table>
<?php $this->endWidget();?>

