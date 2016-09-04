
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
							Edit Contatc-us Subject
						</div> <br/>
                        <div>

<?php $form = $this->beginWidget('CActiveForm',
								 array(
									'id'=>'contact-subject-edit-form',
									'htmlOptions'=>array("enctype"=>"multipart/form-data"),
								 )); 
?>
<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">

	<tr>
		<th bgcolor="#e3e3f3" align="right">Contact-us Subject:</th>
		<td>
			<?php echo $form->textField($model,"subject",array('placeholder'=>"Contact-us subject *"));?>
			<font color="#FF0000"><?php echo $form->error($model,'subject'); ?></font>
		</td>
	</tr>

	<tr>
		<th bgcolor="#e3e3f3" align="center" colspan="2">
			<input type="submit" name="request" value="Save" />&emsp;
			<input type="reset" name="request" value="Reset" />
		</th>
	</tr>

</table>
<?php $this->endWidget();?>

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
