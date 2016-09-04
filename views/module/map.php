<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
			var gind = null;
      google.load('visualization', '1', {packages: ['corechart']});
	  google.setOnLoadCallback(load_data);
	  function load_data(){
	  jQuery('#chart_div').html('<img src="images/loader64.gif"/>');
		jQuery.ajax({url: "<?=Yii::app()->baseUrl."/welcome/tradeHistory"?>",
					type: "post",
					data: {to:'All',
						   pair:"<?php echo (@$_GET['pair'])?$_GET['pair']:$cpair;?>",
					       'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
			   success: function(data){
				   	gind = JSON.parse(data)
						if(gind.data.length > 0){
						jQuery('#chart_div').css('height','200px');
							drawVisualization(gind.data);
						}else{
							jQuery('#chart_div').html("No measurment data is available!");
						}
				   }
			   });
	  }
	  function reload_data(param){
	  jQuery('#chart_div').html('<img src="images/loader64.gif"/>');
		jQuery.ajax({url: "<?=Yii::app()->baseUrl."/welcome/tradeHistory"?>",
					type: "post",
					data: {to:param,pair:"<?php echo (@$_GET['pair'])?$_GET['pair']:$cpair;?>",'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
			   success: function(data){
				   	gind = JSON.parse(data)
						if(gind.data.length > 0){
						jQuery('#chart_div').css('height','200px');
							drawVisualization(gind.data);
						}else{
							jQuery('#chart_div').html("No measurment data is available!");
						}
				   }
			   });
	  }
      function drawVisualization(gind){
		var tt = []
		for (var i=0;i<gind.length;i++){
		var temp  = [gind[i].date,Number(gind[i].min),Number(gind[i].open),Number(gind[i].close),
		Number(gind[i].max)]
		 tt.push(temp)
		}
		var data = google.visualization.arrayToDataTable(tt, true);
        var options = {
          legend:'none',
          colors:['#F97908']
        };

        var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<script>
$(document).ready(function(){
 $('ul.zoomlist li').click(function(){
  $('ul.zoomlist li').each(function(){
  $(this).removeClass("zoac");
  });
  $(this).addClass("zoac");
	reload_data($(this).attr('v'));
 });
});
</script>
  
<div class="trans">
<ul class="translist" style="position:relative; width:100%; float:left;">
<?php if(count($av_pair)>0){foreach($av_pair as $k){ ?>

<li <?php $pp = (@$_GET['pair'])?$_GET['pair']:$cpair; if($pp==$k['cpair_slug']){echo 'class="hac1"';}?>>
	<a href="<?=Yii::app()->baseUrl."/trade/".$k['cpair_slug']?>"><?php echo strtoupper(str_replace("_","/",$k['cpair_slug']));?></a>
</li>	

<?php }}?>
</ul>
<div id="chart_div" style="float:left; width:100%;"></div>

</div>
