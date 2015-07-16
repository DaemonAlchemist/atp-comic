$(function(){
	//Admin page edit arc tab
	$("span.arc-selector").click(function(){
		var checkbox = $(this).find("input");
		var arcParagraph = $("#current-arcs").find("p#arc-" + checkbox.val());
		if(checkbox.prop("checked")) {
			checkbox.prop("checked", false);
			checkbox.parent().removeClass("arc-selected");
			arcParagraph.addClass("arc-removed");
		} else {
			checkbox.prop("checked", true);
			checkbox.parent().addClass("arc-selected");
			arcParagraph.removeClass("arc-removed");
		}
	});
	
	//Admin page edit move tab
	$("div#page-arc-lists").accordion();
	$("span.node-mover").click(function(){
		var div = $(this).parents("div.move-page");
		
		//Get node move information
		var nodeId = div.find("td.node-current").data("nodeid");
		var direction = $(this).data("direction");
		
		//Send move request
		$.ajax({
			url: '/comic/api/move-page',
			type: 'POST',
			data: {
				nodeId: nodeId,
				direction: direction
			},
			success: function(data, textStatus, jqXHR){
				data = $.parseJSON(data);
				if(data.result) {
					div.find("div.node-before span").html(data.prevPageName);
					div.find("div.node-after span").html(data.nextPageName);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert("There was an error moving the page:\n\n" + jqXHR.status + ": " + errorThrown);
			}
		});
	});
});