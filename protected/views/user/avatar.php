
<div class="wrapper">
<div class="btcconm">

<h1>Edit Profile</h1>

<div class="lorn_box">	

	<?php $this->renderPartial("_profile_left_side");?>
<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
     <div class="right_sec right_sec2">
     <div class="infobox">
     <?php $this->renderPartial("_profile_top_nav",array("uri"=>$uri));?>

     <div class="proimt pchbox">

     <?php /*
     <p><span>File format: JPG
	<br>File maximum size 64kb.
	<br>Avatar size must not exceed 184px X 184px</span>
     </p>
     */?> 
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'change-avatar-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>true,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>
	<div class="inpflmain">
	 <div class="inpfl">

		<?php echo $form->fileField($model,'avatar'); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'avatar'); ?></div>

     </div>
     <input class="orn" type="submit" value="<?php echo Yii::t("content","Save");?>">
     </div>
<?php $this->endWidget(); ?>

     </div>
     </div>
</div>


</div>

<?php $this->renderPartial("_icons");?>
</div>
</div>
