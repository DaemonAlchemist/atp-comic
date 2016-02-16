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
	
	//Toggle page transcripts
	if(!showTranscripts) {
		$("div.transcript").hide();
        $("h2.showTranscript").show();
	}
	$("h2.showTranscript").click(function(){
        $("h2.showTranscript").hide();
		$("div.transcript").toggle();
	});
});