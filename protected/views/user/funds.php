<script>

$(document).ready(function(){

	$('.load_cur').click(function(){
		var type = $(this).attr("id");
		var cur = $(this).attr("data-c");
		var im = "<div style='text-align:center;'><img src='./images/loader64.gif'/></div>";
		$('#loading_cur').show().html(im);
		$.ajax({ url: "<?=Yii::app()->baseUrl?>/user/load_cur",
				type: "post",
				data: {type:type,cur:cur,'YII_CSRF_TOKEN':"<?= Yii::app()->request->csrfToken?>"},
			 success: function(data){

						$("html, body").animate({
							scrollTop: $(document).height()
						},"slow");
						setTimeout(function(){$('#loading_cur').html(data);},1000);
			 			
			        }
		});
	});

	$("input[name=amount]").on("keyup",function(){
	 var v = Number($(this).val());
	 if(v >= 1){
	  $('input[name=to_receive]').val(v - 0.5);	
	 }else{
		  $("input[name=amount]").css("border","1px solid #FF0000");
		  $('input[name=to_receive]').val();
	 }

	});
	
	$('#withdraw_form').on("submit",function(){
	 if(confirm('Are you sure?')){
	   var v = Number($('input[name=amount]').val());
	   var ac = Number($('#ac_cur').html());
	    if(v > ac){
		 alert("Withdrawl amount is greater than actual!!!");
		 return false;
		}else{
		 return true;
		}
	 }else{
	  return false;
	 }
	});

});
</script>
<div class="wrapper">
<div class="btcconm">

<h1><?php echo Yii::t("content","Funds");?></h1>
<div class="lorn_box">
	<?php $this->renderPartial("_profile_left_side");?>

     <div class="right_sec right_sec2">
     <div class="infobox">

     <div class="funds">
     
<?php if(count($currn)>0){foreach($currn as $k){ ?>
     <div class="fund">
     <div class="m">
     <h4 style="padding:0px;"><?php echo $k->currency_short;?></h4>
     <p> <?php echo Yii::t("content","Balance");?>:
		 <span><?php $c = $k->currency;echo @$amounts->$c - @$locked[$c] - @$withdraw[$c];?></span> 
		 <?php echo Yii::t("content","Coins");?>
	 </p>
     </div>
     <div class="mmrt">
     <input type="button" value="<?php echo Yii::t("content","Deposit");?>" class="load_cur blr1" id="load_deposit" data-c="<?php echo $k->currency;?>">
     <input type="button" value="<?php echo Yii::t("content","Withdraw");?>" class="load_cur blr" id="load_withdraw" data-c="<?php echo $k->currency;?>">
     </div>
     </div>	
<?php }}else{ ?>

     <div class="fund">
     <div class="m">
     <h4>Message:</h4>
     <p>There is no crypto-currency added yet!</p>
     </div>
     </div>
     	
<?php }?>
     
          
	  <div class="fund" id="loading_cur" style="display:none;">
	    
	  </div>

</div>


     </div>
     </div>
</div>


<?php $this->renderPartial("_icons");?>

</div>
</div>
