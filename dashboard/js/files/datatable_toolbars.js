
function createTableToolbarDeck() {
var html =	'<ul class="btn-group toolbar"><li><a href="#" class="tablectrl_small bDefault" data-toggle="dropdown"><span class="iconb" data-icon="&#xe1f7;"></span></a><ul class="dropdown-menu pull-right"><li><a href="#" style="padding-left:12px;"><span class="icos-add"></span>Add to deck</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-heart"></span>Edit amount</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Used in deck...</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to favorites</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to tradelist</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Remove #</a></li></ul></li></ul>'
	
	return html;
}


function createTableToolbarCollection() {

var html =	'<ul class="btn-group toolbar"><li><a href="#" class="tablectrl_small bDefault" data-toggle="dropdown"><span class="iconb" data-icon="&#xe1f7;"></span></a><ul class="dropdown-menu pull-right"><li><a href="#" style="padding-left:12px;"><span class="icos-add"></span>Add to deck</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-heart"></span>Edit amount</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Used in deck...</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to favorites</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Add to tradelist</a></li><li><a href="#" class="" style="padding-left:12px;"><span class="icos-pencil"></span>Remove #</a></li></ul></li></ul>'

	return html;
}

function createTableToolbarCollectionAddOptions() {
	var html = '<div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,1,0,0)"><span class="iconb tipS" title="Add to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,0,1,0)"><span class="iconb tipS" title="Add Foil to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,0,0,1)"><span class="iconb tipS" title="Add to Favorites" data-icon="&#xe144;"></span></a></div><br /></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,-1,0,0)"><span class="iconb tipS" title="Add to Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,0,-1,0)"><span class="iconb tipS" title="Remove Foil from Wishlist" data-icon="&#xe082;"></span></a></div><div class="btn-group"><a href="#" class="tablectrl_small bDefault" onclick="addcardstocollection(' + aData[0] + ',\'' + aData[1] + '\',0,0,0,0,-1)"><span class="iconb tipS" title="Add to Favorites" data-icon="&#xe144;"></span></a></div>';
}