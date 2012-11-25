function barTotals(deckid)
{
	
	 function onDataReceived(data) {
            // and plot all we got
 var plot =  $.plot($("#placeholder1"), data, {
        grid:{
            hoverable:false
        },
			 legend: false,
    });
   
  }

      $.ajax({
            url: '/dashboard/services/getdeckbarbytotal.php?deckid=' + deckid,
            method: 'GET',
            dataType: 'json',
            success: onDataReceived
        });
	


	
 
}
function barColors(deckid)
{
    var d1 = [];
    for (var i = 0; i <= 7; i += 1)
        d1.push([i, parseInt(Math.random() * 30)]);
 
    var d2 = [];
    for (var i = 0; i <= 7; i += 1)
        d2.push([i, parseInt(Math.random() * 30)]);
 
    var d3 = [];
    for (var i = 0; i <= 7; i += 1)
        d3.push([i, parseInt(Math.random() * 30)]);
 
    var ds = new Array();
 
     ds.push({
        data:d1,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 1,
        }
    });

    ds.push({
        data:d2,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 2
        }
    });

    ds.push({
        data:d3,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 3
        }
    });

    ds.push({
        data:d3,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 4
        }
    });
    ds.push({
        data:d3,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 5
        }
    });
    ds.push({
        data:d3,
        bars: {
            show: true, 
            barWidth: 0.1, 
            order: 6
        }
    });
	
 var plot =  $.plot($("#placeholder1"), ds, {
        grid:{
            hoverable:false
        },
			 legend: false,
                

    });

}