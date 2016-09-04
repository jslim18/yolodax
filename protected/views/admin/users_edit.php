
<div id="middle">
	<?php $this->renderPartial("_leftSide");?>
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
                        <div class="heading">Manage Users</div><br/>
<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
	<span style="color:#00FF00; font-weight:bold;">
		<?php echo Yii::app()->user->getFlash("success");?>
	</span>
</div>
                        <div>
<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
<thead bgcolor="#f9f9f9">
  <tr class="header" align="left" height="40">
	<th width="5%">Avatar</th>
	<th width="15%">Name</th>
	<th width="20%">Email</th>
	<th width="10%">Account</th>
	<th width="12%">Status</th>
	<th width="20%" align="center">Action</th>
  </tr>
</thead>
<tbody bgcolor="#ececec">
<?php foreach($users as $u) : ?>
  <tr>
	<td>
		<img src="<?php echo Yii::app()->baseUrl."/upload/thumb/".$u['avatar'];?>" width="60" height="60" alt="" />
	</td>
	<td>
		<?php echo $u['username'];?>
	</td>
	<td>
		<?php echo $u['email'];?>
	</td>
	<td>
<?php
if($u['status']==0){
echo 'Not verified!';
}elseif(($u['status']==1 or $u['verify']==1) and ($u['is_g2a']=="no" or $u['billing_address_status']=="no" or $u['IC_status']=="no")){
echo 'Pre-verified!';
}else{echo 'Verified!';}

?>
	</td>
	<td>
		<em><?php echo date('M d, Y', strtotime($u['last_action_at']));?><br/><?php echo date('H:i:s', strtotime($u['last_action_at']));?></em>
	</td>
	<td>
		<p>
			<a class="link button_grey left" href="<?php echo Yii::app()->baseUrl.'/admin/users_edit?uid='.$u['id']; ?>" title="Edit">
				<strong>Edit</strong>
			</a>
		</p>
		<p>
			<a class="link button_grey left" href="<?php echo Yii::app()->baseUrl.'/admin/users_view?&uid='.$u['id']; ?>" title="View user">
				<strong>View</strong>
			</a>
		</p>

		<p>
			<a class="link button_grey left" href="<?php echo Yii::app()->baseUrl.'/admin/users/?action=usr_trans&uid='.$u['id']; ?>" title="Transactions">
				<strong>Trans</strong>
			</a>
		</p>
	</td>
  </tr>
<?php endforeach; ?>
</tbody>
<tfoot bgcolor="#f9f9f9">
  <tr>
	<td colspan="6">
		<strong>Total Record(s): <?php echo $total;?></strong>
		<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
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