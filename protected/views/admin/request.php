
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
							Contact Request
						</div> <br/>
                        <div>

<table width="100%" class="table-short" bgcolor="#f0f0f0" cellpadding="10" cellspacing="1">

	<tr>
		<th bgcolor="#e3e3f3" align="right">First name:</th>
		<td>
			<?php echo $request['fname'];?>
		</td>
	</tr>

	<tr>
		<th bgcolor="#e3e3f3" align="right">Last name:</th>
		<td>
			<?php echo $request['lname'];?>
		</td>
	</tr>

	<tr>
		<th bgcolor="#e3e3f3" align="right">Request For:</th>
		<td>
			<?php echo $request['subject'];?>
		</td>
	</tr>

	<tr>
		<th bgcolor="#e3e3f3" align="right">Email:</th>
		<td>
			<?php echo $request['email'];?>
		</td>
	</tr>

	<tr>
		<th bgcolor="#e3e3f3" align="right">Message:</th>
		<td>
			<?php echo $request['message'];?>
		</td>
	</tr>

</table>


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
