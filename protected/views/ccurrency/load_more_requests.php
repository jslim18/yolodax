
	<?php if(!empty($widreqs)){foreach($widreqs as $w){ ?>
	  <tr>
	    <td><input type="checkbox"  class="checkbox1" value="<?php echo $w['wid'];?>" /></td>
		<td align="left">
			<?php echo $w['currency'];?>
		</td>									
		<td align="center">
			<?php echo $w['username'];?>
		</td>
		<td align="right">
			<?php echo $w['amount'];?>
		</td>
		<td align="center">
			<?php echo $w['address'];?>
		</td>
		<td align="center">
			<strong><?php echo ucwords($w['status']);?></strong>
		</td>
		<td>
			<?php echo date('M d, Y (H:i)', strtotime($w['created']));?>
		</td>
		<td>
<?php echo CHtml::beginForm($action,"POST",array("name"=>"with".$w['wid'])); ?>
 <input type="hidden" name="wid" value="<?php echo $w['wid'];?>" />
	<select name="with_action" onchange="document.forms['with<?php echo $w['wid'];?>'].submit();">
		<option value="">-Select-</option>
		<option <?php echo ($w['status']=='completed')?'selected="selected"':null;?> value="completed">Completed</option>
		<option <?php echo ($w['status']=='cancelled')?'selected="selected"':null;?> value="cancelled">Cancelled</option>
		<option <?php echo ($w['status']=='processing')?'selected="selected"':null;?> value="processing">Processing</option>
	</select>
</form>
		</td>
	  </tr>
	<?php }} ?>