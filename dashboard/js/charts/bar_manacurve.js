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
	
	 function onDataReceived(data) {
            // and plot all we got
 var plot =  $.plot($("#placeholder1"), data, {
        grid:{
         	color:"#333333",
    	  backgroundColor: { colors: ["#eeeeee", "#e1e1e1"] }
        },
			 legend: false,
    });
   
  }

      $.ajax({
            url: '/dashboard/services/getdeckbarbycolor.php?deckid=' + deckid,
            method: 'GET',
            dataType: 'json',
            success: onDataReceived
        });

}