$(function() {

	oTable = $('.addtocollection').dataTable({
		"bJQueryUI" : false,
		"bAutoWidth" : false,
		"sPaginationType" : "full_numbers",
		"bProcessing" : true,
		"bServerSide" : true,
		"sAjaxSource" : "/dashboard/services/getcards_foradd.php?userid="+ userid,
		"aaSorting": [[ 2, "asc" ]],
		"aoColumns" : [
		/* Ncardid  - Add normal*/
		{
			"bSearchable" : false,
			"bSortable":false,
		},
		/* Ncardid  - Add foil*/
		{
			"bSearchable" : false,
			"bSortable":false,
		},
		/* Ncardname */null,
		/* ntype */null,
		/* nmanacost */
		{
			"bSearchable" : false
		},
		/* ncolor */
		{
			"bSearchable" : false
		},
		/* Nname */null,
		/* nrarity */
		{
			"bSearchable" : false
		},
		/* fav */
		{
			"bSearchable" : false,
			"bSortable":false,
		}],
		"fnCreatedRow" : function(nRow, aData, iDataIndex) {

		$('td:eq(0)', nRow).html('<div id="normal_' + aData[0] + '" style="display: inline;margin-right:5px;font-weight:bold;">'+aData[10] +'</div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',1,0,0,0,0)"><span class="iconb tipS" title="Add one Normal" data-icon="&#xe099;"></span></a><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',-1,0,0,0,0)"><span class="iconb tipS" title="Remove one Normal" data-icon="&#xe098;"></span></a></div>');
		$('td:eq(1)', nRow).html('<div id="foil_' + aData[0] + '" style="display:inline;margin-right:5px;font-weight:bold;">'+aData[11] +'</div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',0,1,0,0,0)"><span class="iconb tipS" title="Add one Foil" data-icon="&#xe099;"></span></a><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',0,-1,0,0,0)"><span class="iconb tipS" title="Remove one Foil" data-icon="&#xe098;"></span></a></div>');


			$('td:eq(2)', nRow).html('<a class="cardhover" title="/mtgcardscans/' + aData[9] + '/' + aData[2] + '.full.jpg" href="?cardid=' + aData[0] + '">' + aData[2] + '</a></span>');
			$('td:eq(4)', nRow).html(replaceCostIcons(aData[4]));
			$('td:eq(5)', nRow).html(replaceColorIcons(aData[5]));

			$('td:eq(6)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Common.gif" class="tipS" title="' + aData[6].replace(":", "").replace("\"", "") + '" />');

			if (aData[7] == 'C')
				$('td:eq(7)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Common.gif"  alt="' + aData[6].replace(":", "").replace("\"", "") + '" />');
			if (aData[7] == 'U' || aData[7] == 'U // U')
				$('td:eq(7)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Uncommon.gif"  alt="' + aData[6].replace(":", "").replace("\"", "") + '" />');
			if (aData[7] == 'R')
				$('td:eq(7)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Rare.gif"  alt="' + aData[6].replace(":", "").replace("\"", "") + '" />');
			if (aData[7] == 'M')
				$('td:eq(7)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Mythic.gif"  alt="' + aData[6].replace(":", "").replace("\"", "") + '" />');
			if (aData[7] == 'T')
				$('td:eq(7)', nRow).html('<img src="http://www.deckbattle.com/mtgicons/' + aData[6].replace(":", "").replace("\"", "") + '_Rare.gif"  alt="' + aData[6].replace(":", "").replace("\"", "") + '" />');

if (aData[12] == '1')
			$('td:eq(8)', nRow).html('<div id="fav_' + aData[0] + '"><a href="#" class="iconb tipS" title="Mark/Unmark Favorite" data-icon="&#xe086;" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',0,0,0,0,1)"></a></div>');
else
			$('td:eq(8)', nRow).html('<div id="fav_' + aData[0] + '"><a href="#" class="iconb tipS" title="Mark/Unmark Favorite" data-icon="&#xe084;" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[2] + '\',0,0,0,0,1)"></a></div>');

		},
		"fnRowCallback" : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			$('td:eq(4),td:eq(5),td:eq(8)', nRow).addClass("centeredtd");
			$('td:eq(0)', nRow).addClass("tableActs");
			$('td:eq(1)', nRow).addClass("tableActs");
			$('td:eq(7)', nRow).addClass("tableActs");

		},
		"sDom" : '<"H"fl>rt<"F"ip>'		
	});
});
