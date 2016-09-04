<?php $this->load->view('admin/includes/header'); ?>

<div id="middle">
    <?php $this->load->view('admin/includes/leftSide'); ?>
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
                        <div class="heading">Registered Users</div> <br/>
                        <div>
                    <form action='<?=base_url()."admin/userList"?>' method="post">
                      <table width="100%" class="table-short">
                        <thead>
                          <tr class="header" align="left">
                            <td>&nbsp;</td>
                            <td align="center"><b>Name</b></td>
                            <td align="center"><b>Email</b></td>
                          
                            <td colspan="2" align="center"><b>Action</b></td>
                          </tr>
                        </thead>
                      </table>
                    </form>
                    <span class="clearFix">&nbsp;</span> </div>
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

<?php $this->load->view('admin/includes/footer'); ?>