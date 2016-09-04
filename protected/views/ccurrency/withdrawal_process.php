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
							Withdrawal Request<?php if( !empty($widreq) ) echo '&emsp;&laquo;&ensp;'.$widreq->username;?>
						</div> <br/>
                          <div>
							<?php if( !empty($widreq) ) : ?>
							<?php echo $this->session->flashdata('msg');?>
							<?php echo form_open($uri, $attr, $hidden); ?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th bgcolor="#e3e3f3" align="right">Currency</th>
									<td>
										<input type="text" value="<?php echo $widreq->currency;?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Currency Code</th>
									<td>
										<input type="text" value="<?php echo $widreq->currency_short;?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Amount</th>
									<td>
										<strong><em><?php echo $widreq->amount;?></em></strong>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Fee Charged</th>
									<td>
										<strong><em><?php echo $widreq->fee_charged;?></em></strong>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Receiving Amount</th>
									<td>
										<strong><em><?php echo $widreq->amount_received;?></em></strong>
									</td>
								</tr>
								
								<tr>
									<th bgcolor="#e3e3f3" align="right">Status</th>
									<td>
										<?php $options = array('pending', 'processing', 'completed', 'cancelled'); ?>
										<select name="widreq[status]">
											<?php foreach($options as $o) : ?>
											<?php $status = ($this->input->server('REQUEST_METHOD') == 'GET' && $o == $widreq->status)?true:false;?>
											<option value="<?php echo $o;?>" <?php echo set_select('widreq[status]', $o, $status);?>><?php echo ucwords($o); ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Hash Address</th>
									<td>
										<input type="text" value="<?php echo $widreq->address;?>" readonly="readonly" />
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Requested Action</th>
									<td>
										<?php echo $widreq->created;?>
									</td>
								</tr>
								<tr>
									<td bgcolor="#e5e5e5" align="center" colspan="3">
										<input class="button submit" type="submit" name="request" value="Update" />
										<input class="button cancel" type="button" name="request" value="Cancel" onclick="location.href='<?php echo base_url('ccurrency/withdraw/?action=request');?>'" />
									</td>
								</tr>
							</table>
							<?php echo form_close(); ?>
							<?php else : ?>
							<div class="error"><em>Invalid request, there is no record found!</em></div>
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
<?php $this->load->view('admin/includes/footer'); ?>
