<style>
.newpllomain{float:left;width:100%;padding:50px 0px;margin:12px 0px;}
.newpllo{width:395px; margin:0 auto;float:none;}
.mnhd2new h2{color:#6d6d6d !important;}
</style>
<script>
$(document).ready(function(){
	var x =	Math.round(+new Date()/1000);
	$("input[name=tt]").val(x);
});
</script>
<div class="wrapper">
<div class="newpllomain">
<div class="newpllo">
<div class="ppma ppmanew">
<div class="mnhd mnhd2 mnhd2new">
<h2><?php echo Yii::t("validate","Step 2");?></h2>
</div>
<form action="" method="post">
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken;?>" />

<table width="100%" cellspacing="0" cellpadding="5" border="0" class="rigister rigister2">
	<tbody>
	
	<tr>
		<td colspan="0">
		<input type="hidden" name="tt" value="" />
		<input type="password" name="otp" class="input1 inputnon" placeholder="OTP password!" />
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;">
		 <?php echo @$error;?>
		</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td valign="middle" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td><input type="submit" name="otp_auth" class="reg_submit" value="<?php echo Yii::t("validate","Verify!") ?>">&nbsp;
		</td>
		<td>&nbsp;</td>
		<td valign="middle" align="center">&nbsp;</td>
	</tr>
</tbody></table>
</form>
                            </div>
</div>
</div>
</div>
