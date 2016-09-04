
<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Trade history");?></h1>
<div class="lorn_box">
	<?php $this->renderPartial('_profile_left_side');?>

<div class="right_sec right_sec2">   
  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="table_one table_two">
  <tr>
    <th width="14%" align="left"><?php echo Yii::t("content","Pair");?></th>
    <th width="10%" align="left"><?php echo Yii::t("content","Type");?></th>
    <th width="18%" align="left"><?php echo Yii::t("content","Price");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Amount");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Total");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Date");?></th>
  </tr>
  <tbody id="list_order_history">
<?php if(count($trades)>0){
foreach($trades as $k){?>
  <tr>
    <td align="left"><?= strtoupper($k['pair'])?></td>
    <td align="left"><?=$k['type']?></td>
    <td align="left"><?=(float)$k['rate']?></td>
    <td align="left"><?=(float)$k['amount']?></td>
	<td align="left"><?=(float)$k['total']?></td>
    <td align="left"><?=date("d.m.Y H:i",strtotime($k['timestamp']))?></td>
  </tr>
<?php }}else{?>
<tr><td colspan="6" align="center"><i>There are no orders!</i></td></tr>
<?php }?>  
  </tbody>
<tr><td colspan="6" align="center">
<strong>Total Record(s): <?php echo $total;?></strong>
<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
</td></tr>

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
