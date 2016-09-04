<style>
.newpllomain{float:left;width:100%;padding:50px 0px;margin:12px 0px;}
.newpllo{overflow:hidden;width:395px; margin:0 auto;float:none;}
.ppmanew{border-left: 3px solid #D6D6D6 !important; border: 1px solid #D6D6D6; border-right:1px solid #D6D6D6;width:350px; }
.mnhd2new h2{color:#6d6d6d !important;}
</style>
<div class="wrapper">
<div class="newpllomain">
<div class="newpllo">
<div class="ppma ppmanew">
<div class="mnhd mnhd2 mnhd2new">
<h2><?php echo Yii::t("validate","Forgot Password");?></h2>
</div>
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'forgot-form',
	'enableAjaxValidation'=>true,
)); ?>
<table width="100%" cellspacing="0" cellpadding="5" border="0" class="rigister rigister2">
	<tbody>
	<?php if(Yii::app()->user->hasFlash("success") or Yii::app()->user->hasFlash("error")):?>
	<tr>
		<td>
			<span style="color:#FF0000; font-weight:bold;"><?php echo Yii::app()->user->getFlash("error");?></span>
			<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
		</td>
	</tr>
	<?php endif;?>
	<tr>
		<td colspan="0">
		<?php echo $form->textField($model,'email',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Your email!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'email'); ?></div>
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td valign="middle" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td><input type="submit" name="forgot" class="reg_submit" value="<?php echo Yii::t("validate","Send") ?>">&nbsp;
			
		</td>
		<td>&nbsp;</td>
		<td valign="middle" align="center">&nbsp;</td>
	</tr>
</tbody></table>
<?php $this->endWidget(); ?>
                            </div>
</div>
</div>
</div>
