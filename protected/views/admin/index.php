
<div id="middle">
    <div id="login-box">
      <div align="left" class="box1" >
        <div class="box-t">
          <div class="box-r">
            <div class="box-b">
              <div class="box-l">
                <div class="box-tr">
                  <div class="box-br">
                    <div class="box-bl">
                      <div class="box-tl" align="left">
                        <div id="registration">
                        <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
							<span style="color:#FF0000; font-weight:bold;"><?php echo Yii::app()->user->getFlash("error");?></span>
							<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
						</div>
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'admin-login-form',
	'enableAjaxValidation'=>true,
)); ?>
				  <h1>Admin Login</h1>
				  <ul>
					<li>
					  <label> User Name : </label>
					  <?php echo $form->textField($model,'username',array("class"=>"text_box","placeholder"=>Yii::t("validate","Username!"))); ?><br />
					  <div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;">
						<?php echo $form->error($model,'username'); ?>
					  </div>
					</li>
					<li>
					  <label>Password : </label>
					  <?php echo $form->passwordField($model,'password',array("class"=>"text_box","placeholder"=>Yii::t("validate","password!"))); ?><br />
					  <div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;">
						<?php echo $form->error($model,'password'); ?>
					  </div>
					</li>
					<li>
					  <label>&nbsp;</label>
					  <input name="adminlogin" type="submit"  class="button" value="Submit" />
					  <input name="reset" type="submit" value="Reset"  class="button" />
					</li>
					<li>
					  <label>&nbsp;</label>
					</li>
				  </ul>
<?php $this->endWidget();?>
                        </div>
                        <div class="clear"> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  
