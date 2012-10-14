<?php
/*
Template Name: Mtg Card Database
*/
?>
<?php get_header(); ?>
<script type="text/javascript">

jQuery.noConflict()(function($){
$(document).ready(function ()
{
	
	//===== Sortable columns =====//
	
	$("table").tablesorter();
	
	
	//===== Resizable columns =====//
	
	$("#resize, #resize2").colResizable({
		liveDrag:true,
		draggingClass:"dragging" 
	});

	//===== tipsy columns =====//
$('.cardhover').tipsy({gravity: 'w', html: true,live:true, fade: true, title:
      function(){
		return cardhovering(this.getAttribute('original-title'));
	}
 });

cardhovering = function(title){
	title = '<img src="http://www.deckbattle.com'+ title +'" />';
	return title;
 }
 
 
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
 
 //===== table setup =====//

	oTable = $('.dTable').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/dashboard/getcarddata.php",
		"aoColumns": [ 
			/* Ncardid */   { 	"bSearchable": false,
			                 	"bVisible":    false },
			/* Ncardname */ null,
			/* ntype */ 	null,
			/* nmanacost */ null,
			/* ncolor */    null,
			/* Nset */    	{ 	"bSearchable": false,
			                 	"bVisible":    false },
			/* Nname */    	null,
			/* nrarity */   null,
			/* nnumber */   null,
			/* Options */   null
		],
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
		var n=n.replace("{2}",'<img src="http://www.deckbattle.com/mtgicons/2.gif" />');
		var n=n.replace("{3}",'<img src="http://www.deckbattle.com/mtgicons/3.gif" />');
		var n=n.replace("{4}",'<img src="http://www.deckbattle.com/mtgicons/4.gif" />');
		var n=n.replace("{5}",'<img src="http://www.deckbattle.com/mtgicons/5.gif" />');
		var n=n.replace("{6}",'<img src="http://www.deckbattle.com/mtgicons/6.gif" />');
		var n=n.replace("{7}",'<img src="http://www.deckbattle.com/mtgicons/7.gif" />');
		var n=n.replace("{8}",'<img src="http://www.deckbattle.com/mtgicons/8.gif" />');
		var n=n.replace("{9}",'<img src="http://www.deckbattle.com/mtgicons/9.gif" />');
		var n=n.replace("{10}",'<img src="http://www.deckbattle.com/mtgicons/10.gif" />');
		var n=n.replace("{11}",'<img src="http://www.deckbattle.com/mtgicons/11.gif" />');
		var n=n.replace("{12}",'<img src="http://www.deckbattle.com/mtgicons/12.gif" />');
		var n=n.replace("{13}",'<img src="http://www.deckbattle.com/mtgicons/13.gif" />');
		var n=n.replace("{14}",'<img src="http://www.deckbattle.com/mtgicons/14.gif" />');
		var n=n.replace("{15}",'<img src="http://www.deckbattle.com/mtgicons/15.gif" />');
		var n=n.replace("{16}",'<img src="http://www.deckbattle.com/mtgicons/16.gif" />');

		$('td:eq(2)', nRow).html(n);	
        		
		var str=aData[4];
		var n=str.replace("R",'<img src="http://www.deckbattle.com/mtgicons/R.gif" />');
		var n=n.replace("U",'<img src="http://www.deckbattle.com/mtgicons/U.gif" />');
		var n=n.replace("B",'<img src="http://www.deckbattle.com/mtgicons/B.gif" />');
		var n=n.replace("W",'<img src="http://www.deckbattle.com/mtgicons/W.gif" />');
		var n=n.replace("G",'<img src="http://www.deckbattle.com/mtgicons/G.gif" />');
		var n=n.replace("A",'<img src="http://www.deckbattle.com/mtgicons/A.gif" />');
		var n=n.replace("L",'<img src="http://www.deckbattle.com/mtgicons/L.gif" />');
		
		$('td:eq(3)', nRow).html(n);	
        		
		$('td:eq(4)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif" />');

		if (aData[7] == 'C')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Common.gif" />');
		if (aData[7] == 'U' || aData[7] == 'U // U')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Uncommon.gif" />');
		if (aData[7] == 'R')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif" />');
		if (aData[7] == 'M')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Mythic.gif" />');
		if (aData[7] == 'T')
		$('td:eq(5)', nRow).html( '<img src="http://www.deckbattle.com/mtgicons/'+aData[6].replace(":","").replace("\"","")+'_Rare.gif" />');
		
		
		$('td:eq(7)', nRow).html( '<ul class="btn-group toolbar"><li><a href="#" class="tablectrl_small bDefault" data-toggle="dropdown"><span class="iconb" data-icon="&#xe1f7;"></span></a><ul class="dropdown-menu pull-right"><li><a href="#"><span class="icos-add"></span>Add to compare card</a></li><li><a href="#" class=""><span class="icos-heart"></span>Share card</a></li><li><a href="#" class=""><span class="icos-pencil"></span>Login for more options...</a></li></ul></li></ul>');
    },
		 		"sDom": '<"H"fl>rt<"F"ip>'

	});
			
});
});
</script>
<style>
.btn-group:before, .btn-group:after {
	content: "";
	display: none;
}


</style>

<div class="container inner_content">
  <div class="row"> 
    <!--Page content-->
    <div class="span8"> 
      
      <!-- Table with opened toolbar -->
      <div class="widget">
        <div class="whead">
          <h6>Magic the Gathering Card Database</h6>
          <div class="clear"></div>
        </div>
        <div class="shownpars" > 
          <table cellpadding="0" cellspacing="0" border="0" class="dTable">
            <thead>
              <tr>
                <th>ID</th>
                <th style="width:220px;">Name</th>
                <th style="width:230px;">Type</th>
                <th style="width:100px;">Cost</th>
                <th style="width:80px;">Color</th>
                <th style="width:30px;">EditionAbbreviation</th>
                <th style="width:30px;">Edition</th>
                <th style="width:30px;">Rarity</th>
                <th style="width:30px;">#</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      </section>
    </div>
    <!--/Page content--> 
    
  </div>
</div>
<?php get_footer(); ?>
