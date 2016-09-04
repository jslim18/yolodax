
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
							Set Commission Per Pair
						</div> <br/>
                        <div>
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
					</div>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'commission-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th width="30%" bgcolor="#e3e3f3" align="right">Select Pair:</th>
									<td width="40%">
										<select id="cone" name="Commission[pair]">
											<option value="" data-code="">&mdash; Select Pair &mdash;</option>
											<?php foreach($pair as $c): ?>
											<option <?php if($c['cpair_slug']==$model->pair){echo "selected='selected'";}?> value="<?php echo $c['cpair_slug'];?>"><?php echo strtoupper(str_replace("_","/", $c['cpair_slug']));?></option>
											<?php endforeach; ?>
										</select>
										<font color="#FF0000"><?php echo $form->error($model,'pair'); ?></font>
									</td>
								</tr>
								<tr>
									<th width="30%" bgcolor="#e3e3f3" align="right">Commission:</th>
									<td width="40%">
			<?php echo $form->textField($model,"commission", array("placeholder"=>"Commission *"));?>%
										<font color="#FF0000"><?php echo $form->error($model,'commission'); ?></font>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="request" value="Save" />&emsp;<input type="reset" name="request" value="Reset" />
									</th>
								</tr>
							</table>
<?php $this->endWidget();?>

							<hr color="#b3b3b3" width="100%">
							<br /><h2>Commissions Per Pair</h2><br />
							<?php if( ! empty($comms) ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="35%">Currency Pair</th>
									<th width="35%">Commission</th>
									<th width="10%">Action</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($comms as $p) : ?>
								  <tr id="tr<?php echo $p['id'];?>">
									<td>
									<?php echo strtoupper(str_replace("_","/", $p['pair']));?>
									</td>
									<td>
										<?php echo $p['commission'];?>&nbsp;<span style="color:#FF0000;font-weight:bold;">%</span>
									</td>

									<td>
<a href="<?php echo Yii::app()->baseUrl.'/ccurrency/commission_edit?cid='.$p['id'];?>" class="link button_grey" title="Edit">Edit</a>
<?php 
echo CHtml::ajaxLink(
	'Delete',
	array("/ccurrency/commission_delete"),
	array(
		'type'=>'GET',
		'data'=>array("cpid"=>$p['id'],'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
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
								</tfoot>
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
