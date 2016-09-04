
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/aadmin/ckeditor/ckeditor.js';?>"></script>
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
                        <div class="heading">About Us</div>
                        <br/>
                        <div>
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?></span>
					</div>
<form action="<?php echo Yii::app()->baseUrl."/content/about"?>" method="post">
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken;?>" >
                            <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
							  <div align="center" style=" font-size:12px; color:#FF0000; padding:5px;"></div>
                              <tr>
                                <td>
								<span style="display:block;"><strong>Title:</strong></span>
								<input type="text" name="title" value="About Us" readonly="" /><br/>
                                  <font color="#FF0000"></font></td>
                              </tr>
                              <tr>
                                <td align="left">
								<span style="display:block;"><strong>About Us Content:</strong></span>
								<textarea class='ckeditor' id='editor1' name="content">
								<?php echo $content['content']?>
								</textarea>
                                  <div id="email_error" style=" font-size:10px; color:#FF0000;"></div></td>
                              </tr>
                              <tr>
                                <td><input name="submit" type="submit" class="botton" value="Submit"/></td>
                              </tr>
                            </table>
                            
</form>
                            
                            
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

 
