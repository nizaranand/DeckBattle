$(function() {


oTable = $('.addtocollection').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/dashboard/services/getcards_foradd.php",
		"fnCreatedRow": function( nRow, aData, iDataIndex ) {
		
		$('td:eq(0)', nRow).html('<a class="cardhover" title="/mtgcardscans/'+ aData[5] +'/' + aData[1] +'.full.jpg" href="?cardid='+ aData[0] + '">'+aData[1]+'</a></span>');	
		$('td:eq(2)', nRow).html(replaceCostIcons(aData[3]));	
		$('td:eq(3)', nRow).html(replaceColorIcons(aData[4]));	

        
		
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
});