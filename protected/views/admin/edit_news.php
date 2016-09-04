
<div id="middle">
<script src="<?= Yii::app()->baseUrl."/aadmin/ckeditor/ckeditor.js"?>"></script>

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
                        <div class="heading">Editing The News</div>
                        <br/>
                        <div> 
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'news-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
                            <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
							  <div align="center" style=" font-size:12px; color:#FF0000; padding:5px;">

							  </div>
                              <tr>
                                <td><span style="display:block;"><strong>News Headline:</strong></span>
<?php echo $form->textField($model,'headline',array("style"=>"width:80%","placeholder"=>Yii::t("validate","News headline *") )); ?><br>
                                  <font color="#FF0000"><?php echo $form->error($model,'headline'); ?></font>
                                </td>
                              </tr>
                              <tr>
                                <td align="left">
								<span style="display:block;"><strong>Answer:</strong></span>
<?php echo $form->textArea($model,'news',array("class"=>"ckeditor","id"=>"editor1")); ?><br>
                                  <div id="email_error" style=" font-size:10px; color:#FF0000;">
                                  <?php echo $form->error($model,'news'); ?>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td><input name="submit" type="submit" class="botton" value="Submit"/></td>
                              </tr>
                            </table>
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
