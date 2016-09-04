<style>
.koiclass{width:96%;float:left; text-align:left; margin:5px 0px 5px 10px;}
</style>
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
							Import Addresses
						</div> <br/>
<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
	<span style="color:#00FF00; font-weight:bold;">
		<?php echo Yii::app()->user->getFlash("success");?>
	</span>
</div>
<div class="todepositamount">
	<h2>Import Addresses</h2>
	<div id="option_adding_div">
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'currency-add-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
<div class="koiclass">
<?php echo $form->fileField($model,'files',array("style"=>"width:auto;","class"=>"") ); ?><br>
<font color="#FF0000"><?php echo $form->error($model,'files'); ?></font>
</div>
<div class="koiclass">
<select name="ImportedFiles[currency]">
	<option value="">&mdash; Select Currency &mdash;</option>
	<?php foreach($currency as $c): ?>
	<option <?php if($c['currency']==$model->currency) echo 'selected="selected"'; ?> value="<?php echo $c['currency'];?>"><?php echo $c['currency'];?></option>
	<?php endforeach; ?>
</select>
<font color="#FF0000"><?php echo $form->error($model,'currency'); ?></font>
</div>
<div class="koiclass">
		<input type="submit" name="upload_submit" value="Upload" class="btn"/>
</div>
<?php $this->endWidget();?>
	</div>
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