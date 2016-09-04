<style>
.pr3 {cursor:pointer!important;}
</style>
<script>
$(document).ready(function(){
	 active_recursive();
var myVar=setInterval(function(){active_recursive()},5000);

	$('#active_order_ul').on("click",".pr3",function(){
		var id = $(this).parent().attr("id");
		if(id != "" && id!=undefined && confirm("Do you really want to delete the order!")){
		   $.ajax({url: "<?=Yii::app()->baseUrl.'/user/deluserorder'?>",
				  type: "post",
				  data: {q:id,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
			   success: function(dd){
							var tt = JSON.parse(dd);
							if(tt.status=="ok" ){
								$("#"+id).remove();
								//window.location.reload();
								callUserAmount();
							}
					  }
		   });

		}
	});
});
function active_recursive(){
   $.ajax({url: "<?=Yii::app()->baseUrl.'/welcome/getactiveorders'?>",
		  type: "post",
		  data: {pair:"<?=$cpair?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
	   			var cx = JSON.parse(dd);
				var elem = $('#active_order_ul');
				elem.html("");
				if(cx.data!=null){
				var tx = '<li><div class="dte dte2">Type</div> <div class="type type2">Amount(<?=$cinfo['coin_short']?>)</div> <div class="pr pr2">Price</div><div class="amt amt2">Total(<?=$cinfo['hard']?>)</div><div class="tot tot3">Date</div><div class="pr pr3">Action</div></li>';
				 for (var i=0;i<cx.data.length;i++){
					 if(i%2 != 0){
						 tx =tx+'<li id="act'+cx.data[i].id+'"><div class="dte dte2">'+cx.data[i].type+'</div> <div class="type type2">'+cx.data[i].amount+'</div> <div class="pr pr2">'+cx.data[i].rate+'</div><div class="amt amt2">'+cx.data[i].total+' <?=$cinfo['hard']?></div><div class="tot tot3">'+cx.data[i].timestamp+'</div><div class="pr pr3">Delete</div></li>';
					 }else{
						 tx =tx+'<li id="act'+cx.data[i].id+'"><div class="dte dte2">'+cx.data[i].type+'</div> <div class="type type2">'+cx.data[i].amount+'</div> <div class="pr pr2">'+cx.data[i].rate+'</div><div class="amt amt2">'+cx.data[i].total+' <?=$cinfo['hard']?></div><div class="tot tot3">'+cx.data[i].timestamp+'</div><div class="pr pr3">Delete</div></li>';
					 }				  
				 }
				 elem.html(tx);
				}

	          }
   });
}
</script>

    <div class="Trdhis">
    <div class="widget-head trhwid">
                    <h3>Your Currrent Active Orders</h3>
     </div>
     <div class="widget-content" style="overflow:auto !important;float:left;">
     <div class="Trdhisbox">
	<ul class="Trdhislisting" id="active_order_ul">
	
		<li><div class="dte dte2">Type</div> <div class="type type2">Amount(<?=$cinfo['coin_short']?>)</div> <div class="pr pr2">Price</div><div class="amt amt2">Total(<?=$cinfo['hard']?>)</div><div class="tot tot3">Date</div><div class="pr pr3">Action</div></li>

	</ul>

     </div>
     </div>
    </div>
