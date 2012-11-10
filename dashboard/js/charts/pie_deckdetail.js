	$(function () {
		var data = [];
		var series = Math.floor(Math.random()*10)+1;
		
		data[0] = { label: "Land", data: Math.floor(Math.random()*100)+1 }
		data[1] = { label: "Creature", data: Math.floor(Math.random()*100)+1 }
		data[2] = { label: "Sorcery", data: Math.floor(Math.random()*100)+1 }
		data[3] = { label: "Instant", data: Math.floor(Math.random()*100)+1 }
		data[4] = { label: "Aura", data: Math.floor(Math.random()*100)+1 }
		data[5] = { label: "Curse", data: Math.floor(Math.random()*100)+1 }
		data[6] = { label: "Artifacts", data: Math.floor(Math.random()*100)+1 }
		data[7] = { label: "Planeswalker", data: Math.floor(Math.random()*100)+1 }
		
	
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
		percent = parseFloat(obj.series.percent).toFixed(2);
		alert(''+obj.series.label+': '+percent+'%');
	}

});

	
	function pieCardtype()
	{
				var data = [];
		var series = Math.floor(Math.random()*10)+1;
		
		data[0] = { label: "Land", data: Math.floor(Math.random()*100)+1 }
		data[1] = { label: "Creature", data: Math.floor(Math.random()*100)+1 }
		data[2] = { label: "Sorcery", data: Math.floor(Math.random()*100)+1 }
		data[3] = { label: "Instant", data: Math.floor(Math.random()*100)+1 }
		data[4] = { label: "Aura", data: Math.floor(Math.random()*100)+1 }
		data[5] = { label: "Curse", data: Math.floor(Math.random()*100)+1 }
		data[6] = { label: "Artifacts", data: Math.floor(Math.random()*100)+1 }
		data[7] = { label: "Planeswalker", data: Math.floor(Math.random()*100)+1 }
		
	
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
	
	function pieColors() {
				var data = [];
		var series = Math.floor(Math.random()*10)+1;
		
		data[0] = { label: "Red", data: Math.floor(Math.random()*100)+1 }
		data[1] = { label: "Green", data: Math.floor(Math.random()*100)+1 }
		data[2] = { label: "Blue", data: Math.floor(Math.random()*100)+1 }
		data[3] = { label: "Black", data: Math.floor(Math.random()*100)+1 }
		data[4] = { label: "White", data: Math.floor(Math.random()*100)+1 }
		data[5] = { label: "Artifact", data: Math.floor(Math.random()*100)+1 }
		data[6] = { label: "Multi", data: Math.floor(Math.random()*100)+1 }
	
	
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
	