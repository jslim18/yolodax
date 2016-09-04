
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
					 <div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
						<span style="color:#00FF00; font-weight:bold;"><?php echo Yii::app()->user->getFlash("success");?> </span>
					</div>
					<h2>Cryptocurrency Pairs</h2><br />
							<?php if( ! empty($cpairs) ) : ?>
							<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="10" class="table-short">
								<thead bgcolor="#f9f9f9">
								  <tr class="header" align="left" height="40">
									<th width="35%">Currency one</th>
									<th width="35%">Currency two</th>
									<th width="35%">Pair Slug</th>
									<th width="10%">Action</th>
								  </tr>
								</thead>
								<tbody bgcolor="#ececec">
								<?php foreach($cpairs as $p) : ?>
								  <tr id="tr<?php echo $p['pid'];?>">
									<td>
										<?php echo $p['cpair_one'];?>
									</td>
									<td>
										<?php echo $p['cpair_two'];?>
									</td>
									<td>
										<?php echo $p['cpair_slug'];?>
									</td>
									<td>
										<a href="<?php echo Yii::app()->baseUrl.'/ccurrency/pair_edit?cpid='.$p['pid'];?>" class="link button_grey" title="Edit">Edit</a>
<?php 
echo CHtml::ajaxLink(
	'Delete',
	array("/ccurrency/pair_delete"),
	array(
		'type'=>'GET',
		'data'=>array("cpid"=>$p['pid'],'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
		'success' => 'function(d) {
          $("#tr"+d).remove();
        }',
	),
	array("href"=>"javascript:void(0);","confirm"=>"Are you sure?","class"=>"link button_grey")
);
?>

									</td>
								  </tr>
								<?php endforeach; ?>
								</tbody>
								<tfoot bgcolor="#f9f9f9">
								  <tr>
									<td colspan="6">
										<strong>Total Record(s): <?php echo $total;?></strong>
										<?php $this->widget('CLinkPager', array('pages' => $pages,)); ?>
									</td>
								  </tr>
								</tfoot>
							  </table>
							<?php else : ?>
							<div class="error"><em>Invalid request, there is no record found!</em></div>
							<?php endif; ?>
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
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$cone = $_POST['CcurrencyPair']['cpair_one'];
	$ctwo = $_POST['CcurrencyPair']['cpair_two'];
}?>
(function($){
	var cone, ctwo, pslug = '';
	cone = '<?php echo @$cone;?>';
	ctwo = '<?php echo @$ctwo;?>';
	$('select[name^="CcurrencyPair"]').on('change', function(e){
		var cone = $('#cone').find("option:selected").attr("data-code");
		var ctwo = $('#ctwo').find("option:selected").attr("data-code");
		if(cone!="" && ctwo!="" && cone!=ctwo){
			$("#cpair_slug").val(cone+"_"+ctwo);
		}else{$("#cpair_slug").val("");}
	});

})(jQuery);
</script>
