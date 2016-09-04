<div class="wrapper">
<div class="btcconm">

<div class="banm">
  <img src="images/banner.png" width="929" height="320"  alt=""/> </div>
<div class="cntnm">
<div class="cntn">
<div class="mnhd">
<h1>Details</h1>
</div>
<div class="lnm">
<div style="width:604px; float:left; box-shadow:none; border:none;" class="right_sec">
<?php $m_data = array("fee"=>$fee,"cinfo"=>$cinfo,"cpair"=>$cpair,'amounts'=>$amounts,'settings'=>$settings,'av_pair'=>$av_pair);?>
	<?php $this->renderPartial("/module/map",$m_data);?>

	<?php $this->renderPartial("/module/sellOrder",$m_data);?>

	<?php $this->renderPartial("/module/buyOrder",$m_data);?>

	<?php $this->renderPartial("/module/tradeHistory",$m_data);?>

	<?php $this->renderPartial("/module/userCurrentActiveOrder",$m_data);?>


</div>
<div style="min-height:500px; border:none;" class="left_sec">

	<?php $this->renderPartial("/module/calc",$m_data);?>

	<?php $this->renderPartial("/module/chat");?>

	<?php //$this->renderPartial("/module/userPanel");?>

	<?php //$this->renderPartial("/module/announcement");?>

</div>
</div>
</div>
</div>
</div>
</div>
