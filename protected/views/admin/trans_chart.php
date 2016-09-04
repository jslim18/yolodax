
  <div id="middle">
    <?php $this->renderPartial('_leftSide'); ?>
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
                        <div class="heading">Transactions &laquo; Chart</div> <br/>
                        <div class="trans">
							<div class="filtertool">
								<label for="chart_dur">Time Duration :
									<select id="chart_dur" name="dur" onChange="return changeDurTime(this);">
										<option value="today">Today</option>
										<option value="week" <?php echo (in_array('week', $dur))?'selected="selected"':null;?>>Week</option>
										<option value="month" <?php echo (in_array('month', $dur))?'selected="selected"':null;?>>Month</option>
										<option value="year" <?php echo (in_array('year', $dur))?'selected="selected"':null;?>>Year</option>
									</select>
								</label>
								<span><?php echo date('M d, Y H:i:s', $date_range->from);?>&nbsp;&ndash;&nbsp;<?php echo date('M d, Y H:i:s', $date_range->to);?></span>
							</div>
							<div class="chart">
								<!--Div that will hold the pie chart-->
								<div id="chart_div"></div>
							</div>
						</div>
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
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
var siteurl = '<?php echo Yii::app()->baseUrl."/admin"?>';
  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart', 'table']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {
	
	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	data.addRows(<?php echo json_encode($trans);?>);

	// Set chart options
	var options = {
		'title': '<?php echo $ctitle;?>',
		'width': 550,
		'height': 330,
		'is3D': true
	};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	
	function selectHandler() {
		var selectedItem = chart.getSelection()[0];
		if (selectedItem) {
			var topping = data.getValue(selectedItem.row, 0);
			//var uri = siteurl + '/trans/?action=cchart&currency=' + topping.toLowerCase();
			//history.pushState(null, null, uri);
			//location.reload();
			location.href = siteurl + '/trans/?action=cchart&currency=' + topping.toLowerCase();
		}
	}

	google.visualization.events.addListener(chart, 'select', selectHandler);
	chart.draw(data, options);
  }
  
  var request = <?php echo $query_string;?>;
  function changeDurTime(obj) {
	request[obj.name] = obj.value;
	var query = $.param( request, true );  
	location.href = siteurl + '/trans/?' + query;
  }
</script>
