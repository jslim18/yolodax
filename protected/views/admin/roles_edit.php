
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
									<th bgcolor="#e3e3f3" align="right">Role name:</th>
									<td>
										<?php echo $form->textField($model,"role_name",array('placeholder'=>"Role name *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'role_name'); ?></font>
									</td>
								</tr>

								<tr>
									<th bgcolor="#e3e3f3" align="right">Role description:</th>
									<td>
<?php echo $form->textArea($model,"description",array("cols"=>"50","rows"=>"5","style"=>"resize:none;","placeholder"=>"Role description *"));?>
										<font color="#FF0000"><?php echo $form->error($model,'description'); ?></font>
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
