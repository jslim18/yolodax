<?php $this->load->view('admin/includes/top'); ?>
<body>
<div id="main">
  <?php $this->load->view('admin/includes/header'); ?>
  <div id="middle">
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
                        <div class="heading">Edit FAQ</div> <br/>
                        <div>
							<form method="post">
								<table>
									<tr>
										<td><strong>Question</strong></td>
										<td><textarea name="ques" rows="4" cols="70"><?=$fetchFaqById[0]->question;?></textarea>
											 <br/>
											<font color="#FF0000"><?php echo form_error('ques'); ?></font>
										</td>
									</tr>
									<tr>
										<td><strong>Answers</strong></td>
										<td><textarea name="ans" rows="4" cols="70"><?=$fetchFaqById[0]->answers;?></textarea> <br/>
											<font color="#FF0000"><?php echo form_error('ans'); ?></font>
										</td>
									</tr>
									<tr>
										<td></td>
										<td><input name="editAns" class="button" value="Edit" type="submit" /></td>
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
    <?php //$this->load->view('admin/includes/rightSite'); ?>
  </div>
</div>
<?php $this->load->view('admin/includes/footer'); ?>
</body>
</html>
