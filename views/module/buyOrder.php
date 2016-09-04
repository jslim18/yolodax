
<script>
$(document).ready(function(){
buy_recursive();callUserAmount();
var myVar=setInterval(function(){buy_recursive();callUserAmount();},5000);
});

function buy_recursive(){
   $.ajax({url: "<?=Yii::app()->baseUrl.'/welcome/getbuyorders'?>",
		  type: "post",
		  data: {coin:"<?=$cinfo['coin']?>",hard:"<?=$cinfo['hard']?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
	   			var cx = JSON.parse(dd);
				var elem = $('#buy_order_div #buy_order_ul');
				elem.html("");
				if(cx.data!=null){
				var tx ='<li><div class="wbr wbr2"><div class="prc">Price</div> <div class="oe">Quantity<? //$cinfo['coin_short']?></div><? // <div class="usd">$cinfo['hard']</div>?></div></li>'
				 for (var i=0;i<cx.data.length;i++){
					 var cl = "wbr wbr2";
					 if(i%2 == 0){cl="lgr lgr2";}
				  tx =tx+'<li><div class="'+cl+'"><div class="prc">'+cx.data[i].rate+'</div> <div class="oe">'+cx.data[i].amount+'</div> <? //<div class="usd">'+cx.data[i].total+'</div>?></div></li>';
				 }
				 elem.html(tx);
				}
	   			
	          }
   });
}
</script>

    <div class="sellorder buyorder">
	<div class="widget-head head2">
         <h3>Buy Orders</h3>
    </div>    
	<p id="buytotall">Total&nbsp;<?=$cinfo['hard']?>&nbsp;Volume:</p>
	<div class="widget-content">
	<div class="sellorderbox" id="buy_order_div">
	<ul class="sellorderlisting" id="buy_order_ul">
    <li><div class="wbr wbr2"><div class="prc">Price</div> <div class="oe">Quantity<? //$cinfo['coin_short']?></div><? // <div class="usd">$cinfo['hard']</div>?></div></li>
    
    </ul>
	</div>
	</div>
                </div>