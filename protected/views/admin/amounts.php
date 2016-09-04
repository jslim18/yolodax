
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
                        <div class="heading">
							Manage User Amounts
						</div> <br/>
                        <div>
		 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
			<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
		</div>

							<?php if( ! empty($amounts) ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="35%">Username</th>
									<?php if(!empty($currs)){foreach($currs as $c){?>
										<th><?php echo $c['currency'];?></th>
									<?php }} ?>
									<th width="10%">Action</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($amounts as $p) : ?>
								  <tr>
									<td>
										<?php echo $p['username'];?>
									</td>
									<?php if(!empty($currs)){foreach($currs as $c){?>
										<td><?php $ck=$c['currency'];echo (float)$p[$ck]; ?></td>
									<?php }} ?>
									<td>
										<a href="<?php echo Yii::app()->baseUrl.'/admin/amounts_edit?id='.$p['id'];?>" class="link button_grey" title="Edit">Edit</a>
									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6">
										<strong>Total Record(s): <?php // echo $total;?></strong>
										<?php //echo $this->pagination->create_links();?>
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

