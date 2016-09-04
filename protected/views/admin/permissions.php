
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
							Manage Your Permissions
						</div> <br/>
                        <div>
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
					</div>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'permissions-add-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>
							<br /><h2>Set Permissions</h2><br />
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
										<th>Action</th>
									<?php if(sizeof($roles)>0){foreach($roles as $k){?>
										<th align="center"><?php echo $k->role_name; ?></th>	
									<?php }}?>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
									<?php if(sizeof($acts)>0){foreach($acts as $k){
										 $pt = array_filter(explode(",",$k['perms']));
										 if(!empty($pt)){foreach($pt as $kk=>$vv){
											 $tt = explode("=",$vv);
											 @$tt1[$tt[0]] = $tt[1];
										 }}
										 $pt = @$tt1;
										 unset($tt1);
									?>
									
									   <tr><th align="left"><?php echo $k['controllers'].'/'.$k['actions']; ?></th>	
										<?php if(sizeof($roles)>0){foreach($roles as $kk){?>
											<th><input name="act[<?php echo @$k['act_id']; ?>][<?php echo $kk->id?>][]" type="checkbox" <?php if(@$pt[$kk->id]==1){echo 'checked="checked"';}?>></th>	
										<?php }}?>
										</tr>
									<?php }}?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6" align="right">
										<input type="submit"  value="Update" name="update_perms" />
									</td>
								  </tr>
								</tfoot>
							  </table>

<?php $this->endWidget();?>

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

 
