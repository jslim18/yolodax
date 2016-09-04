
  <div id="middle">
    <?php $this->renderPartial('_leftSide'); ?>
    <div id="middletwo" style="width:70%">
      <div align="left" class="box2" >
        <div class="box-t">
          <div class="box-r">
            <div class="box-b">
              <div class="box-l">
                <div class="box-tr">
                  <div class="box-br">
                    <div class="box-bl">
                      <div class="box-tl" align="left">
                        <div class="heading">Change Password</div>
                        <br/>
                        <div> 
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'settings-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
							  <div align="center" style=" font-size:12px; color:#00FF00; padding:5px;">
								<?php echo Yii::app()->user->getFlash("success");?>
							  </div>
                              <tr>
                                <td height="35" align="right"><label>Username:</label></td>
                                <td>
<?php echo $form->textField($model,'username',array("required"=>"true","placeholder"=>Yii::t("validate","Username *") )); ?>
                                  <div style=" font-size:10px; color:#FF0000;"><?php echo $form->error($model,'username'); ?></div>
                                </td>
                              </tr>

                              <tr>
                                <td height="35" align="right"><label>Email-Id :</label></td>
                                <td align="left">
<?php echo $form->emailField($model,'email',array("required"=>"true","placeholder"=>Yii::t("validate","Email address *") )); ?>
                                  <div style=" font-size:10px; color:#FF0000;"><?php echo $form->error($model,'email'); ?></div>
                                </td>
                              </tr>

                              <tr>
                                <td height="35" align="right"><label>Old Password:</label></td>
                                <td>
<?php echo $form->passwordField($model,'password',array("placeholder"=>Yii::t("validate","Old Password *") )); ?>
                                  <div style=" font-size:10px; color:#FF0000;"><?=$form->error($model,'password')?></div></td>
                              </tr>

                              <tr>
                                <td height="35" align="right"><label>New Password:</label></td>
                                <td align="left">
<?php echo $form->passwordField($model,'new_password',array("placeholder"=>Yii::t("validate","New Password *") )); ?>
                                  <div style=" font-size:10px; color:#FF0000;"><?=$form->error($model,'new_password')?></div>
                                </td>
                              </tr>
                              <tr>
                                <td height="35" align="right"><label>Confirm Password:</label></td>
                                <td align="left">
<?php echo $form->passwordField($model,'confirm_password',array("placeholder"=>Yii::t("validate","Confirm new password *") )); ?>
                                  <div style=" font-size:10px; color:#FF0000;"><?=$form->error($model,'confirm_password')?></div>
                                </td>
                              </tr>
                              <tr>
                                <td height="35" align="right">&nbsp;</td>
                                <td><input name="submitcpw" type="submit" class="botton" value="Submit"/></td>
                              </tr>
                            </table>
<?php $this->endWidget();?>
                        </div>
<?php /*
                        <div>Click here to enable <a href="<?php echo Yii::app()->baseUrl."/admin/g2a" ?>">Google 2 Factor Authentication!</a></div>
	*/ ?>
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

