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
                        <div class="heading">
							Announcement
							<?php if(!empty($announce)) :?>
								&emsp;&laquo;&ensp; <?php echo $announce->subject;?>
							<?php endif; ?>
						</div> <br/>
                          <div>
                          <?php echo $this->session->flashdata('msg');?>
							<?php if( ! empty($announce) ) : ?>
							<?php echo form_open($uri, $attr, $hidden); ?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th width="20%" bgcolor="#e3e3f3" align="right">Subject</th>
									<td width="80%">
										<input type="text" name="announce[subject]" size="60" value="<?php echo set_value('announce[subject]', $announce->subject);?>" />
										<?php echo form_error('announce[subject]'); ?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right" valign="top">Content</th>
									<td>
										<textarea id="acontent" name="announce[content]" cols="50" rows="5"><?php echo set_value('announce[content]', $announce->content);?></textarea>
										<?php echo form_error('announce[content]'); ?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right" valign="top">Content Short</th>
									<td>
										<input type="text" id="aexcerpt" name="announce[excerpt]" value="<?php echo set_value('announce[excerpt]', $announce->excerpt);?>" />
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right" valign="top">Author</th>
									<td>
										<input type="text" name="announce[author]" size="30" value="<?php echo set_value('announce[author]', $announce->author);?>" />
									</td>
								</tr>								
								<tr>
									<th bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="request" value="Update" />&emsp;<input type="reset" name="request" value="Reset" />
									</th>
								</tr>
							</table>
							<?php echo form_close(); ?>
							<?php else : ?>
							<div class="error"><em>Invalid access, there is no record(s) found!</em></div>
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
<script src="<?php echo base_url('public/admin/ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript">
(function($){
	CKEDITOR.replace('acontent', {width: 600});
	CKEDITOR.replace('aexcerpt', {toolbar: 'Basic', width: 600, height: 70, toolbarStartupExpanded: false});
})(jQuery);
</script>
<?php $this->load->view('admin/includes/footer'); ?>
