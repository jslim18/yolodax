
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
									'id'=>'commission-edit-form',
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
