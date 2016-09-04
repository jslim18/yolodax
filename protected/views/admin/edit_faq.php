<?php $this->load->view('admin/includes/header'); ?>
<div id="middle">
<script src="<?=base_url()."public/admin/ckeditor/ckeditor.js"?>"></script>

    <?php $this->load->view('admin/includes/leftSide'); ?>
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
                        <div class="heading">Editing The FAQ</div>
                        <br/>
                        <div> 
      <form method="post" action="<?=base_url()."content/edit_faq/".$id?>">
                            <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
							  <div align="center" style=" font-size:12px; color:#FF0000; padding:5px;"></div>
                              <tr>
                                <td><span style="display:block;"><strong>Question:</strong></span>
								<input type="text" style="width:80%;" value="<?=$ques->question?>" name="question" /><br/>
                                  <font color="#FF0000"></font></td>
                              </tr>
                              <tr>
                                <td align="left">
								<span style="display:block;"><strong>Answer:</strong></span>
								<textarea class='ckeditor' id='editor1' name="answer">
								<?=$ques->answer?></textarea>
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

<?php $this->load->view('admin/includes/footer'); ?>