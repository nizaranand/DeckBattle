$(function() {

	//===== Tooltips =====//

	$('.tipN').tipsy({gravity: 'n',fade: true, html:true});
	$('.tipS').tipsy({gravity: 's',fade: true, html:true});
	$('.tipW').tipsy({gravity: 'w',fade: true, html:true});
	$('.tipE').tipsy({gravity: 'e',fade: true, html:true});


$('.cardhover').tipsy({gravity: 'w', html: true,live:true, fade: true, title:
      function(){
		return cardhovering(this.getAttribute('original-title'));
	}
 });

cardhovering = function(title){
	title = '<img src="http://www.deckbattle.com'+ title +'" />';
	return title;
 }

});