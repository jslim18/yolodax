
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
							Manage Cryptocurrencies
						</div> <br/>
                        <div>
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
					</div>
							<?php if( ! empty($currs) ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="35%">Currency</th>
									<th width="20%">Short Name</th>
									<th width="10%">Status</th>
									<th width="15%">Created</th>
									<th width="10%">Action</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($currs as $c) : ?>
								  <tr id="tr<?php echo $c['id'];?>">
									<td>
										<?php echo $c['currency'];?>
									</td>
									<td>
										<?php echo $c['currency_short'];?>
									</td>
									<td>
										<p><?php echo ($c['active'])?'&#9745;':'&#9744;';?> Active</p>
									</td>
									<td>
										<em><?php echo date('M d, Y', strtotime($c['created']));?><br/><?php echo date('H:i:s', strtotime($c['created']));?></em>
									</td>
									<td>
										<a href="<?php echo Yii::app()->baseUrl.'/ccurrency/edit?cid='.$c['id'];?>" class="link button_grey" title="Edit">Edit</a>
<?php 
echo CHtml::ajaxLink(
	'Delete',
	array("/ccurrency/delete"),
	array(
		'type'=>'GET',
		'data'=>array("cid"=>$c['id'],'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
		'success' => 'function(d) {
          $("#tr"+d).remove();
        }',
	),
	array("href"=>"javascript:void(0);","confirm"=>"Are you sure?","class"=>"link button_grey")
);
?>
									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6">
										<strong>Total Record(s): <?php echo $total;?></strong>
										<?php $this->widget('CLinkPager', array('pages' => $pages,)); ?>
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
