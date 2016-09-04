
  <div id="middle">
    <?php $this->renderPartial('/admin/_leftSide'); ?>
    <div id="middletwo">
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
							Cryptocurrency<?php if( !empty($model) ) echo '&emsp;&laquo;&ensp;'.ucwords($model->currency);?>
						</div><br/>
                          <div>
							<?php if( !empty($model) ) : ?>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'currency-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>

							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th width="30%" bgcolor="#e3e3f3" align="right">Currency</th>
									<td width="40%">
<?php echo $form->textField($model,'currency',array("size"=>"40","placeholder"=>Yii::t("validate","New currency *") )); ?><br>
										<font color="#FF0000"><?php echo $form->error($model,'currency'); ?></font>	
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Code</th>
									<td>
<?php echo $form->textField($model,'currency_short',array("size"=>"40","placeholder"=>Yii::t("validate","New currency code *") )); ?><br>
										<font color="#FF0000"><?php echo $form->error($model,'currency_short'); ?></font>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Status</th>
									<td>
<?php echo $form->checkBox($model,'active',  array('checked'=>($model->active=="1"?"checked":null),"value"=>"1")); ?>

									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="request" value="Update" />&emsp;<input type="button" name="request" value="Cancel" onclick="javascript:history.go(-1);" />
									</th>
								</tr>
							</table>
<?php $this->endWidget();?>

							<?php else : ?>
							<div class="error"><em>Invalid request, there is no record found!</em></div>
							<?php endif; ?>
							<span class="clearFix">&nbsp;</span> 
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
