
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
       <img src="upload/thumb/<?php echo $model->avatar; ?>" width="144" alt=""/> 
     </div>

     <div class="proimt proimtinfinp">

<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'edit-profile-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>true,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
		<p>
		<?php echo $form->textField($model,'skype',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Your skype!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'skype'); ?></div>
		</p>

		<p>
		<?php echo $form->textField($model,'IC',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Identification number!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'IC'); ?></div>
		</p>
		
		<p>
		<?php echo $form->textField($model,'phone_number',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Phone number!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'phone_number'); ?></div>
		</p>

		<p>
		<?php echo $form->textField($model,'billing_address',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Billing address!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'billing_address'); ?></div>
		</p>

		<p>
		<?php echo $form->dropDownList($model,'country',$country,array("class"=>"input1 inputnon")); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'country'); ?></div>
		</p>

		<p>
		<?php echo $form->textField($model,'email',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Your email address!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'email'); ?></div>
		</p>

		<p>
		<?php echo $form->passwordField($model,'password',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Your current password!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'password'); ?></div>		</p>
		<p>
			<input type="submit" name="Submit" value='<?php echo Yii::t("content","Save");?>' class="orn">
		</p>

<?php $this->endWidget(); ?>
     </div>     


     </div>
     </div>                  
</div>


<?php $this->renderPartial("_icons");?>
</div>
</div>


