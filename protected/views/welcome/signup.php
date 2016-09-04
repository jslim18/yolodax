<style>
.newpllomain{float:left;width:100%;padding:50px 0px;margin:12px 0px;}
.newpllo{width:395px; margin:0 auto;float:none;}
.ppmanew{width:350px; }
.mnhd2new h2{color:#6d6d6d !important;}
</style>

<div class="wrapper">
<div class="newpllomain">
<div class="newpllo">
<div class="ppma ppmanew">
<div class="mnhd mnhd2 mnhd2new">
<h2><?php echo Yii::t("validate","Sign Up");?></h2>
</div>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'signup-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>true,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>
<table width="100%" cellspacing="0" cellpadding="5" border="0" class="rigister rigister2">
	<tbody>
	<tr>
		<td>
		<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash('success')?></span>
		<span style="color:#FF0000; font-weight:bold;"></span>
		</td>
	</tr>
	<tr>
		<td colspan="0">
		<?php echo $form->textField($model,'username',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Username*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'username'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->emailField($model,'email',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Your Email*",array(),null,Yii::app()->language))); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'email'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->textField($model,'IC',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Unique Identification*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'IC'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->textField($model,'billing_address',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Billing Address*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'username'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->textField($model,'phone_number',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Phone Number*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'phone_number'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->dropDownList($model,'country',$country,array("class"=>"input1 inputnon")); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'country'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<?php echo $form->passwordField($model,'password',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Password*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'password'); ?></div>
		</td>
	</tr>
	<tr>
		<td colspan="0">
		<?php echo $form->passwordField($model,'confirm_password',array("class"=>"input1 inputnon","placeholder"=>Yii::t("validate","Password again*",array(),null,Yii::app()->language) )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'confirm_password'); ?></div>
		</td>
	</tr>

	<tr>
		<td colspan="0">
		<span style="float:left;">
		<?php echo $form->textField($model,'captcha',array("class"=>"input1 inputnon","style"=>"width:194px;float:left;margin:10px 5px 0 0;","placeholder"=>Yii::t("validate","Captcha value*",array(),null,Yii::app()->language))); ?>
		<?php $this->widget('CCaptcha', array("buttonLabel"=>"Refresh?","clickableImage"=>true,"showRefreshButton"=>false)); ?>
		</span>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'captcha'); ?></div>
		</td>
	</tr>
	<tr>
		<td colspan="0">
		<span style="float:left; width:100%;">
		<?php echo $form->checkBox($model,'terms', array('value'=>1,"class"=>"input1 inputnon","style"=>"width:auto;")); ?> <?php echo Yii::t("validate","I accept the terms and conditions!",array(),null,Yii::app()->language)?>
		</span>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'terms'); ?></div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td valign="middle" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td><input type="submit" name="register" class="reg_submit" value="<?php echo Yii::t("validate","Register",array(),null,Yii::app()->language);?>">&nbsp;
			
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
