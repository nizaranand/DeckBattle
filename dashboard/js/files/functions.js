$(function() {


	$('.cardhover').tipsy({gravity: 'w', html: true,live:true, fade: true, title:
      function(){
		return cardhovering(this.getAttribute('original-title'));
	}
 });

cardhovering = function(title){
	title = '<img src="http://www.deckbattle.com'+ title +'" />';
	return title;
 }


	//===== collection data table =====//
	oTable = $('.collection').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/dashboard/getcarddatacollection.php?userid="+userid,
		"fnCreatedRow": function( nRow, aData, iDataIndex ) {
		
		$('td:eq(0)', nRow).html('<a class="cardhover" title="/mtgcardscans/'+ aData[5] +'/' + aData[1] +'.full.jpg" href="?cardid='+ aData[0] + '">'+aData[1]+'</a></span>');	
				
		var str=aData[3];
		var n=str.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');


		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');

		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');

		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');

		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');

		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');

		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');

		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');

		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');

		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');

		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');

		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');

		var n=n.replace("{Q}",'<img src="http://www.deckbattle.com/mtgicons/Q.gif" />');

		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');

		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');

		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');

		var n=n.replace("{S}",'<img src="http://www.deckbattle.com/mtgicons/S.gif" />');

		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');

		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');

		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');

		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');

		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');

		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');

		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{0}",'<img src="http://www.deckbattle.com/mtgicons/0.gif" />');
		var n=n.replace("{1}",'<img src="http://www.deckbattle.com/mtgicons/1.gif" />');
		var n=n.replace("{1}",'<img src="http://www.deckbattle.com/mtgicons/1.gif" />');
		var n=n.replace("{2}",'<img src="http://www.deckbattle.com/mtgicons/2.gif" />');
		var n=n.replace("{2}",'<img src="http://www.deckbattle.com/mtgicons/2.gif" />');
		var n=n.replace("{3}",'<img src="http://www.deckbattle.com/mtgicons/3.gif" />');
		var n=n.replace("{3}",'<img src="http://www.deckbattle.com/mtgicons/3.gif" />');
		var n=n.replace("{4}",'<img src="http://www.deckbattle.com/mtgicons/4.gif" />');
		var n=n.replace("{4}",'<img src="http://www.deckbattle.com/mtgicons/4.gif" />');
		var n=n.replace("{5}",'<img src="http://www.deckbattle.com/mtgicons/5.gif" />');
		var n=n.replace("{5}",'<img src="http://www.deckbattle.com/mtgicons/5.gif" />');
		var n=n.replace("{6}",'<img src="http://www.deckbattle.com/mtgicons/6.gif" />');
		var n=n.replace("{6}",'<img src="http://www.deckbattle.com/mtgicons/6.gif" />');
		var n=n.replace("{7}",'<img src="http://www.deckbattle.com/mtgicons/7.gif" />');
		var n=n.replace("{7}",'<img src="http://www.deckbattle.com/mtgicons/7.gif" />');
		var n=n.replace("{8}",'<img src="http://www.deckbattle.com/mtgicons/8.gif" />');
		var n=n.replace("{8}",'<img src="http://www.deckbattle.com/mtgicons/8.gif" />');
		var n=n.replace("{9}",'<img src="http://www.deckbattle.com/mtgicons/9.gif" />');
		var n=n.replace("{9}",'<img src="http://www.deckbattle.com/mtgicons/9.gif" />');
		var n=n.replace("{10}",'<img src="http://www.deckbattle.com/mtgicons/10.gif" />');
		var n=n.replace("{10}",'<img src="http://www.deckbattle.com/mtgicons/10.gif" />');
		var n=n.replace("{11}",'<img src="http://www.deckbattle.com/mtgicons/11.gif" />');
		var n=n.replace("{11}",'<img src="http://www.deckbattle.com/mtgicons/11.gif" />');
		var n=n.replace("{12}",'<img src="http://www.deckbattle.com/mtgicons/12.gif" />');
		var n=n.replace("{12}",'<img src="http://www.deckbattle.com/mtgicons/12.gif" />');
		var n=n.replace("{13}",'<img src="http://www.deckbattle.com/mtgicons/13.gif" />');
		var n=n.replace("{13}",'<img src="http://www.deckbattle.com/mtgicons/13.gif" />');
		var n=n.replace("{14}",'<img src="http://www.deckbattle.com/mtgicons/14.gif" />');
		var n=n.replace("{14}",'<img src="http://www.deckbattle.com/mtgicons/14.gif" />');
		var n=n.replace("{15}",'<img src="http://www.deckbattle.com/mtgicons/15.gif" />');
		var n=n.replace("{15}",'<img src="http://www.deckbattle.com/mtgicons/15.gif" />');
		var n=n.replace("{16}",'<img src="http://www.deckbattle.com/mtgicons/16.gif" />');
		var n=n.replace("{16}",'<img src="http://www.deckbattle.com/mtgicons/16.gif" />');

		$('td:eq(2)', nRow).html(n);	
		
		var str=aData[4];
		var n=str.replace("R",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("// R",'><img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("U",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("// U",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace(">U",'><img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("U<",'<img src="http://www.deckbattle.com/mtgicons/U.gif" /><');
		var n=n.replace("B",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("// B",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace(">B",'><img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("B<",'<img src="http://www.deckbattle.com/mtgicons/B.gif" /><');
		var n=n.replace("W",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("// W",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace(">W",'><img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("W<",'<img src="http://www.deckbattle.com/mtgicons/W.gif" /><');
		var n=n.replace("G",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("//G",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace(">G",'><img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("G<",'<img src="http://www.deckbattle.com/mtgicons/G.gif" /><');
		var n=n.replace("A",'<img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace("//A",'<img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace(">A",'><img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace("A<",'<img src="http://www.deckbattle.com/mtgicons/A.gif" /><');
		var n=n.replace("L",'<img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace("// L",'<img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace(">L",'><img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace("L<",'<img src="http://www.deckbattle.com/mtgicons/L.gif" /><');
		var n=n.replace(">R",'><img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("R<",'<img src="http://www.deckbattle.com/mtgicons/R.gif" /><');
		
		$('td:eq(3)', nRow).html(n);	
        
		
		$('td:eq(4)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif" class="tipS" title="'+aData[6].replace(":","").replace("\"","")+'" />');

		if (aData[7] == 'C')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'U' || aData[7] == 'U // U')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Uncommon.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'R')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'M')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Mythic.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'T')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		
		
		$('td:eq(8)', nRow).html( '<ul class="btn-group toolbar"><li><a href="#" class="tablectrl_small bDefault" data-toggle="dropdown"><span class="iconb" data-icon="&#xe1f7;"></span></a><ul class="dropdown-menu pull-right"><li><a href="#" style="padding-left:12px;"><span class="icos-add"></span>Add to deck</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-heart"></span>Edit amount</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Used in deck...</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to favorites</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to tradelist</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Remove #</a></li></ul></li></ul>');

    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          $('td:eq(2),td:eq(3),td:eq(4),td:eq(5),td:eq(6),td:eq(7),td:eq(8)', nRow).addClass( "centeredtd" );
        },
		"sDom": '<"H"fl>rt<"F"ip>',
		"aoColumns": [ 
			/* Ncardid */   { "bSearchable": false,
			                 "bVisible":    false },
			/* Ncardname */  null,
			/* ntype */ null,
			/* nmanacost */ { "bSearchable": false},
			/* ncolor */    { "bSearchable": false},
			/* Nset */    { "bSearchable": false,
			                 "bVisible":    false },
			/* Nname */    null,
			/* nrarity */    { "bSearchable": false},
			/* nnumber */    null,
			/* nnumberF */    null,
			/* Options */    { "bSearchable": false}
		] 
	});

	oTable = $('.addtocollection').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/dashboard/getcarddataforadd.php",
		"fnCreatedRow": function( nRow, aData, iDataIndex ) {
		
		$('td:eq(0)', nRow).html('<a class="cardhover" title="/mtgcardscans/'+ aData[5] +'/' + aData[1] +'.full.jpg" href="?cardid='+ aData[0] + '">'+aData[1]+'</a></span>');	
				
		var str=aData[3];
		var n=str.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{R}",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{U}",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{B}",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{W}",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("{G}",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');


		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');
		var n=n.replace("{2B}",'<img src="http://www.deckbattle.com/mtgicons/2B.gif" />');

		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		var n=n.replace("{2G}",'<img src="http://www.deckbattle.com/mtgicons/2G.gif" />');
		
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');
		var n=n.replace("{2R}",'<img src="http://www.deckbattle.com/mtgicons/2R.gif" />');

		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');
		var n=n.replace("{2U}",'<img src="http://www.deckbattle.com/mtgicons/2U.gif" />');

		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');
		var n=n.replace("{2W}",'<img src="http://www.deckbattle.com/mtgicons/2W.gif" />');

		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');
		var n=n.replace("{BG}",'<img src="http://www.deckbattle.com/mtgicons/BG.gif" />');

		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');
		var n=n.replace("{BP}",'<img src="http://www.deckbattle.com/mtgicons/BP.gif" />');

		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');
		var n=n.replace("{BR}",'<img src="http://www.deckbattle.com/mtgicons/BR.gif" />');

		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');
		var n=n.replace("{GP}",'<img src="http://www.deckbattle.com/mtgicons/GP.gif" />');

		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');
		var n=n.replace("{GU}",'<img src="http://www.deckbattle.com/mtgicons/GU.gif" />');

		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');
		var n=n.replace("{GW}",'<img src="http://www.deckbattle.com/mtgicons/GW.gif" />');

		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');
		var n=n.replace("{P}",'<img src="http://www.deckbattle.com/mtgicons/P.gif" />');

		var n=n.replace("{Q}",'<img src="http://www.deckbattle.com/mtgicons/Q.gif" />');

		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');
		var n=n.replace("{RG}",'<img src="http://www.deckbattle.com/mtgicons/RG.gif" />');

		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');
		var n=n.replace("{RP}",'<img src="http://www.deckbattle.com/mtgicons/RP.gif" />');

		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');
		var n=n.replace("{RW}",'<img src="http://www.deckbattle.com/mtgicons/RW.gif" />');

		var n=n.replace("{S}",'<img src="http://www.deckbattle.com/mtgicons/S.gif" />');

		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');
		var n=n.replace("{UB}",'<img src="http://www.deckbattle.com/mtgicons/UB.gif" />');

		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');
		var n=n.replace("{UP}",'<img src="http://www.deckbattle.com/mtgicons/UP.gif" />');

		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');
		var n=n.replace("{UR}",'<img src="http://www.deckbattle.com/mtgicons/UR.gif" />');

		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');
		var n=n.replace("{WB}",'<img src="http://www.deckbattle.com/mtgicons/WB.gif" />');

		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');
		var n=n.replace("{WP}",'<img src="http://www.deckbattle.com/mtgicons/WP.gif" />');

		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');
		var n=n.replace("{WU}",'<img src="http://www.deckbattle.com/mtgicons/WU.gif" />');

		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{X}",'<img src="http://www.deckbattle.com/mtgicons/X.gif" />');
		var n=n.replace("{0}",'<img src="http://www.deckbattle.com/mtgicons/0.gif" />');
		var n=n.replace("{1}",'<img src="http://www.deckbattle.com/mtgicons/1.gif" />');
		var n=n.replace("{1}",'<img src="http://www.deckbattle.com/mtgicons/1.gif" />');
		var n=n.replace("{2}",'<img src="http://www.deckbattle.com/mtgicons/2.gif" />');
		var n=n.replace("{2}",'<img src="http://www.deckbattle.com/mtgicons/2.gif" />');
		var n=n.replace("{3}",'<img src="http://www.deckbattle.com/mtgicons/3.gif" />');
		var n=n.replace("{3}",'<img src="http://www.deckbattle.com/mtgicons/3.gif" />');
		var n=n.replace("{4}",'<img src="http://www.deckbattle.com/mtgicons/4.gif" />');
		var n=n.replace("{4}",'<img src="http://www.deckbattle.com/mtgicons/4.gif" />');
		var n=n.replace("{5}",'<img src="http://www.deckbattle.com/mtgicons/5.gif" />');
		var n=n.replace("{5}",'<img src="http://www.deckbattle.com/mtgicons/5.gif" />');
		var n=n.replace("{6}",'<img src="http://www.deckbattle.com/mtgicons/6.gif" />');
		var n=n.replace("{6}",'<img src="http://www.deckbattle.com/mtgicons/6.gif" />');
		var n=n.replace("{7}",'<img src="http://www.deckbattle.com/mtgicons/7.gif" />');
		var n=n.replace("{7}",'<img src="http://www.deckbattle.com/mtgicons/7.gif" />');
		var n=n.replace("{8}",'<img src="http://www.deckbattle.com/mtgicons/8.gif" />');
		var n=n.replace("{8}",'<img src="http://www.deckbattle.com/mtgicons/8.gif" />');
		var n=n.replace("{9}",'<img src="http://www.deckbattle.com/mtgicons/9.gif" />');
		var n=n.replace("{9}",'<img src="http://www.deckbattle.com/mtgicons/9.gif" />');
		var n=n.replace("{10}",'<img src="http://www.deckbattle.com/mtgicons/10.gif" />');
		var n=n.replace("{10}",'<img src="http://www.deckbattle.com/mtgicons/10.gif" />');
		var n=n.replace("{11}",'<img src="http://www.deckbattle.com/mtgicons/11.gif" />');
		var n=n.replace("{11}",'<img src="http://www.deckbattle.com/mtgicons/11.gif" />');
		var n=n.replace("{12}",'<img src="http://www.deckbattle.com/mtgicons/12.gif" />');
		var n=n.replace("{12}",'<img src="http://www.deckbattle.com/mtgicons/12.gif" />');
		var n=n.replace("{13}",'<img src="http://www.deckbattle.com/mtgicons/13.gif" />');
		var n=n.replace("{13}",'<img src="http://www.deckbattle.com/mtgicons/13.gif" />');
		var n=n.replace("{14}",'<img src="http://www.deckbattle.com/mtgicons/14.gif" />');
		var n=n.replace("{14}",'<img src="http://www.deckbattle.com/mtgicons/14.gif" />');
		var n=n.replace("{15}",'<img src="http://www.deckbattle.com/mtgicons/15.gif" />');
		var n=n.replace("{15}",'<img src="http://www.deckbattle.com/mtgicons/15.gif" />');
		var n=n.replace("{16}",'<img src="http://www.deckbattle.com/mtgicons/16.gif" />');
		var n=n.replace("{16}",'<img src="http://www.deckbattle.com/mtgicons/16.gif" />');

		$('td:eq(2)', nRow).html(n);	
		
		var str=aData[4];
		var n=str.replace("R",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("// R",'><img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("U",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("// U",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace(">U",'><img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("U<",'<img src="http://www.deckbattle.com/mtgicons/U.gif" /><');
		var n=n.replace("B",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("// B",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace(">B",'><img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("B<",'<img src="http://www.deckbattle.com/mtgicons/B.gif" /><');
		var n=n.replace("W",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("// W",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace(">W",'><img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("W<",'<img src="http://www.deckbattle.com/mtgicons/W.gif" /><');
		var n=n.replace("G",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("//G",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace(">G",'><img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("G<",'<img src="http://www.deckbattle.com/mtgicons/G.gif" /><');
		var n=n.replace("A",'<img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace("//A",'<img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace(">A",'><img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace("A<",'<img src="http://www.deckbattle.com/mtgicons/A.gif" /><');
		var n=n.replace("L",'<img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace("// L",'<img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace(">L",'><img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		var n=n.replace("L<",'<img src="http://www.deckbattle.com/mtgicons/L.gif" /><');
		var n=n.replace(">R",'><img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("R<",'<img src="http://www.deckbattle.com/mtgicons/R.gif" /><');
		
		$('td:eq(3)', nRow).html(n);	
        
		
		$('td:eq(4)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif" class="tipS" title="'+aData[6].replace(":","").replace("\"","")+'" />');

		if (aData[7] == 'C')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'U' || aData[7] == 'U // U')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Uncommon.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'R')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'M')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Mythic.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		if (aData[7] == 'T')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif"  alt="'+aData[6].replace(":","").replace("\"","")+'" />');
		
		
		$('td:eq(6)', nRow).html('<div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',1,0,0,0,0)"><span class="iconb tipS" title="Add one" data-icon="&#xe14a;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,1,0,0,0)"><span class="iconb tipS" title="Add one Foil" data-icon="&#xe14b;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,1,0,0)"><span class="iconb tipS" title="Add to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,0,1,0)"><span class="iconb tipS" title="Add Foil to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,0,0,1)"><span class="iconb tipS" title="Add to Favorites" data-icon="&#xe144;"></span></a></div><br /><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',-1,0,0,0,0)"><span class="iconb tipS" title="Add one" data-icon="&#xe14a;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,-1,0,0,0)"><span class="iconb tipS" title="Add one Foil" data-icon="&#xe14b;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,-1,0,0)"><span class="iconb tipS" title="Add to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,0,-1,0)"><span class="iconb tipS" title="Remove Foil from Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection('+ aData[0] +',\''+ aData[1] +'\',0,0,0,0,-1)"><span class="iconb tipS" title="Add to Favorites" data-icon="&#xe144;"></span></a></div><div id="'+aData[0]+'"></div>');

    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          $('td:eq(2),td:eq(3),td:eq(4),td:eq(5)', nRow).addClass( "centeredtd" );
		  $('td:eq(6)',nRow).addClass("tableActs");
		 		  
        },
		"sDom": '<"H"fl>rt<"F"ip>',
		"aoColumns": [ 
			/* Ncardid */   { "bSearchable": false,
			                 "bVisible":    false },
			/* Ncardname */  null,
			/* ntype */ null,
			/* nmanacost */ { "bSearchable": false},
			/* ncolor */    { "bSearchable": false},
			/* Nset */    { "bSearchable": false,
			                 "bVisible":    false },
			/* Nname */    null,
			/* nrarity */    { "bSearchable": false},
			/* Options */    { "bSearchable": false}
			
		] 
	});




	$('#usernameLoading').hide();
	
	$('#username').keyup(function(){
	  $('#usernameLoading').show();
      $.post("usernamecheck.php", {
        username: $('#username').val(),
		session_username: $('#session_username').val()
      }, function(response){
        $('#usernameResult').fadeOut();
        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
      });
	
    	return false;
	});



	
	if (rec)
	{
		$.jGrowl("You have recovered your password but didn't changed it yet!<br /><br />Please change your password at the<br /><a href='profile.php' style='color:#68A341;'>'My Profile' page</a>.", { sticky: true });

	}
	
	//===== File manager =====//	
	
	$().ready(function() {
		var elf = $('#fileManager').elfinder({
			// lang: 'ru',             // language (OPTIONAL)
			url : 'php/connector.php'  // connector URL (REQUIRED)
		}).elfinder('instance');			
	});	
	
	
	//===== ShowCode plugin for <pre> tag =====//

	$('.code').sourcerer('js html css php'); // Display all languages
	
	
	//===== Left navigation styling =====//
	
	$('.subNav li a.this').parent('li').addClass('activeli');


	//===== Login pic hover animation =====//
	
	$(".loginPic").hover(
		function() { 
		
		$('.logleft, .logback').animate({left:10, opacity:1},200); 
		$('.logright').animate({right:10, opacity:1},200); },
		
		function() { 
		$('.logleft, .logback').animate({left:0, opacity:0},200);
		$('.logright').animate({right:0, opacity:0},200); }
	);
	
	
	//===== Image gallery control buttons =====//
	
	$(".gallery ul li").hover(
		function() { $(this).children(".actions").show("fade", 200); },
		function() { $(this).children(".actions").hide("fade", 200); }
	);
	
	
	//===== Autocomplete =====//
	
	var availableTags = [ "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme" ];
	$( ".ac" ).autocomplete({
	source: availableTags
	});	


	//===== jQuery file tree =====//
	
	$('.filetree').fileTree({
        root: '../images/',
        script: 'php/jqueryFileTree.php',
        expandSpeed: 200,
        collapseSpeed: 200,
        multiFolder: true
    }, function(file) {
        alert(file);
    });
	
	
	//===== Sortable columns =====//
	
	$("table").tablesorter();
	
	
	//===== Resizable columns =====//
	
	$("#resize, #resize2").colResizable({
		liveDrag:true,
		draggingClass:"dragging" 
	});
	
	
	//===== Bootstrap functions =====//
	
	// Loading button
    $('#loading').click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      });
	
	// Dropdown
	$('.dropdown-toggle').dropdown();
	
	
	//===== Animated progress bars (ID dependency) =====//
	
	var percent = $('#bar1').attr('title');
	$('#bar1').animate({width: percent},1000);
	
	var percent = $('#bar2').attr('title');
	$('#bar2').animate({width: percent},1000);

	var percent = $('#bar3').attr('title');
	$('#bar3').animate({width: percent},1000);

	var percent = $('#bar4').attr('title');
	$('#bar4').animate({width: percent},1000);

	var percent = $('#bar5').attr('title');
	$('#bar5').animate({width: percent},1000);

	var percent = $('#bar6').attr('title');
	$('#bar6').animate({width: percent},1000);
	
	var percent = $('#bar7').attr('title');
	$('#bar7').animate({width: percent},1000);
	
	var percent = $('#bar8').attr('title');
	$('#bar8').animate({width: percent},1000);
	
	var percent = $('#bar9').attr('title');
	$('#bar9').animate({width: percent},1000);

	var percent = $('#bar10').attr('title');
	$('#bar10').animate({width: percent},1000);


	//===== Fancybox =====//
	
	$(".lightbox").fancybox({
	'padding': 2
	});
	
	
	//===== Color picker =====//
	
	$('#cPicker').ColorPicker({
		color: '#e62e90',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#cPicker div').css('backgroundColor', '#' + hex);
		}
	});
	
	$('#flatPicker').ColorPicker({flat: true});


	//===== Time picker =====//
	
	$('.timepicker').timeEntry({
		show24Hours: true, // 24 hours format
		showSeconds: true, // Show seconds?
		spinnerImage: 'images/elements/ui/spinner.png', // Arrows image
		spinnerSize: [19, 26, 0], // Image size
		spinnerIncDecOnly: true // Only up and down arrows
	});
	

	//===== Usual validation engine=====//

	$("#usualValidate").validate({
		rules: {
			firstname: "required",
			minChars: {
				required: true,
				minlength: 3
			},
			maxChars: {
				required: true,
				maxlength: 6
			},
			mini: {
				required: true,
				min: 3
			},
			maxi: {
				required: true,
				max: 6
			},
			range: {
				required: true,
				range: [6, 16]
			},
			emailField: {
				required: true,
				email: true
			},
			urlField: {
				required: true,
				url: true
			},
			dateField: {
				required: true,
				date: true
			},
			digitsOnly: {
				required: true,
				digits: true
			},
			enterPass: {
				required: true,
				minlength: 5
			},
			repeatPass: {
				required: true,
				minlength: 5,
				equalTo: "#enterPass"
			},
			customMessage: "required",
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			customMessage: {
				required: "Bazinga! This message is editable",
			},
			agree: "Please accept our policy"
		}
	});
	
	
	//===== Validation engine =====//
	
	$("#validate").validationEngine();
$("#login").validationEngine();
$("#recover").validationEngine();

	
	//===== iButtons =====//
	
	$('.on_off :checkbox, .on_off :radio').iButton({
		labelOn: "",
		labelOff: "",
		enableDrag: false 
	});
	
	$('.yes_no :checkbox, .yes_no :radio').iButton({
		labelOn: "On",
		labelOff: "Off",
		enableDrag: false
	});
	
	$('.enabled_disabled :checkbox, .enabled_disabled :radio').iButton({
		labelOn: "Enabled",
		labelOff: "Disabled",
		enableDrag: false
	});
	
	
	
	//===== Notification boxes =====//
	
	$(".nNote").click(function() {
		$(this).fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(200, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});	
	
	
	//===== Animate current li when closing button clicked =====//
	
	$(".remove").click(function() {
		$(this).parent('li').fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(200, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});	
	
	
	
	//===== Check all checbboxes =====//
	
	$(".titleIcon input:checkbox").click(function() {
		var checkedStatus = this.checked;
		$("#checkAll tbody tr td:first-child input:checkbox").each(function() {
			this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
					$(this).closest('table tbody tr').removeClass('thisRow');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
					$(this).closest('table tbody tr').addClass('thisRow');
				}
		});
	});	
	
	$(function() {
    $('#checkAll tbody tr td:first-child input[type=checkbox]').change(function() {
        $(this).closest('tr').toggleClass("thisRow", this.checked);
		});
	});


	//===== File uploader =====//
	
	$("#uploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : 'php/upload.php',
		max_file_size : '100kb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	});
	
	
	//===== Wizards =====//
	
	$("#wizard1").formwizard({
		formPluginEnabled: true, 
		validationEnabled: false,
		focusFirstInput : false,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status1").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#w1").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			resetForm: true
		}
	});
	
	$("#wizard2").formwizard({ 
		formPluginEnabled: true,
		validationEnabled: true,
		focusFirstInput : false,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status2").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#w2").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			dataType: 'json',
			resetForm: true
		},
		validationOptions : {
			rules: {
				bazinga: "required",
				email: { required: true, email: true }
			},
			messages: {
				bazinga: "Bazinga. This note is editable",
				email: { required: "Please specify your email", email: "Correct format is name@domain.com" }
			}
		}
	});
	
	$("#wizard3").formwizard({
		formPluginEnabled: false, 
		validationEnabled: false,
		focusFirstInput : false,
		disableUIStyles : true
	});
	
	
	
	//===== WYSIWYG editor =====//
	
	$("#editor").cleditor({
		width:"100%", 
		height:"250px",
		bodyStyle: "margin: 10px; font: 12px Arial,Verdana; cursor:text",
		useCSS:true
	});
	
	
	//===== Dual select boxes =====//
	
	$.configureBoxes();


	//===== Chosen plugin =====//
		
	$(".select").chosen(); 
	
	
	//===== Autotabs. Inline data rows =====//

	$('.onlyNums input').autotab_magic().autotab_filter('numeric');
	$('.onlyText input').autotab_magic().autotab_filter('text');
	$('.onlyAlpha input').autotab_magic().autotab_filter('alpha');
	$('.onlyRegex input').autotab_magic().autotab_filter({ format: 'custom', pattern: '[^0-9\.]' });
	$('.allUpper input').autotab_magic().autotab_filter({ format: 'alphanumeric', uppercase: true });
	
	
	//===== Masked input =====//
	
	$.mask.definitions['~'] = "[+-]";
	$(".maskDate").mask("99/99/9999",{completed:function(){alert("Callback when completed");}});
	$(".maskPhone").mask("(999) 999-9999");
	$(".maskPhoneExt").mask("(999) 999-9999? x99999");
	$(".maskIntPhone").mask("+33 999 999 999");
	$(".maskTin").mask("99-9999999");
	$(".maskSsn").mask("999-99-9999");
	$(".maskProd").mask("a*-999-a999", { placeholder: " " });
	$(".maskEye").mask("~9.99 ~9.99 999");
	$(".maskPo").mask("PO: aaa-999-***");
	$(".maskPct").mask("99%");
	
	
	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	
	
	//===== Input limiter =====//
	
	$('.lim').inputlimiter({
		limit: 100,
		boxId: 'limitingtext',
		boxAttach: false
	});
	
	
	//===== Placeholder =====//
	
	$('input[placeholder], textarea[placeholder]').placeholder();
	
	
	//===== Autogrowing textarea =====//
	
	$('.auto').elastic();
	$('.auto').trigger('update');


	//===== Full width sidebar dropdown =====//
	
	$('.fulldd li').click(function () {
		$(this).children("ul").slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("has"))
		$('.fulldd li').children("ul").slideUp(150);
	});
	
	
	//===== Top panel search field =====//
	
	$('.userNav a.search').click(function () {
		$('.topSearch').fadeToggle(150);
	});
	
	
	//===== 2 responsive buttons (320px - 480px) =====//
	
	$('.iTop').click(function () {
		$('#sidebar').slideToggle(100);
	});
	
	$('.iButton').click(function () {
		$('.altMenu').slideToggle(100);
	});

	
	//===== Animated dropdown for the right links group on breadcrumbs line =====//
	
	$('.breadLinks ul li').click(function () {
		$(this).children("ul").slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("has"))
		$('.breadLinks ul li').children("ul").slideUp(150);
	});
	
	
	//===== Easy tabs =====//
	
	$('#tab-container').easytabs({
		animationSpeed: 300,
		collapsible: false,
		tabActiveClass: "clicked"
	});
		
	
	//===== Tabs =====//
		
	$.fn.contentTabs = function(){ 
	
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	
		$("ul.tabs li").click(function() {
			$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			return false;
		});
	
	};
	$("div[class^='widget']").contentTabs(); //Run function on any div with class name of "Content Tabs"


	//===== Dynamic data table =====//
	
	oTable = $('.dTable').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>'
	});
	

	//===== Dynamic table toolbars =====//		
	
	$('#dyn .tOptions').click(function () {
		$('#dyn .tablePars').slideToggle(200);
	});	
	
	$('#dyn2 .tOptions').click(function () {
		$('#dyn2 .tablePars').slideToggle(200);
	});	
	
	
	$('.tOptions').click(function () {
		$(this).toggleClass("act");
	});
	

	//== Adding class to :last-child elements ==//
		
	$(".subNav li:last-child a, .formRow:last-child, .userList li:last-child, table tbody tr:last-child td, .breadLinks ul li ul li:last-child, .fulldd li ul li:last-child, .niceList li:last-child").addClass("noBorderB")

	
	//===== Add classes for sub sidebar detection =====//
	
	if ($('div').hasClass('secNav')) {
		$('#sidebar').addClass('with');
		//$('#content').addClass('withSide');
	}
	else {
		$('#sidebar').addClass('without');
		$('#content').css('margin-left','100px');//.addClass('withoutSide');
		$('#footer > .wrapper').addClass('fullOne');
		};


	//===== Collapsible elements management =====//
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'subOpened',
		cssClose: 'subClosed',
		speed: 200
	});

	$('.opened').collapsible({
		defaultOpen: 'opened,toggleOpened',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	$('.closed').collapsible({
		defaultOpen: '',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	
	//===== Accordion =====//		
	
	$('div.menu_body:eq(0)').show();
	$('.acc .whead:eq(0)').show().css({color:"#2B6893"});
	
	$(".acc .whead").click(function() {	
		$(this).css({color:"#2B6893"}).next("div.menu_body").slideToggle(200).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({color:"#404040"});
	});



	//===== Breadcrumbs =====//
	
	$('#breadcrumbs').xBreadcrumbs();
	
	
		//===== Sparklines =====//
	
	$('.balBars').sparkline(
	'html', {type: 'bar', barColor: '#db6464', height: '18px'}
	 );
	 

	//===== User nav dropdown =====//		
	
	$('a.leftUserDrop').click(function () {
		$('.leftUser').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("leftUserDrop"))
		$(".leftUser").slideUp(200);
	});
	
	
	//===== Tooltips =====//

	$('.tipN').tipsy({gravity: 'n',fade: true, html:true});
	$('.tipS').tipsy({gravity: 's',fade: true, html:true});
	$('.tipW').tipsy({gravity: 'w',fade: true, html:true});
	$('.tipE').tipsy({gravity: 'e',fade: true, html:true});
	
	
	//===== Calendar =====//
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2)
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/'
			}
		]
	});



	//===== Spinner options =====//
	
	var itemList = [
		{url: "http://ejohn.org", title: "John Resig"},
		{url: "http://bassistance.de/", title: "J&ouml;rn Zaefferer"},
		{url: "http://snook.ca/jonathan/", title: "Jonathan Snook"},
		{url: "http://rdworth.org/", title: "Richard Worth"},
		{url: "http://www.paulbakaus.com/", title: "Paul Bakaus"},
		{url: "http://www.yehudakatz.com/", title: "Yehuda Katz"},
		{url: "http://www.azarask.in/", title: "Aza Raskin"},
		{url: "http://www.karlswedberg.com/", title: "Karl Swedberg"},
		{url: "http://scottjehl.com/", title: "Scott Jehl"},
		{url: "http://jdsharp.us/", title: "Jonathan Sharp"},
		{url: "http://www.kevinhoyt.org/", title: "Kevin Hoyt"},
		{url: "http://www.codylindley.com/", title: "Cody Lindley"},
		{url: "http://malsup.com/jquery/", title: "Mike Alsup"}
	];

	var opts = {
		's1': {decimals:2},
		's2': {stepping: 0.25},
		's3': {currency: '$'},
		's4': {},
		's5': {
			//
			// Two methods of adding external items to the spinner
			//
			// method 1: on initalisation call the add method directly and format html manually
			init: function(e, ui) {
				for (var i=0; i<itemList.length; i++) {
					ui.add('<a href="'+ itemList[i].url +'" target="_blank">'+ itemList[i].title +'</a>');
				}
			},

			// method 2: use the format and items options in combination
			format: '<a href="%(url)" target="_blank">%(title)</a>',
			items: itemList
		}
	};

	for (var n in opts)
		$("#"+n).spinner(opts[n]);

	$("button").click(function(e){
		var ns = $(this).attr('id').match(/(s\d)\-(\w+)$/);
		if (ns != null)
			$('#'+ns[1]).spinner( (ns[2] == 'create') ? opts[ns[1]] : ns[2]);
	});
	


	//===== jQuery UI dialog =====//
	
    $('#dialog').dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Gotcha": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
	
    // Dialog Link
    $('#dialog_open').click(function () {
        $('#dialog').dialog('open');
        return false;
    });
	
	// Dialog
    $('#formDialog').dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Nice stuff": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
	
	// Dialog
    $('#formDialogPassRecovery').dialog({
        autoOpen: false,
        width: 300,
      /*  buttons: {
            "Request new password": function () {
			
                $(this).dialog("close");
					$("passwordrecoveryform").submit();
					
					
				
					
					
            },
            "Cancel": function () {
                $(this).dialog("close");
            }*/
        //}
    });
	
    // Dialog Link
    $('#formDialogPassRecovery_open').click(function () {
        $('#formDialogPassRecovery').dialog('open');
        return false;
    });
	
	// Dialog Link
    $('#formDialog_open').click(function () {
        $('#formDialog').dialog('open');
        return false;
    });
	
	
	// Dialog
    $('#customDialog').dialog({
        autoOpen: false,
        width: 650,
        buttons: {
            "Very cool!": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
	
    // Dialog Link
    $('#customDialog_open').click(function () {
        $('#customDialog').dialog('open');
        return false;
    });

	
	
	//===== Vertical sliders =====//
	
	$( "#eq > span" ).each(function() {
		// read initial values from markup and remove that
		var value = parseInt( $( this ).text(), 10 );
		$( this ).empty().slider({
			value: value,
			range: "min",
			animate: true,
			orientation: "vertical"
		});
	});
	
	
	//===== Modal =====//
	
    $('#dialog-modal').dialog({
		autoOpen: false, 
		width: 400,
		modal: true,
		buttons: {
				"Yep!": function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
    $('#modal_open').click(function () {
        $('#dialog-modal').dialog('open');
        return false;
    });
	
	
	//===== jQuery UI stuff =====//
	
	// default mode
	$('#progress1').anim_progressbar();
	
	// from second #5 till 15
	var iNow = new Date().setTime(new Date().getTime() + 5 * 1000); // now plus 5 secs
	var iEnd = new Date().setTime(new Date().getTime() + 15 * 1000); // now plus 15 secs
	$('#progress2').anim_progressbar({start: iNow, finish: iEnd, interval: 1});
	
	// Progressbar
    $("#progress").progressbar({
        value: 80
    });
	
    // Modal Link
    $('#modal_link').click(function () {
        $('#dialog-message').dialog('open');
        return false;
    });
	
	// Datepicker
    $('.inlinedate').datepicker({
        inline: true,
		showOtherMonths:true
    });
	
	$( ".datepicker" ).datepicker({ 
		defaultDate: +7,
		showOtherMonths:true,
		autoSize: true,
		appendText: '(dd-mm-yyyy)',
		dateFormat: 'dd-mm-yy'
	});	
	
	$(function() {
			var dates = $( "#fromDate, #toDate" ).datepicker({
				defaultDate: "+1w",
				changeMonth: false,
				showOtherMonths:true,
				numberOfMonths: 3,
				onSelect: function( selectedDate ) {
					var option = this.id == "fromDate" ? "minDate" : "maxDate",
						instance = $( this ).data( "datepicker" ),
						date = $.datepicker.parseDate(
							instance.settings.dateFormat ||
							$.datepicker._defaults.dateFormat,
							selectedDate, instance.settings );
					dates.not( this ).datepicker( "option", option, date );
				}
			});
		});
	
	
	$( ".uSlider" ).slider(); /* Usual slider */
	
	
	$( ".uRange" ).slider({ /* Range slider */
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#rangeAmount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	$( "#rangeAmount" ).val( "$" + $( ".uRange" ).slider( "values", 0 ) +" - $" + $( ".uRange" ).slider( "values", 1 ));
	

	$( ".uMin" ).slider({ /* Slider with minimum */
		range: "min",
		value: 37,
		min: 1,
		max: 700,
		slide: function( event, ui ) {
			$( "#minRangeAmount" ).val( "$" + ui.value );
		}
	});
	$( "#minRangeAmount" ).val( "$" + $( ".uMin" ).slider( "value" ) );


	$( ".uMax" ).slider({ /* Slider with maximum */
		range: "max",
		min: 1,
		max: 100,
		value: 20,
		slide: function( event, ui ) {
			$( "#maxRangeAmount" ).val( ui.value );
		}
	});
	$( "#maxRangeAmount" ).val( $( ".uMax" ).slider( "value" ) );	




	//===== Add class on #content resize. Needed for responsive grid =====//
	
	$('#content').resize(function () {
	  var width = $(this).width();
		if (width < 769) {
			$(this).addClass('under');
		}
		else { $(this).removeClass('under') }
	}).resize(); // Run resize on window load
	
	
	//===== Button for showing up sidebar on iPad portrait mode. Appears on right top =====//
				
	$("ul.userNav li a.sidebar").click(function() { 
		$(".secNav").toggleClass('display');
	});


	//===== Form elements styling =====//
	
	$("select, .check, .check :checkbox, input:radio, input:file").uniform();

	
});

	
