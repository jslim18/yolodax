
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
							Manage User Amounts
						</div> <br/>
                        <div>
		 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
			<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
		</div>


<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'amounts-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
<input type="hidden" value="<?php echo $amounts['user_id'];?>" name="Amounts[user_id]">
								<tr>
									<td bgcolor="#e3e3f3" align="right" width="50%">Username:</td>
									<td width="50%">
										<?php echo $amounts['username']; ?>
									</td>
								</tr>
									<?php if(!empty($currs)){foreach($currs as $c){$ck=$c['currency'];?>
										<tr><td bgcolor="#e3e3f3" align="right"><?php echo $ck;?></td>
											<td>
<input type="text" value="<?php echo (float)$amounts[$ck];?>" name="Amounts[<?php echo $ck; ?>]" />
<?php if($_SERVER['REQUEST_METHOD'] == 'POST'){?>
<font color="#FF0000"><?php echo $form->error($model,$ck); ?></font>
<?php } ?>
											</td>
										</tr>
										
									<?php }} ?>

								<tr>
									<td bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="amount_edit" value="Save" />&emsp;<input type="reset" name="request" value="Reset" />
									</td>
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

