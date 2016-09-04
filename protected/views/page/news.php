<div class="wrapper">
<div class="btcconm">

<div class="banm">
  <img src="images/banner.png" width="929" height="320"  alt=""/> </div>
<div class="cntnm">
<div class="cntn">
<div class="mnhd">
<h1>Latest news</h1>
</div>
<div class="lnm">
<div style=" border:#d4d4d4 solid 1px !important; margin:0px 0px 0px 10px; width:603px; float:left; border-radius:5px 5px 5px 5px;" class="right_sec">
    <div class="news_k">
         <div style="min-height:120px;" class="tr_news">
             <div class="title">News</div>
             <div class="main_news">
                <ul class="nli">
				<?php if(count($news)>0){foreach($news as $k){?>
					<li>
						<h3>- <?php echo $k['headline'];?></h3>
						<em><?php echo date("jS F Y",strtotime($k['timestamp']));?></em>
						<?php echo $k['news'];?>
					</li>
				<?php }}?>                
                </ul>                
                <?php /* if(sizeof($news) < $total) { ?>
				<div class="page-link">
					<strong><a href="<?php echo Yii::app()->baseUrl.'/news/archive';?>">See more &raquo;</a></strong>
				</div>
				<?php }*/ ?>
             </div>
		 </div>
    </div>
</div>
<div style="min-height:500px; border:none;" class="left_sec">

<?php $this->renderPartial("/module/chat");?>


</div>
</div>
<?php $this->renderPartial("/user/_icons");?>
</div>
</div>



</div>
</div>
