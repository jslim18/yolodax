
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
							Deposits On Website
						</div> <br/>
                        <div>
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;">
							<?php echo Yii::app()->user->getFlash("success");?>
						</span>
					</div>
<?php if( ! empty($all) ) : ?>
<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="5" class="table-short">
	<thead bgcolor="#f9f9f9">
	  <tr class="header" align="left" height="40">
		<th width="10%">Username</th>
		<th width="10%">Currency</th>
		<th width="10%">Account(Label)</th>
		<th width="20%">Address</th>
		<th width="10%">Amount</th>
		<th width="20%">Created</th>
		<th width="20%">Deposited</th>
	  </tr>
	</thead>
	<tbody bgcolor="#ececec">
	<?php foreach($all as $p) : ?>
	  <tr>
		<td>
			<?php echo $p['username'];?>
		</td>
		<td>
			<?php echo $p['currency'];?>
		</td>
		<td>
			<?php echo $p['label'];?>
		</td>
		<td>
			<?php echo $p['address'];?>
		</td>
		<td>
			<?php echo $p['amount'];?>
		</td>
		<td>
			<?php echo $p['created_at'];?>
		</td>
		<td>
			<?php echo $p['updated_at'];?>
		</td>
	  </tr>
	<?php endforeach; ?>
	<tr bgcolor="#d3d3d3" height="35">
		<td colspan="7">
			<strong>Total Record(s) : <?php echo $total; ?></strong>
			<?php $this->widget('CLinkPager', array('pages' => $pages,)); ?>
		</td>
	</tr>
	</tbody>
  </table>
<?php else : ?>
<div class="error"><em>There is no record found!</em></div>
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