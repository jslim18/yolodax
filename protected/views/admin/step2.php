
  <div id="middle">
    <?php //$this->renderPartial('/admin/_leftSide'); ?>
    <div id="middletwo" style="float:none;margin:0px auto;">
      <div align="left" class="box2" >
        <div class="box-t">
          <div class="box-r">
            <div class="box-b">
              <div class="box-l">
                <div class="box-tr">
                  <div class="box-br">
                    <div class="box-bl">
                      <div class="box-tl" align="left">
                        <div class="heading">Step - 2 
							<span style="float:right;">
								<a class="myL" href="<?php echo Yii::app()->baseUrl."/admin/logsf";?>">
									Login&nbsp;/&nbsp;Index
								</a>
							</span>
                        </div>
                        <div class="welcome-text">                  
						<div style=" width:100%; float:left;">	
							<div style="width:66%; float:left;">
<h3 style=" display:block; padding:10px 0px 10px 0px;">
	Please enter your "One Time Password" in the field to complete the authentication process!
</h3>
<?php echo CHtml::beginForm(array('admin/index')); ?>

<div style="width:100%; float:left;">
	<input class="text_box" style="width:250px;float:left;" type="text" name="code" placeholder="Your password!">
</div>

<?php if($error !=""){?>
	<div style="width:100%; float:left;color:#FF0000;padding:3px;"><?php echo $error;?></div>
<?php } ?>

<input name="codelogin" style="float:left;margin-top:6px;" type="submit" class="button" value="Submit">
								
</form>
							</div>
								<div style=" float:right; margin:0px;">

								</div>
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