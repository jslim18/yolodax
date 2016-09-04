
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
							Imported Addresses List
						</div> <br/>
<div align="center" style="padding-top:10px; font-size:14px; color:#FF0000;">
	<span style="color:#00FF00; font-weight:bold;">
		<?php echo Yii::app()->user->getFlash("success");?>
	</span>
</div>


<table width="100%" bgcolor="#101010" cellspacing="1" cellpadding="3" class="table-short">
<thead bgcolor="#f9f9f9">
  <tr class="header" align="left">
	<th width="5%">S.No</th>
	<th width="10%">Label</th>
	<th width="10%">Currency</th>
	<th width="30%">Address</th>
	<th width="25%">File Location</th>
	<th width="10%">Date</th>
	<th width="10%">Action</th>
  </tr>
</thead>
<tbody bgcolor="#ececec">
<?php $i=0; if(sizeof($adds)>0){foreach($adds as $k){$i++;?>
  <tr id="tr<?php echo $k['id'];?>">
	<td>
	<?php echo $i;?>
	</td>
	<td>
	<?php echo $k['label'];?>
	</td>
	<td>
	<?php echo $k['currency'];?>
	</td>
	<td>
	<?php echo $k['address'];?>
	</td>
	<td>
	<?php echo $k['uploaded_file'];?>
	</td>
	<td>
	<?php echo $k['timestamp'];?>
	</td>
	<td>
	 <?php 
echo CHtml::ajaxLink(
	'Delete',
	array("/ccurrency/import_delete"),
	array(
		'type'=>'POST',
		'data'=>array("q"=>$k['id'],'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
		'success' => 'function(d) {
          $("#tr"+d).remove();
        }',
	),
	array("href"=>"javascript:void(0);","confirm"=>"Are you sure?","class"=>"link button_grey")
);
?>
	</td>
  </tr>
<?php }} ?>

<tfoot bgcolor="#f9f9f9">
  <tr>
	<td colspan="7">
		<strong>Total Record(s): <?php echo $total;?></strong>
		<?php $this->widget('CLinkPager', array('pages' => $pages,)) ?>
	</td>
  </tr>
</tfoot>
								</tbody>
							  </table>
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