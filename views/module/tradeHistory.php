<script>
var LASTTRADE = null
$(document).ready(function(){
 trade_history_recursive();
var myVar=setInterval(function(){trade_history_recursive()},5000);
});
function trade_history_recursive(){
     var f = $('#trade_history_div').attr("last");
	 if(f==null){
	  f = LASTTRADE
	 }
   $.ajax({url: "<?=Yii::app()->baseUrl.'/welcome/gettradehistory'?>",
		  type: "post",
		  data: {coin:"<?=$cinfo['coin']?>",hard:"<?=$cinfo['hard']?>",q:f,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(data){
	   		   var dd = JSON.parse(data);
	   		   var elem = $('#trade_history_ul');

	   		   elem.html("");
			   if(dd.data != null){
			   var tx ='<li><div class="dte">Date</div> <div class="type">Type</div> <div class="pr">Price</div><div class="amt">Amount</div><div class="tot">Total</div></li>'
				 for (var i=0;i<dd.data.length;i++){
					 if(i%2 != 0){
						 tx =tx+'<li><div class="dte">'+dd.data[i].timestamp+'</div> <div class="type">'+dd.data[i].type+'</div> <div class="pr">'+dd.data[i].rate+'</div><div class="amt">'+dd.data[i].amount+'</div><div class="tot">'+dd.data[i].total+'</div></li>';
					 }else{
						 tx =tx+'<li><div class="lgr"><div class="dte">'+dd.data[i].timestamp+'</div> <div class="type">'+dd.data[i].type+'</div> <div class="pr">'+dd.data[i].rate+'</div><div class="amt">'+dd.data[i].amount+'</div><div class="tot">'+dd.data[i].total+'</div></div></li>';
					 }
				  
				 }
				 elem.html(tx);
			   } 	 
			   if(dd.last != null){$('#trade_history_div').attr("last",dd.last);LASTTRADE=dd.last;}
	          }
   });
}
</script>

    <div class="Trdhis">
    <div class="widget-head trhwid">
                    <h3>Trade History</h3>
     </div>
     <div style="overflow:auto !important;float:left;" class="widget-content">
     <div class="Trdhisbox" id="trade_history_div">
     	<ul class="Trdhislisting" id="trade_history_ul">
        <li><div class="dte">Date</div><div class="type">Type</div><div class="pr">Price</div><div class="amt">Amount</div><div class="tot">Total</div></li>
        </ul>
     </div>
     </div>
    </div>
