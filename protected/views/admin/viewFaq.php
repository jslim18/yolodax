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
                        <div class="heading">FAQ Listing </div> <br/>
                        <div>
						  <table width="100%" class="table-short" style="line-height:22px;">
							<thead>
							  <tr align="left">
								<td align="left"><b>Question</b></td>
							  </tr>
							  <tr align="left">
								<td align="left"><?=$fetchFaqById[0]->question;?></td>
							  </tr>
							  <tr align="left">
								<td align="left"><b>Answers</b></td>
							  </tr>
							  <tr align="left">
								<td align="left"><?=$fetchFaqById[0]->answers;?></td>
							  </tr>
							  <tr align="left">
								<td align="left">
									<input type="submit" name="editfaq" class="button" onclick="document.location='<?=$this->config->item('base_url')?>index.php/admin/editFaq/<?=$this->uri->segment(3,0);?>'" value="Edit FAQ" />&nbsp;
									<input type="button" name="back" value="Back FAQ Listing" onclick="document.location='<?=$this->config->item('base_url')?>index.php/admin/faqListing'" class="button" />
								</td>
							  </tr>
							</thead>
						  </table>
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
