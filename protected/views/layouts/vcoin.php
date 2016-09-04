<!doctype html>
<html>
<head>
<base href="<?php echo Yii::app()->baseUrl; ?>/"/>
<meta charset="utf-8">
<title>:.<?php echo Yii::app()->name;?>.:</title>
<?php //Yii::app()->clientScript->registerPackage('mscc'); ?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="aadmin/js/jquery-1.10.2.min.js"></script>
</head>

<body>
<div class="headerfull">
<div class="wrapper">
<div class="hdr">
	<div class="lgo">
    <a href="<?php echo Yii::app()->baseUrl;?>">
		<img src="images/logo.png" />
	</a>
    </div>
	    

    <div class="hdr_menue">
<?php $currentURL = Yii::app()->controller->getRoute();
$arrCT = array("user/edit_profile","user/avatar","user/change_password","user/g2a");
?>
    <ul>
    <li <?php if($currentURL=="welcome/index"){echo 'class="select"';}?>><a href="<?php echo Yii::app()->getBaseUrl();?>">Home</a></li>
    <li <?php if($currentURL=="user/profile"){echo 'class="select"';}?>><a href="<?php echo Yii::app()->getBaseUrl()."/user/profile";?>">Account </a></li>
    <li <?php if($currentURL=="welcome/trade"){echo 'class="select"';}?>><a href="<?php echo Yii::app()->getBaseUrl()."/trade";?>">Buy / Sell  </a></li>
    <li <?php if($currentURL=="user/order_history"){echo 'class="select"';}?>><a href="<?php echo Yii::app()->getBaseUrl()."/user/order_history";?>"> Order book</a></li>
    <li <?php if($currentURL=="user/funds"){echo 'class="select"';}?>><a href="<?php echo Yii::app()->getBaseUrl()."/user/funds";?>">Deposit </a></li>

<?php if(Yii::app()->user->id == null){?>
    <li <?php if($currentURL=="welcome/login"){echo 'class="select"';}?>><a style="font-size:12px; font-weight:bold;" href="<?php echo Yii::app()->baseUrl."/login"?>"><?php echo Yii::t("header","Login");?></a></li>
    <li <?php if($currentURL=="welcome/signup"){echo 'class="select"';}?>><a style="font-size:12px; font-weight:bold;" href="<?php echo Yii::app()->baseUrl."/signup"?>"><?php echo Yii::t("header","Signup");?></a></li>
	<?php }else{ ?>
	<li <?php if(in_array($currentURL,$arrCT)){echo 'class="select1"';}?>><a style="background:none!important;color:#FFCC33;border:none!important;" href="<?php echo Yii::app()->request->baseUrl.'/user/edit_profile';?>">
				<?php echo Yii::app()->user->name?>
			</a></li>
	<li><a style="font-size:12px; font-weight:bold;" href="<?php echo Yii::app()->baseUrl."/logout"?>"><?php echo Yii::t("header","Logout");?></a></li>
	<?php } ?>
    </ul>
    </div>
    <div id="language-selector" style="float:right; margin:28px 0px 0px 0px;">
		<?php $this->widget('application.components.widgets.LanguageSelector'); ?>
	</div>
    
</div>
</div>
</div>


<?php echo $content; ?>



	<div class="ftrfull">
		<div class="wrapper">
		<div class="ftr">
		<p>Risk Warning: please note that Forex trading (OTC Trading) involves substantial risk of loss, and may not be suitable for everyone.</p>
		<span>Copyright &copy; 2014 Virtual coin&emsp;
		<a href="<?php echo Yii::app()->baseUrl.'/page/about';?>">About us</a>&emsp;|&emsp;
		<a href="<?php echo Yii::app()->baseUrl.'/page/terms';?>">Privacy Policy</a>&emsp;|&emsp;
		<a href="<?php echo Yii::app()->baseUrl.'/page/news';?>">News</a>&emsp;|&emsp;
		<a href="<?php echo Yii::app()->baseUrl.'/page/road_map';?>">Road Map</a>&emsp;|&emsp;
		<a href="<?php echo Yii::app()->baseUrl.'/page/contact';?>">Contact Us</a>
		<br />Virtual Coin is a registered trademark of virtual coin Ltd.</span>
	</div>
   </div>
  </div>

</body>
</html>
