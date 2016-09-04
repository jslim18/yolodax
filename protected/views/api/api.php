
<div class="wrapper">
<div class="btcconm">
<h1><?php echo Yii::t("content","Your API");?></h1>
<div class="lorn_box">
<?php $this->renderPartial("/user/_profile_left_side");?>    
     <div class="right_sec right_sec2">
     <span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
     <div class="infobox pchbox">
     <h2><?php echo Yii::t("content","API Keys");?></h2>
     
	 <table class="table_one api_manager" bgcolor="#f7f7f7" width="100%">
		 <tr height="40">
			 <th width="25%"><?php echo Yii::t("content","Name");?></th>
			 <th width="60%"><?php echo Yii::t("content","Keys");?></th>
			 <th width="8%"><?php echo Yii::t("content","Perms");?></th>
			 <th width="7%"><?php echo Yii::t("content","Action");?></th>
		 </tr>
		<?php if(count($api)>0){foreach($api as $a) : ?>
		 <tr height="70">
				<td>
					<p><?php echo $a['name']; ?></p>
				</td>
				<td>
					<div class="box"><i>API Key :</i><span class="text"><?php echo $a['key']; ?></span></div>
					<div class="box"><i>Secret :</i><span class="text"><?php echo $a['secret']; ?></span></div>
				</td>
				<td colspan="2">
					<div class="edit_action">
						<?php $perms = explode(',', $a['permission']);?>
							<?php echo CHtml::beginForm(); ?>
							<div class="labels">
							<input type="hidden" name="appid" value="<?php echo $a['id'];?>" />
								<label><input name="perm[info]" type="checkbox" <?php echo (in_array('info', $perms))?'checked="checked"':null;?> />info</label>
								<label><input name="perm[trade]" type="checkbox" <?php echo (in_array('trade', $perms))?'checked="checked"':null;?> />trade</label>
								<label><input name="perm[withdraw]" type="checkbox" <?php echo (in_array('withdraw', $perms))?'checked="checked"':null;?> />withdraw</label>
							</div>
							<div class="buttons">
								<input type="submit" value="<?php echo Yii::t('content','Save');?>" name="update" class="blue" />
								<?php if($a['status'] == 1) : ?>
								<input type="hidden" name="stat" value="0">
								<input type="submit" value="<?php echo Yii::t('content','Disable');?>" name="disable" />
								<?php else : ?>
								<input type="hidden" name="stat" value="1">
								<input type="submit" value="<?php echo Yii::t('content','Activate');?>" name="disable" />
								<?php endif; ?>
							</div>
						<?php echo CHtml::endForm(); ?>
					</div>
				</td>
		 </tr>
		<?php endforeach;
		}else{?>
			<tr><td colspan="4"> <p><span>You don't have API keys</span></p> </td></tr>
		<?php } ?>
	 </table>
     <div class="proimt proimt2">
     <p>
		<i style="color:#F7710A; font-style:normal; font-size:13px; font-weight:bold;"><?php echo Yii::t("content","Create API Key");?></i>
	 </p>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'create-api-key-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>true,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
	 <p>
		<?php echo $form->textField($model,'name',array("class"=>"input1 input2","placeholder"=>Yii::t("content","Your api name!") )); ?>
		<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($model,'name'); ?></div>
     </p>
     <p>
		<input class="orn" type="submit" name="submit" value="<?php echo Yii::t("content","Create");?>" />
     </p>
<?php $this->endWidget(); ?>
     </div>
     </div>
     </div>
</div>

<?php $this->renderPartial("/user/_icons");?>
</div>
</div>

