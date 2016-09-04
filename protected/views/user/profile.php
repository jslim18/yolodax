<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Information");?></h1>
<div class="lorn_box">
<?php $this->renderPartial("_profile_left_side");?>
     
     <div class="right_sec right_sec2">
     <div class="infobox">
	 <div class="proim">
       <img src="<?php echo $user['avatar']; ?>" width="144" alt=""/>
	 </div>
	 
     <div class="proimt proimtinf">
     <p><label><?php echo Yii::t("content","User");?>:</label> 	
     <span><?php echo $user['username']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","E-mail");?>:</label> 	
     <span style="color:#0098f0;"><?php echo $user['email']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","Skype");?>:</label>
     <span><?php echo $user['skype']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","IC");?>:</label>
     <span><?php echo $user['IC']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","Country");?>:</label>
     <span><?php echo $user['country']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","Billing Address");?>:</label>
     <span><?php echo $user['billing_address']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","Phone Number");?>:</label>
     <span><?php echo $user['phone_number']; ?></span>
     </p>
	 <p><label><?php echo Yii::t("content","Last login");?>:</label>
     <span><?php echo $user['last_action_at'];?></span>
     </p>
     </div>

     </div>
     </div>                  
</div>

<?php $this->renderPartial("_icons");?>

</div>
</div>
