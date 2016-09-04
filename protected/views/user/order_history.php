<script type="text/javascript">
$(document).ready(function(){
 $('select[name=pair],select[name=type],select[name=done_status]').change(function(){
   var pair = $('select[name=pair]').val();
   var type = $('select[name=type]').val();
   var stat = $('select[name=done_status]').val();
   $('#list_order_history').html("<tr><td align='center' colspan='7'><img src='images/loader64.gif'/></td></tr>");
	call_orders(pair,type,stat);
 });
});
function call_orders(a,b,c){
	$.ajax({url: "<?=Yii::app()->baseUrl.'/user/user_order_history'?>",
	  type: "post",
	  data: {pair:a,type:b,stat:c,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	  success: function(dd){
			var cx = JSON.parse(dd);				
			if(cx.data!=null){
			var tx =''
			 for (var i=0;i<cx.data.length;i++){
			  tx =tx+'<tr><td align="left">'+cx.data[i].pair+'</td><td align="left">'+cx.data[i].type+'</td><td align="left">'+cx.data[i].price+'</td><td align="left">'+cx.data[i].amount+'</td><td align="left"><div style="background:#fff;width:100%;"><div style="background:#FF0000; text-align:center;width:'+cx.data[i].percentage+'%;">'+cx.data[i].percentage+'%</div></div></td><td align="left">'+cx.data[i].total+'</td><td align="left">'+cx.data[i].timestamp+'</td></tr>';
			 }
			 $('#list_order_history').html(tx);
			}else{
			$('#list_order_history').html("<tr><td align='center' colspan='7'><i>Nothing is found!</i></td></tr>")
			}
			$('table.table_two tr:even').css("background-color",'#ccc');
			$('table.table_two tr:odd').css("background-color",'#dddddd');
		  }
	});
}
</script>
<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Orders history");?></h1>
<div class="lorn_box">
<?php $this->renderPartial('_profile_left_side');?>

     <div class="right_sec right_sec2">
    <table width="100%" border="0" cellspacing="0" class="table_one" cellpadding="4">
      <tr>
        <td width="27%"><?php echo Yii::t("content","Pair");?>: 
          <select name="pair" style="width:120px;" class="input">
		  <option value="all">ALL</option>
		  <?php if(count($av_pairs)>0){foreach($av_pairs as $k){?>
		  <option value="<?php echo $k['cpair_slug'];?>"><?php echo strtoupper(str_replace("_","/",$k['cpair_slug']));?></option>
		  <?php }}?>
          </select>
          </td>
        <td width="28%"><?php echo Yii::t("content","Type");?>: &nbsp;
		<select name="type" style="width:120px;" class="input">
		  <option value="all">ALL</option>
		  <option value="sell">Sell</option>
		  <option value="buy">Buy</option>
        </select></td>
        <td width="43%"><?php echo Yii::t("content","Show");?>: &nbsp;
		<select name="done_status" style="width:120px;" class="input">
		  <option value="all">ALL</option>
		  <option value="Not_Done">Active</option>
		  <option value="Done">Filled</option>
		  <option value="Partial">Partly Filled</option>
		  <option value="Canceled">Canceled</option>
        </select></td>
        <td width="2%">&nbsp;</td>
      </tr>
    </table>
    
  <table width="100%" bgcolor="#f3f3f3" border="0" cellspacing="1" cellpadding="10" class="table_one table_two">
  <tr>
    <th width="14%" align="left"><?php echo Yii::t("content","Pair");?></th>
    <th width="10%" align="left"><?php echo Yii::t("content","Type");?></th>
    <th width="18%" align="left"><?php echo Yii::t("content","Price");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Amount");?></th>
	<th width="13%" align="left"><?php echo Yii::t("content","Complete");?>%</th>
    <th width="15%" align="left"><?php echo Yii::t("content","Total");?></th>
    <th width="15%" align="left"><?php echo Yii::t("content","Date");?></th>
  </tr>
  <tbody id="list_order_history">
<?php if(count($orders)>0){
foreach($orders as $k){?>
  <tr>
    <td align="left"><?= strtoupper($k['pair'])?></td>
    <td align="left"><?=$k['type']?></td>
    <td align="left"><?=(float)$k['rate']?></td>
    <td align="left"><?=(float)$k['amount']?></td>
	<td align="left">
	<div style="background:#fff;width:100%;">
		<div style="background:#FF0000; text-align:center;width:<?=floatval(number_format((float)(($k['how_much']+$k['commission']) * 100)/$k['amount'],4,'.',''))?>%;"><?=floatval(number_format((float)(($k['how_much']+$k['commission']) * 100)/$k['amount'],2,'.',''))?>%</div>
	</div>
	</td>
    <td align="left"><?=(float)$k['total']?></td>
    <td align="left"><?=date("d.m.Y H:i",strtotime($k['timestamp']))?></td>
  </tr>
<?php }}else{ ?>
<tr><td colspan="7" align="center"><i>There are no orders!</i></td></tr>
<?php }?>  
  </tbody>
  <tr><td colspan="7" align="center">
<strong>Total Record(s): <?php echo $total;?></strong>
<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
  </td></tr>

</table>

     </div>                  

</div>

<?php $this->renderPartial("_icons");?>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('table.table_two tr:even').css("background-color",'#ccc');
	$('table.table_two tr:odd').css("background-color",'#dddddd');
});
</script>
