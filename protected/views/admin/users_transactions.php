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
							Users Transactions
							<?php if( !empty($user) ) echo '&emsp;&laquo;&ensp;'.$user['username'];?>
						</div><br/>
                        <div>

							<div class="filtertool">
								<h3>Filter :</h3>
								<label for="trans_pair">Pair:
									<select id="trans_pair" name="pair">
										<option value="">ALL</option>
										<?php if(sizeof($pairs)>0 ){foreach($pairs as $c){?>
<option value="<?php echo $c['cpair_slug'];?>" <?php echo (in_array($c['cpair_slug'], $where))?'selected="selected"':null;?>><?php echo strtoupper(str_replace("_","/",$c['cpair_slug']));?></option>
										<?php }} ?>
									</select>
								</label>
								<label for="trans_type">Type:
									<select id="trans_type" name="type">
										<option value="">ALL</option>
										<option value="sell" <?php echo (in_array('sell', $where))?'selected="selected"':null;?>>Sell</option>
										<option value="buy" <?php echo (in_array('buy', $where))?'selected="selected"':null;?>>Buy</option>	
									</select>
								</label>
								<label for="trans_done_status">Status:
									<select id="trans_done_status" name="done_status">
										<option value="">ALL</option>
										<option value="not_done" <?php echo (in_array('not_done', $where))?'selected="selected"':null;?>>Active</option>
										<option value="done" <?php echo (in_array('done', $where))?'selected="selected"':null;?>>Filled</option>
										<option value="partial" <?php echo (in_array('partial', $where))?'selected="selected"':null;?>>Partly Filled</option>
										<option value="canceled" <?php echo (in_array('canceled', $where))?'selected="selected"':null;?>>Canceled</option>										
									</select>
								</label>
							</div>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="4" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="center" height="40">
									<th width="10%">Currency</th>
									<th width="5%">Pair</th>
									<th width="5%">Type</th>
									<th width="10%">Username</th>
									<th width="5%">Price</th>
									<th width="10%">Amount</th>
									<th width="10%">Total</th>
									<th width="10%">Commission</th>
									<th width="15%">Status</th>
									<th width="12%">Date</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($transactions as $trans) : ?>
								  <tr>
									<td align="left">
										<?php echo ucwords($trans['currency']);?>
									</td>									
									<td align="center">
										<?php echo strtoupper($trans['pair']);?>
									</td>
									<td align="center">
										<?php echo $trans['type'];?>
									</td>
									<td align="left">
										<a href="<?php echo Yii::app()->baseUrl.'/admin/users/?action=acc_edit&uid='.$trans['user_id'];?>" class="link"><?php echo $trans['username'];?></a>
									</td>
									<td align="right">
										<?php echo (float)$trans['rate'];?>
									</td>
									<td align="right">
										<?php echo (float)$trans['amount'];?>
									</td>
									<td align="right">
										<?php echo (float)$trans['total'];?>
									</td>
									<td>
<?php if($trans['type']=="BUY"){?>
C:&nbsp;<?php echo (float)$trans['commission']."&nbsp;".$trans["currency_short"];?><br />
M:&nbsp;<?=(float)$trans['hrd_c']."&nbsp;".$trans["hard_currency"];?>
<?php }else{?>
C:&nbsp;<?php echo (float)$trans['hrd_c']."&nbsp;".$trans["hard_currency"];?>
<?php }?>
									</td>
									<td align="center">
										<div class="meter">
											<span class="statusbar">
												<span class="completed" style="width:<?php echo floatval(number_format((float)(($trans['how_much']+$trans['commission']) * 100)/$trans['amount'],4,'.',''))?>%;">&nbsp;</span>
											</span>
											<?php echo floatval(number_format((float)(($trans['how_much']+$trans['commission']) * 100)/$trans['amount'],2,'.',''));?>%
										</div>
									</td>
									<td>
										<em><?php echo date('M d, Y', strtotime($trans['timestamp']));?><br/><?php echo date('H:i:s', strtotime($trans['timestamp']));?></em>
									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="10">
										<strong>Total Record(s): <?php echo $total;?></strong>
										<?php $this->widget('CLinkPager', array('pages' => $pages,)); ?>
									</td>
								  </tr>
								</tfoot>
							  </table>
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

<script type="text/javascript">
var siteurl = '<?php echo Yii::app()->baseUrl.'/admin';?>';
var request = <?php echo $query_string;?>;
(function($){
	$('.filtertool').on('change', 'select', function(){
		// delete pagination
		delete request['page'];
		// create query
		var query = makeRequestQuery(this);
		// create uri
		var uri = siteurl + '/users/?' + query;
		history.pushState(null, null, uri);
		location.reload();
	})
})(jQuery);
// make query string
function makeRequestQuery(obj) {
	if(obj.value == '')
		delete request[obj.name];
	else
		request[obj.name] = obj.value;
	
	return $.param( request, true );
}
</script>
