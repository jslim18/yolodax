	<?php $ct = Yii::app()->controller->getRoute();
	$arr = array("user/edit_profile","user/avatar","user/change_password","user/g2a");
	?>
	<div class="left_sec left_sec2">
      <div class="menue">

    	<ul>
        <li <?php if($ct=="user/profile"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/profile"?>">
				<?php echo Yii::t("content","Information");?>
			</a>
		</li>
        <li <?php if($ct=="user/funds"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/funds"?>">
				<?php echo Yii::t("content","Funds");?>
			</a>
		</li>
        <li <?php if(in_array($ct,$arr)){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/edit_profile"?>">
				<?php echo Yii::t("content","Edit");?>
			</a>
        </li>
        <li <?php if($ct=="user/trade_history"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/trade_history"?>">
				<?php echo Yii::t("content","Trade history");?>
			</a>
		</li>
        <li <?php if($ct=="user/order_history"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/order_history"?>">
				<?php echo Yii::t("content","Orders history");?>
			</a>
		</li>
		<li <?php if($ct=="user/withdraw_history"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/withdraw_history"?>">
				<?php echo Yii::t("content","Withdraw history");?>
			</a>
		</li>
        <li <?php if($ct=="api/api"){echo 'class="none"';}?>>
			<a href="<?php echo Yii::app()->request->baseUrl."/user/api"?>">
				<?php echo Yii::t("content","API keys");?>
			</a>
		</li>
    	</ul>

	  </div>
     </div>