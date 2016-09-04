
  <div id="middle">
    <?php $this->renderPartial('_leftSide'); ?>
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
							User Detail
							<?php if( !empty($user) ) echo '&emsp;&laquo;&ensp;'.$user['username'];?>
						</div> <br/>
                          <div>
							<?php if( !empty($user) ) : ?>
<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'admin-edit-user-profile-form',
									'enableClientValidation'=>false,
									'enableAjaxValidation'=>false,
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 ));
?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th width="30%" bgcolor="#e3e3f3" align="right">Username</th>
									<td width="40%">
<?php echo $form->textField($user,'username',array("class"=>"input1 input2","size"=>40,"placeholder"=>"Username","readonly"=>"readonly" )); ?>
										
									</td>
									<th width="30%" valign="top" rowspan="6">
										<h3 class="avatar_caption">Avatar</h3>
										<img class="avatar" src="<?php echo Yii::app()->baseUrl."/".$user['avatar'];?>" alt="" />
										<div class="quicklinks">
											<h3>Quick Link</h3>
											<ul>
												<li><a class="link" href="<?php echo Yii::app()->baseUrl.'/admin/users/?action=usr_api&uid='.$user['id'];?>">Apis</a></li>
												<li><a class="link" href="<?php echo Yii::app()->baseUrl.'/admin/users/?action=usr_trans&uid='.$user['id'];?>">Transactions</a></li>
											</ul>
										</div>
									</th>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Email</th>
									<td>
<?php echo $form->textField($user,'email',array("class"=>"input1 input2","size"=>40,"placeholder"=>"email")); ?>
<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($user,'email'); ?></div>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Skype</th>
									<td>
<?php echo $form->textField($user,'skype',array("class"=>"input1 input2","size"=>40,"placeholder"=>"skype")); ?>
<div style="font-size:11px; color:#FF0000; font-weight:normal; padding:0px;"><?php echo $form->error($user,'skype'); ?></div>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Email Verified?</th>
									<td>
<?php $st = $user['status']!=0 ? "checked":"";
echo $form->checkBox($user,'status',array("checked"=>$st)); ?>
<?php if($user['status']==0){echo 'Not Verified!';}else{echo 'Verified!';}?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Google 2 Factor?</th>
									<td>
<?php if($user['is_g2a']=='no'){echo 'Not Activated!';}else{echo 'Activated!';}?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">User IC</th>
									<td>
<?php echo $form->textField($user,'IC',array("class"=>"input1 input2","size"=>40,"placeholder"=>"User IC")); ?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">IC Verified?</th>
									<td>
<?php $st = $user['IC_status']!= 'no' ? "checked" : "";
echo $form->checkBox($user,'IC_status',array("checked"=>$st));
if($user['IC_status']=='no'){echo 'Not Verified!';}else{echo 'Verified!';}?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Billing Address</th>
									<td>
<?php echo $form->textField($user,'billing_address',array("class"=>"input1 input2","size"=>40,"placeholder"=>"User Billing Address!")); ?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Billing Address?</th>
									<td>
<?php $st = $user['billing_address_status']!= 'no' ? "checked" : "";
echo $form->checkBox($user,'billing_address_status',array("checked"=>$st));
if($user['billing_address_status']=='no'){echo 'Not Verified!';}else{echo 'Verified!';}?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Status</th>
									<td>
<?php if($user['status']==0){
	echo 'Not verified!';
}elseif($user['status']==1 and ($user['is_g2a']==0 && $user['billing_address_status']==0 && $user['IC_status']==0)){
echo 'Pre-verified!';
}else{echo 'Verified!';}

?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Password</th>
									<td>
<?php echo $form->passwordField($user,'password',array("class"=>"input1 input2","size"=>40,"placeholder"=>"Password")); ?>
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Registered</th>
									<td>
										<?php echo $user['timstamp'];?>
									</td>
								</tr>

								<tr>
									<td bgcolor="#e5e5e5" align="center" colspan="3">
										<input class="button cancel" type="button" name="update" value="User List" onclick="location.href='<?php echo Yii::app()->baseUrl.'/admin/users/?action=edit';?>'" />
									</td>
								</tr>
							</table>
<?php $this->endWidget(); ?>
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
