<style>
.errorMessage{ width:50%; float:left; margin-top:2px; position:absolute; margin-left:23.3%;  padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#666666; color:#FF0000;}
</style>
<div class="wrapper">
	<div class="btcconm">
	
		<div class="banm">
		  <img src="images/banner.png" width="929" height="320"  alt=""/> </div>
			<div class="cntnm">
				<div class="cntn">
					<div class="mnhd" style="width:99.2%;">
						<h1>Contact Us</h1>
					</div>
<div class="lnewsmain">
	<div class="wrapper">
    <div class="lnewsin" style="width:92%; margin-left:10px;">
<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
	<span style="color:#00FF00; font-weight:bold; margin-left:23.3%; position:absolute;float:left;">
		<?php echo Yii::app()->user->getFlash("success");?>
	</span>
</div>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'contact-us-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>   
    <div class="confrmbmain">
<div class="confrmb">
	<div class="cusipb">
    <label>First name</label>
		<?php echo $form->textField($model,"fname",array("class"=>"ussel",'placeholder'=>"First name here... *"));?>
		<font color="#FF0000"><?php echo $form->error($model,'fname'); ?></font>
    </div>
    <div class="cusipb">
    <label>Last name</label>
		<?php echo $form->textField($model,"lname",array("class"=>"ussel",'placeholder'=>"Last name here... *"));?>
		<font color="#FF0000"><?php echo $form->error($model,'lname'); ?></font>
    </div>
    <div class="cusipb">
    <label>Subject</label>
		<?php echo $form->dropDownList($model,'subject_id',$subs,array("class"=>"ussel"));?>
		<font color="#FF0000"><?php echo $form->error($model,'subject_id'); ?></font>
    </div>
    <div class="cusipb">
    <label>Email</label>
		<?php echo $form->textField($model,"email",array("class"=>"ussel",'placeholder'=>"Enter your email here... *"));?>
		<font color="#FF0000"><?php echo $form->error($model,'email'); ?></font>
    </div>
    <div class="cusipb">
    <label>Message</label>
		<?php echo $form->textArea($model,"message",array("class"=>"ussel",'placeholder'=>"Type your message... *"));?>
		<font color="#FF0000"><?php echo $form->error($model,'message'); ?></font>	
    </div>
    <div class="cusipb">
    <label>&nbsp;</label><input type="submit" class="reg_submit" value="Submit">
    </div>
</div>
</div>

<?php $this->endWidget();?>
    </div>
    </div>
</div>				
					<?php $this->renderPartial("/user/_icons");?>
				</div>
			
			</div>
		
		
		
		</div>
	</div>
