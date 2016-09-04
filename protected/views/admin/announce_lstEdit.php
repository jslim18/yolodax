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
                        <div class="heading">
							Site Announcements
						</div> <br/>
                        <div>
							<?php echo $this->session->flashdata('msg');?>
							<?php if( ! empty($announces) ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="35%">Subject</th>
									<th width="20%">Content</th>
									<th width="15%" align="center">Action</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($announces as $ann) : ?>
								  <tr>
									<td>
										<strong><?php echo $ann->subject;?></strong>
										<br/><em><?php echo $ann->date_created;?></em>
									</td>
									<td>
										<?php echo $ann->content;?>
									</td>
									<td>
										<a href="<?php echo base_url('content/announce/?action=update&aid='.$ann->aid);?>" class="link button_grey" title="Edit">Edit</a>
										<a href="<?php echo base_url('content/announce/?action=delete&aid='.$ann->aid);?>" class="link button_grey" title="Delete" onClick="var c=confirm('Do you want to delete?');if(!c) return false;">Delete</a>
									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6"><strong>Total Record(s): <?php echo $total;?></strong><?php echo $this->pagination->create_links();?></td>
								  </tr>
								</tfoot>
							  </table>
							<?php else : ?>
							<div class="error"><em>Sorry, there is no record(s) found!</em></div>
							<?php endif; ?>
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
<?php $this->load->view('admin/includes/footer'); ?>
