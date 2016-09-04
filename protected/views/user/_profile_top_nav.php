<ul class="chpslis">
	<li <?php echo ($uri == 'user/edit_profile') ? 'class="active"' : null;?>>
		<a href="<?php echo Yii::app()->baseUrl."/user/edit_profile"?>"><?php echo Yii::t("content","Main");?></a>
	</li>
	<li <?php echo ($uri == 'user/change_password') ? 'class="active"' : null;?>>
		<a href="<?php echo Yii::app()->baseUrl."/user/change_password"?>"><?php echo Yii::t("content","Change password");?></a>
	</li>
	<li <?php echo ($uri == 'user/avatar') ? 'class="active"' : null;?>>
		<a href="<?php echo Yii::app()->baseUrl."/user/avatar"?>"><?php echo Yii::t("content","Change avatar");?></a>
	</li>
	<li <?php echo ($uri == 'user/g2a') ? 'class="active"' : null;?>>
		<a href="<?php echo Yii::app()->baseUrl."/user/g2a"?>"><?php echo Yii::t("content","Google Auth");?></a>
	</li>
</ul>
