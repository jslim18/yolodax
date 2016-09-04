
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

	<div class="inpflmain">
		<?php $this->widget('application.components.widgets.GoogleFactUser'); ?>
    </div>


     </div>
     </div>
</div>


</div>

<?php $this->renderPartial("_icons");?>
</div>
</div>
