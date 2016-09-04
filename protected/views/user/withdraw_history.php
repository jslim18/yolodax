
<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Withdraw history");?></h1>
<div class="lorn_box">
	<?php $this->renderPartial('_profile_left_side');?>

<div class="right_sec right_sec2">
  <table width="100%" border="0" cellspacing="1" cellpadding="3" class="table_one table_two">
  <tr>
    <th width="14%" align="left"><?php echo Yii::t("content","Currency");?></th>
    <th width="10%" align="left"><?php echo Yii::t("content","Amount");?></th>
    <th width="18%" align="left"><?php echo Yii::t("content","Address");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Status");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Date");?></th>
  </tr>
  <tbody id="list_order_history">
<?php if(count($withs)>0){
foreach($withs as $k){?>
  <tr>
    <td align="left"><?= strtoupper($k['currency'])?></td>
    <td align="left"><?=$k['amount']?></td>
    <td align="left"><?=$k['address']?></td>
    <td align="left"><?=$k['status']?></td>
    <td align="left"><?=date("d.m.Y, H:i",strtotime($k['created']))?></td>
  </tr>
<?php }}else{?>
<tr><td colspan="6" align="center"><i>There are no orders!</i></td></tr>
<?php }?>  
  </tbody>
<tr>
	<td colspan="6">
<strong>Total Record(s): <?php echo $total;?></strong>
<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
	</td>
</tr>
</table>
     </div>                  

</div>

<?php $this->renderPartial("_icons");?>
</div>
</div>

<script>
$(document).ready(function(){
$('table.table_one tr:even').css("background-color",'#ccc');
$('table.table_one tr:odd').css("background-color",'#dddddd');
});
</script>