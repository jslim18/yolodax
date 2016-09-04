<script>
var LASTCHAT = null
$(document).ready(function(){
call_recursive();
$('#chatbox').scrollTop($('#chatbox').find('p').outerHeight());
var myVar=setInterval(function(){call_recursive()},5000);
 $('#do_chat').keyup(function(){
  var elem = $('#do_chat')
  var v = elem.val().trim();
  if(v.length > 200){
   elem.css({border:"1px solid #00FF00"});
   elem.val(""+v.substring(0,200));
   alert("Text is out of limit!");
  }
 });
 $("#chat_form").submit(function(){
   var elem = $('#do_chat')
   elem.addClass("chat_input");

  var v = elem.val().trim();
  if(v!=null && v!=""){
	  elem.val("");
   $.ajax({url: "<?=Yii::app()->baseUrl.'/chat/instChat'?>",
   		  data: {q:v,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
		  type: "post",
	   success: function(data){
			   call_recursive()
			   elem.val("");
			   elem.removeClass("chat_input");
			   elem.attr("placeholder","Please Insert Your Text!");
			   elem.focus();
	          }
   });
  }else{
   elem.css({border:"1px solid #FF0000"});
   elem.val("");
   elem.attr("placeholder","Please Insert Your Text!");
  }
 return false;	
 });
});

function call_recursive(){
     var f = $('.chtbox').attr("id");
	 if(f==null){
	  f = LASTCHAT
	 }
   $.ajax({url: "<?=Yii::app()->baseUrl.'/chat/getChat'?>",
		  type: "post",
		  data: {q:f,'YII_CSRF_TOKEN':"<?php echo Yii::app()->request->csrfToken;?>"},
	   success: function(dd){
			   $('#chatbox').append(dd.text);
			   if(dd.text != null){
				   $(".chtbox").animate({
						scrollTop: $('.chtbox > ul').height()
					},"slow");
				}
			   if(dd.last != null){$('.chtbox').attr("id",dd.last);LASTCHAT=dd.last;}
	          }
   });
}
</script>
	<div  class="chatboxmain">
    	<div class="widget-head">
             <h3>Chat</h3>
        </div>
        <div class="chatm">
        <div class="chtbox" style="width:100%;">
			<ul class="cht" id="chatbox">

             </ul>
         </div>
         <div class="sintch">
	<?php $uid = Yii::app()->user->id;
	if($uid){?>
	<form method="post" id="chat_form" onsubmit="return false">
	<input type="text" style="border:1px solid #666666; width:99%;" id="do_chat" placeholder="Please Insert Your Text!" required="true">
	<input type="submit" value="" style="display:none;"/>
	</form>
	<?php }else{?>
	<a href="<?php echo Yii::app()->baseUrl."/login"?>" style="color:#378BEE">Sign in to write.</a>
	<?php }?>

         </div>
        </div>
    </div>
