<div id="announcement" class="ancmnt">
	<div class="widget-head">
        <h3>Announcement</h3>            
    </div>
	<div class="widget-content">
		<div class="ancmntbox announce">
		</div>
	</div>
</div>
<script type="text/javascript">
(function($){
	function word_limitor(str, limit) {
		var final_str = '';

		var str2 = str.replace(/\s+/g, ' ');
		var str3 = str2.split(' ');
		var numberOfWords = str3.length;
		var i=0;
		if(numberOfWords > limit)
		{
			for(i=0; i< limit; i++)
				final_str = final_str + ' ' + str3[i] + ' ';

			return final_str + '...';
		}
		else return str;
	}
	
	var tm = setTimeout(function(){
		$.ajax({
			url: '<?php echo base_url('xrequest/announce');?>',
			type: 'POST',
			dataType: 'json', 
			data: {limit:3},
			beforeSend: function() {
				$('.announce').html('<center><img src="images/loader64.gif" alt="" /></center>');
			},
			success: function(resp) {
				var announce = resp.announce;
				if(announce.length > 0) {
					var ul_html = '<ul class="ancmntlisting">';
					for(i = 0; i < announce.length; i++) {
						if(announce[i].excerpt == null) {
							announce[i].excerpt = announce[i].content.replace(/<\/?[^>]+(>|$)/ig, '');
							announce[i].excerpt = word_limitor(announce[i].excerpt, 20);
						}
						ul_html += '<li><span>'+announce[i].author+'&nbsp;:</span>&nbsp;'+ announce[i].excerpt +'</li>';
					}
					ul_html += '</ul>';
					ul_html += '<a href="<?php echo base_url('announce/archive');?>"><span class="more">&laquo; read more</span></a>'
				}else {
					var ul_html = '<ul class="ancmntlisting"><li><span>There is no any announcement found!</span></li></ul>';
				}
				$('.announce').html(ul_html);
				// Clear interval
				clearInterval(tm);
			}
		})
	}, 500)
})(jQuery);
</script>
