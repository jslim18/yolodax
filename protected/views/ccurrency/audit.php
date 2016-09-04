<script>

$(document).ready(function(){

	$(".todepositamount").on("click",".btn",function(){
	 var cur=$(this).attr("cur");
	 var cnt = $(this).attr("cnt");
	 var add = $("#"+cur+cnt).val();
	 var im = '<img src="images/loading_16.png" />';
	  if(add != ""){
	  $("#val"+cur+cnt).html(im);
	  $("#"+cur+cnt).css("border","1px solid #C3C3C3");
		$.ajax({url: "<?=Yii::app()->getBaseUrl().'/ccurrency/audit_wallet'?>",
				  data: {q:add,c:cur,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
				  type: "post",
			   success: function(dt){
			   	var dd = JSON.parse(dt);
				   $("#val"+cur+cnt).html(dd.val);
					  }
		   });
	  }else{
	  	$("#"+cur+cnt).css("border","1px solid #ff0000");
	  }

	});

	$(".botton").click(function(){
	 var c = $(this).attr("cur");
		var co = $(this).attr("tt");
		co = Number(co) + 1;
		$(this).attr("tt",co);
		var it = '<input type="text" id="'+c+co+'" placeholder="Your wallet address!" class="added_option"/><span class="valuetext" id="val'+c+co+'">0.00000000</span><input type="button" cnt="'+co+'" value="Process" cur="'+c+'" class="btn"/>';
			$('.adding_'+c).append(it);	
	});

});
</script>
  <div id="middle">
    <?php $this->renderPartial('/admin/_leftSide'); ?>
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
							Auditing
						</div> <br/>
                          <div class="todepositamount">
						  <h2>Total Deposited Amount</h2>
							<?php foreach($curs as $k=>$v){?>
								<div class="amount">
									<?php echo strtoupper($k);?><br />
									<div class="Deposit">
									<?php echo isset($deposited[$k])?$deposited[$k]:"0.00000000";?>
									</div>
								</div>
							<?php }?>
						  </div>

						  <div class="todepositamount">
						  <h2>Total User Balances</h2>
							<?php foreach($curs as $k=>$v){?>
								<div class="amount">
									<?php echo strtoupper($k);?><br />
									<div class="Deposit">
									<?php echo isset($balances[$k])?$balances[$k]:"0.00000000";?>
									</div>
								</div>
							<?php }?>
						  </div>

						  <div class="todepositamount">
						  <h2>Total Commission Earned</h2>
							<?php foreach($curs as $k=>$v){?>
								<div class="amount">
									<?php echo strtoupper($k);?><br />
									<div class="Deposit"><?php printf("%.8f",$commission[$k]);?></div>
								</div>
							<?php }?>
						  </div>
<?php foreach($curs as $k=>$v){?>						  
	<div class="todepositamount">
		<h2>Check <?php echo ucfirst($k);?> Wallet(s)</h2>
			<div id="option_adding_div" class="adding_<?=$k?>">
				<input type="text" id="<?=$k?>1" placeholder="Your wallet address!" class="added_option"/>
				<span class="valuetext" id="val<?=$k?>1">0.00000000</span>
				<input type="button" cur="<?=$k?>" cnt="1" value="Process" class="btn"/>
			</div>
			<div class="addmore">
				<input style="float:left; margin:8px 0px 0px 11px;" type="button" class="botton" value="Add More..." tt="1" cur="<?=$k?>"/>
			</div>
	</div>
<?php } ?>
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