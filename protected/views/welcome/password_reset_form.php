
<div class="wrapper">
<div class="btcconm">


<div class="cntnm">
<div class="cntn">
<div class="mnhd">
<h1>Password reset</h1>
</div>
<form action="<?php echo $url;?>" method="post">
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken;?>" >
  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="rigister">
  <tr><td>
  <span style="color:#00FF00; font-weight:bold;">
  	<?php echo Yii::app()->user->getFlash("success"); ?>
  </span>
  <span style="color:#FF0000; font-weight:bold;">
  	<?php echo Yii::app()->user->getFlash("error1"); ?>
  </span>
  </td></tr>
   <tr>
     <td colspan="2"><input name="password" type="password" class="input1" style="width:250px;" placeholder="New Password"/></td>
     </tr>
	 <tr><td></td></tr>
   <tr>
    <td colspan="2"><input name="confirm_password" type="password" class="input1" style="width:250px;" placeholder="Confirm Password"/></td>
    </tr>   
   <tr><td></td></tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td align="center" valign="middle">&nbsp;</td>
   </tr>
   <tr>
     <td>
     <input type="submit"  value="Submit" class="orn" name="password_reset_submit"></td>
     <td>&nbsp;</td>
     <td align="center" valign="middle">&nbsp;</td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td align="center" valign="middle">&nbsp;</td>
   </tr>
</table>
  </form>

</div>
</div>

</div>
</div>

