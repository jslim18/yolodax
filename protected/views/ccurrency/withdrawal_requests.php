<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {
        if(this.checked) {
            $('.checkbox1').each(function() {
                this.checked = true;
            });
        }else{
            $('.checkbox1').each(function() {
                this.checked = false;
            });         
        }
    });
	
	$("#gogog").click(function(){
	 var arr = [];
		$(".checkbox1").each(function(){
			if(this.checked){
			 arr.push($(this).attr("value"));
			}
		});
	 $("input[name=wids]").val(arr.join(","));
	 if(arr.length > 0){
		document.forms['withexport'].submit();
		var myVar=setInterval(function(){window.location.reload();},1000);
	 }else{alert("Please select the records to export!");}
	 
	});
	
	$("select[id=with_all_action]").change(function(){
	 var arr = [];
	 var act = $(this).val();
		$(".checkbox1").each(function(){
			if(this.checked){
			 arr.push($(this).attr("value"));
			}
		});
	 $("input[name=wid]").val(arr.join(","));
	 if(arr.length > 0 ){
	  if(act != ""){
		document.forms['with_all'].submit();
		var myVar=setInterval(function(){window.location.reload();},1000);
	  }else{alert("Action is not appropriate!");}
	 }else{alert("Please select the records for actions!");}
	
	});	

	$("#load_more").click(function(){
	 var ty = "<?php echo $type;?>";
	 var rc = $(".checkbox1").last().attr("value");
	 $.ajax({url: "<?=Yii::app()->baseUrl.'/ccurrency/getmorerequests'?>",
		  type: "post",
		  data: {type:"<?=$type?>",rc:rc,ct:'<?=$url?>','YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
	    var dt = JSON.parse(dd);
		 if(dt.status == "ok"){
		  $("table.table-short tbody").append(dt.msg);
		 }else{
		  $("#load_more").attr("disabled","disabled");
		 }
	   }
	 });
	});	
    
});
</script>
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
							Users &raquo; Withdrawal <?php echo $action_title;?>
						</div><br/>
                        <div>

<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
	<span style="color:#00FF00; font-weight:bold;">
		<?php echo Yii::app()->user->getFlash("success");?>
	</span>
</div>

<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="3" class="table-short">
	<thead bgcolor="#f9f9f9">
	  <tr class="header" align="center" height="40">
	    <th width="3%"><input type="checkbox" id="selecctall"/></th>
		<th width="7%">Currency</th>
		<th width="10%">Username</th>									
		<th width="10%">Amount</th>
		<th width="25%">Address</th>
		<th width="15%">Status</th>
		<th width="20%">Date</th>
		<th width="10%">Action</th>
	  </tr>
	</thead>
	<tbody bgcolor="#ececec">
	<?php if( !empty($widreqs) ){foreach($widreqs as $w){ ?>
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
	<?php } ?>
	</tbody>
	<tfoot bgcolor="#f9f9f9">
	  <tr>
		<td colspan="6">
<strong>Total Record(s): <?php echo $total;?></strong>
<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
		</td>
		<td> <button style="cursor:pointer;" id="load_more" class="botton">Load More &raquo;</button></td>
		<td>
<?php if($type=="pending,processing"){?>

<?php echo CHtml::beginForm(Yii::app()->getBaseUrl(true)."/ccurrency/withdraw_export","POST",array("name"=>"withexport","target"=>"_blank")); ?>
<input type="hidden" value="<?=$type?>" name="with_type"  />
<input type="hidden" value="" name="wids" />
</form>
	<button style="cursor:pointer;" id="gogog" class="botton">Export &raquo;</button>
<?php }else{?>
<?php echo CHtml::beginForm("","POST",array("name"=>"with_all")); ?>
 <input type="hidden" name="wid" value="" />
	<select name="with_action" id="with_all_action">
		<option value="">-Select-</option>
		<option value="completed">Completed</option>
		<option value="cancelled">Cancelled</option>
		<option value="processing">Processing</option>
	</select>
</form>
<?php } ?>
		</td>
	  </tr>
	</tfoot>
<?php }else{ ?>
<tr>
	<td colspan="8">There is no recrod found!</td>
</tr>
<?php }?>	
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