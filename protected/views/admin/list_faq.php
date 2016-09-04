<?php $this->load->view('admin/includes/header'); ?>
  <div id="middle">
    <?php $this->load->view('admin/includes/leftSide'); ?>
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
                        <div class="heading">FAQ Listing <span style="float:right"><a href="<?=base_url()."content/add_faq"?>" style="color:#FFFFFF; font-weight:bolder;">Add FAQ</a></span></div> <br/>
                        <div>
                    <form method="post" name='userlist'>
<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;"><span style="color:#00FF00; font-weight:bold;"><?php echo $this->session->flashdata("success"); ?></span></div>
                      <table class="table_show" width="100%" class="table-short" style="line-height:22px;" cellpadding="0" cellspacing="0">
                        <thead>
                          <tr class="header" align="left">
                            <th width="22%" align="left">Question</th>
                            <th width="58%" align="left">Answers</th>
                            <th width="20%" align="center">Action</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                        <?php if(count($ques)>0){foreach($ques as $k){?>
						<tr>
                            <td align="left"><b><?=$k->question?></b></td>
                            <td align="left"><?=$k->answer?></td>
                            <td align="center">
							<a href="<?=base_url()."content/delete_faq/".$k->id?>">Delete</a> |
							<a href="<?=base_url()."content/edit_faq/".$k->id?>">Edit</a></td>
						</tr>
						<?php }}else{?>
						<tr><td colspan="4" align="center">
						 	<strong>There are no questions added yet!</strong>
							</td>
						</tr>
						<?php }?>  
                        </tbody>
                      </table>
                    </form>
<script>
$(document).ready(function(){
$('table.table_show tr:even').css('background','#ececec');
$('table.table_show tr:odd').css('background','#e1e1e0');
});
</script>
                    <span class="clearFix">&nbsp;</span> </div>
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