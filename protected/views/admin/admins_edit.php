
<div id="middle">
    <?php $this->renderPartial('/admin/_leftSide'); ?>
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
                        <div class="heading">
							Edit Admins
						</div> <br/>
                        <div>

<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'admins-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">

								<tr>
									<th bgcolor="#e3e3f3" align="right">Username:</th>
									<td>
										<?php echo $form->textField($model,"username",array('placeholder'=>"Username *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'username'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="right">Email:</th>
									<td>
										<?php echo $form->textField($model,"email",array('placeholder'=>"Email *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'email'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="right">Admin Role:</th>
									<td>
										<?php echo $form->dropDownList($model,'role',$roles);?>
										<font color="#FF0000"><?php echo $form->error($model,'role'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="right">Password:</th>
									<td>
										<?php echo $form->passwordField($model,"password",array('placeholder'=>"Password *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'password'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="right">Confirm Password:</th>
									<td>
										<?php echo $form->passwordField($model,"confirm_password",array('placeholder'=>"Confirm password *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'confirm_password'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="request" value="Save" />&emsp;<input type="reset" name="request" value="Reset" />
									</th>
								</tr>

							</table>
<?php $this->endWidget();?>

						  <span class="clearFix">&nbsp;</span></div>
                        <div class="clear"></div>
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
