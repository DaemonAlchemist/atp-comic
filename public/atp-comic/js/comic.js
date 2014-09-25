$(function(){
	//Comic page all tabs toggle
	$(".current-arc-links").click(function(){
		$(".current-arc-links").hide();
		$(".all-arc-links").show();
	});
	$(".all-arc-links").click(function(){
		$(".all-arc-links").hide();
		$(".current-arc-links").show();
	});
	
	//Admin page arc tab
	$("span.arc-selector").click(function(){
		var checkbox = $(this).find("input");
		if(checkbox.prop("checked")) {
			checkbox.prop("checked", false);
			checkbox.parent().removeClass("arc-selected");
		} else {
			checkbox.prop("checked", true);
			checkbox.parent().addClass("arc-selected");
		}
	});
});