	$(function () {

	$("#donut").bind("plothover", pieHover);
	$("#donut").bind("plotclick", pieClick);
	
	function pieHover(event, pos, obj) 
	{
		if (!obj)
		return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
	}

	function pieClick(event, pos, obj) 
	{
		if (!obj)
					return;
		//percent = parseFloat(obj.series.percent).toFixed(2);
		
		alert(''+obj.series.label+': '+ obj.series.data[0][1]+' Cards');
	}

});

	
	function pieCardtype(deckid)
	{
				
		 function onDataReceived(data) {
            // and plot all we got
    $.plot($("#donut"), data, 
	{
			series: {
				pie: { 
					show: true,
					innerRadius: 0.25,
					radius: 1,
					label: {
						show: true,
						radius: 2/3,
						formatter: function(label, series){
							return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">'+Math.round(series.percent) + ' %</div>';
							//return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">'+series.data[0][1] + '</div>';
						},
						threshold: 0.0
					}
				}
			},
			legend: {
				show: true,
				noColumns: 1, // number of colums in legend table
				labelFormatter: null, // fn: string -> string
				labelBoxBorderColor: "#000", // border color for the little label boxes
				container: null, // container (as jQuery object) to put legend in, null means default on top of graph
				position: "ne", // position of default legend container within plot
				margin: [5, 10], // distance from grid edge to default legend container within plot
				backgroundColor: "#efefef", // null means auto-detect
				backgroundOpacity: 1 // set to 0 to avoid background
			},
			grid: {
				hoverable: true,
				clickable: true
			},
		});
	     }
        
        $.ajax({
            url: '/dashboard/services/getdeckpiebytype.php?deckid=' + deckid,
            method: 'GET',
            dataType: 'json',
            success: onDataReceived
        });
		
	
	}
	
	function pieColors(deckid) {
	
		 function onDataReceived(data) {
    $.plot($("#donut"), data, 
	{
			series: {
				pie: { 
					show: true,
					innerRadius: 0.25,
					radius: 1,
					label: {
						show: true,
						radius: 2/3,
						formatter: function(label, series){
							return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">'+'<br/>'+Math.round(series.percent)+'%</div>';
						},
						threshold: 0.0
					}
				}
			},
			legend: {
				show: true,
				noColumns: 1, // number of colums in legend table
				labelFormatter: null, // fn: string -> string
				labelBoxBorderColor: "#000", // border color for the little label boxes
				container: null, // container (as jQuery object) to put legend in, null means default on top of graph
				position: "ne", // position of default legend container within plot
				margin: [5, 10], // distance from grid edge to default legend container within plot
				backgroundColor: "#efefef", // null means auto-detect
				backgroundOpacity: 1 // set to 0 to avoid background
			},
			grid: {
				hoverable: true,
				clickable: true
			},
		});
	     }
        
        $.ajax({
            url: '/dashboard/services/getdeckpiebycolor.php?deckid=' + deckid,
            method: 'GET',
            dataType: 'json',
            success: onDataReceived
        });
	
	}
	