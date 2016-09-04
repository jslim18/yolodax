
<script>
$(document).ready(function(){
sell_recursive();total_recursive();
var myVar=setInterval(function(){sell_recursive();total_recursive();},5000);
});

function sell_recursive(){
   $.ajax({url: "<?=Yii::app()->baseUrl.'/welcome/getsellorders'?>",
		  type: "post",
		  data: {coin:"<?=$cinfo['coin']?>",hard:"<?=$cinfo['hard']?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
	   			var cx = JSON.parse(dd);
				var elem = $('#sell_order_div #sell_order_ul');
				elem.html("");
				if(cx.data!=null){
					var tx ='<li><div class="wbr wbr2"><div class="prc">Price</div> <div class="oe">Quantity<? //$cinfo['coin_short']?></div><? // <div class="usd">$cinfo['hard']</div> ?></div></li>'
				 for(var i=0;i<cx.data.length;i++){
					 var cl = "wbr wbr2";
					 if(i%2 == 0){cl="lgr lgr2";}
					tx =tx+'<li><div class="'+cl+'"><div class="prc">'+cx.data[i].rate+'</div> <div class="oe">'+cx.data[i].amount+'</div><? // <div class="usd">'+cx.data[i].total+'</div></div></li> ?>'
				 }
				 elem.html(tx);
				}
	   			
	          }
   });
}

function total_recursive(){
   $.ajax({url: "<?=Yii::app()->baseUrl.'/welcome/gettotal'?>",
		  type: "post",
		  data: {p:"<?=$cpair?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
	   			var cx = JSON.parse(dd);
				var elems = $('#seltotall');
	   			var ht = elems.text().split(":");
	   			elems.html(ht[0]+":&nbsp;"+cx.amount);
				var elemb = $('#buytotall');
	   			var ht = elemb.text().split(":");
	   			elemb.html(ht[0]+":&nbsp;"+cx.total);
	          }
   });
}
</script>
    <div class="sellorder">
	<div class="widget-head head2">
         <h3>Sell Orders</h3>
    </div>
	<p id="seltotall">Total&nbsp;<?=$cinfo['coin_short']?>&nbsp;Volume:</p>
	<div class="widget-content">
	<div class="sellorderbox" id="sell_order_div">
	<ul class="sellorderlisting" id="sell_order_ul">
    <li><div class="wbr wbr2"><div class="prc">Price</div> <div class="oe"> Quantity<? //$cinfo['coin_short']?></div> <div class="usd"><? //$cinfo['hard']?></div></div></li>
    </ul>
	</div>
	</div>
                </div>
