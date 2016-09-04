
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
							Manage Cryptocurrency Pair
						</div> <br/>
                        <div>

<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'currency-pair-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
							<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">
								<tr>
									<th width="30%" bgcolor="#e3e3f3" align="right">Pair Currency one</th>
									<td width="40%">
										<select id="cone" name="CcurrencyPair[cpair_one]">
											<option value="" data-code="">&mdash; Select Currency &mdash;</option>
											<?php foreach($ccurr as $c): ?>
											<option <?php if($c['currency']==$model->cpair_one)echo 'selected="selected"'; ?> value="<?php echo $c['currency'];?>" data-code="<?php echo strtolower($c['currency_short']);?>"><?php echo $c['currency'];?></option>
											<?php endforeach; ?>
										</select>
										<font color="#FF0000"><?php echo $form->error($model,'cpair_one'); ?></font>	
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Pair Currency two</th>
									<td>
										<select id="ctwo" name="CcurrencyPair[cpair_two]">
											<option value="" data-code="">&mdash; Select Currency &mdash;</option>
											<?php foreach($ccurr as $c): ?>
											<option <?php if($c['currency']==$model->cpair_two)echo 'selected="selected"'; ?> value="<?php echo $c['currency'];?>" data-code="<?php echo strtolower($c['currency_short']);?>"><?php echo $c['currency'];?></option>
											<?php endforeach; ?>
										</select>
										<font color="#FF0000"><?php echo $form->error($model,'cpair_two'); ?></font>	
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="right">Pair Slug</th>
									<td>
										<input id="cpair_slug" type="text" name="CcurrencyPair[cpair_slug]" size="12" readonly="readonly" value="<?php echo $model->cpair_slug;?>" /><br>
										<font color="#FF0000"><?php echo $form->error($model,'cpair_slug'); ?></font>	
									</td>
								</tr>
								<tr>
									<th bgcolor="#e3e3f3" align="center" colspan="2">
										<input type="submit" name="request" value="Update" />&emsp;<input type="button" name="request" value="Cancel" onClick="javascript:history.go(-1);" />
									</th>
								</tr>
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

<script type="text/javascript">

(function($){
	var cone, ctwo, pslug = '';
	$('select[name^="CcurrencyPair"]').on('change', function(e){
		var cone = $('#cone').find("option:selected").attr("data-code");
		var ctwo = $('#ctwo').find("option:selected").attr("data-code");
		if(cone!="" && ctwo!="" && cone!=ctwo){
			$("#cpair_slug").val(cone+"_"+ctwo);
		}else{$("#cpair_slug").val("");}
	});

})(jQuery);
</script>
