<?php if(isset($img)){?>
<script>
$(document).ready(function(){
	var x =	Math.round(+new Date()/1000);
	$("input[name=tt]").val(x);
});
</script>
<div style="width:400px; float:left;">
	<?php $form = $this->beginWidget('CActiveForm',
									 array(
										'id'=>'g2a-enable-form',
									 ));
	?>
		<strong>OTP Password:</strong>
		<input type="hidden" name="tt" value="" />
		<input type="text" placeholder="current password*" name="otp"/><br />
			<?php if(isset($error)){echo $error.'<br>';}?>
		<input type="submit" name="otp_verify" class="button" value="Verify" />
	<?php $this->endWidget(); ?>
</div>

		<div style="width:300px; float:left;">
			<img src="<?php echo $img;?>" />
			<strong>Key:</strong><span style="color:#999999; font-size:12px; margin-left:4px;"><?php echo $key;?></span>
		</div>

<?php }else{?>

	<strong style="padding:7px 0px 7px 0px; display:block;">
		Your "Google 2 Factor Authentication" is enabled!
	</strong>
	<?php $form = $this->beginWidget('CActiveForm',
									 array(
										'id'=>'g2a-disable-form',
									 ));
	?>
		<?php /* <input type="checkbox" name="g2a" checked="checked"/> */ ?>
		<input type="submit" name="g2a_disable" class="button" value="Disable" />
	<?php $this->endWidget(); ?>
<?php } ?>