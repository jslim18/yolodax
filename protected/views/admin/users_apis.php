
<div id="middle">
    <?php $this->renderPartial('_leftSide'); ?>
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
							Manage User API
							<?php if( !empty($user) ) echo '&emsp;&laquo;&ensp;'.$user['username'];?>
						</div> <br/>
                        <div>
							<?php if( !empty($user) || $action == 'apis' ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="15%">Name</th>
									<th width="20%">Username</th>
									<th width="30%">Token</th>
									<th width="10%">Permissions</th>
									<th width="12%">Timestamp</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($apis as $a) : ?>
								  <tr>
									<td>
										<?php echo $a['name'];?>
									</td>
									<td>
										<a href="<?php echo Yii::app()->baseUrl.'/admin/users/?action=acc_edit&uid='.$a['user_id'];?>" class="link"><?php echo $a['username'];?></a>
									</td>
									<td>
										<p><strong>Key:</strong>&nbsp;&raquo;&nbsp;<em><?php echo $a['key'];?></em></p>
										<p><strong>Secret:</strong>&nbsp;&raquo;&nbsp;<em><?php echo $a['secret'];?></em></p>
									</td>
									<td>
										<?php $perms = explode(',', $a['permission']);?>
										<p><?php echo (in_array('info', $perms))?'&#9745;':'&#9744;';?> Info</p>
										<p><?php echo (in_array('trade', $perms))?'&#9745;':'&#9744;';?> Trade</p>
										<p><?php echo (in_array('withdraw', $perms))?'&#9745;':'&#9744;';?> Withdraw</p>
									</td>
									<td>
										<em><?php echo date('M d, Y', strtotime($a['created_at']));?><br/><?php echo date('H:i:s', strtotime($a['created_at']));?></em>
									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6"><strong>Total Record(s): <?php echo $total;?></strong>
									
									</td>
								  </tr>
								</tfoot>
							  </table>
							<?php else : ?>
							<div class="error"><em>Invalid request, there is no record found!</em></div>
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

