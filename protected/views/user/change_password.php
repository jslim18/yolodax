
<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Edit Profile");?></h1>
<div class="lorn_box">
	<?php $this->renderPartial("_profile_left_side");?>

     <div class="right_sec right_sec2">
     <span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
     <div class="infobox">
     <?php $this->renderPartial("_profile_top_nav",array("uri"=>$uri));?>
     
     <div class="proim">
       <img src="upload/thumb/<?php echo $user['avatar']; ?>" width="144" alt=""/> 
     </div>
     <div class="proimt proimtinfinp">
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'change-password-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>true,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>

		 <p>
		<?php echo $form->passwordField($model,'password',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Current password!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'password'); ?></div>
			
		 </p>
		 <p>
		<?php echo $form->passwordField($model,'new_password1',array("class"=>"input1 input2","placeholder"=>Yii::t("content","New password!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'new_password1'); ?></div>
		 </p>
		 <p>
		<?php echo $form->passwordField($model,'new_password2',array("class"=>"input1 input2","placeholder"=>Yii::t("content","New password again!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'new_password2'); ?></div>
		 </p>
		 <p>
			<input type="submit" name="Submit" value="<?php echo Yii::t("content","Save");?>" class="orn" />
		 </p>
<?php $this->endWidget(); ?>
     </div>     
     
     
     </div>
     </div>                  
</div>


<?php $this->renderPartial("_icons");?>
</div>
</div>
