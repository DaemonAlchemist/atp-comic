$(function(){
	//Comic page all tabs toggle
	$(".current-arc-links").click(function(){
		return;
		$(".current-arc-links").hide();
		$(".all-arc-links").show();
	});
	$(".all-arc-links").click(function(){
		return;
		$(".all-arc-links").hide();
		$(".current-arc-links").show();
	});
});