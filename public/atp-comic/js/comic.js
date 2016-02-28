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
    var transcriptVisible = true;
    var title = $("h2#transcriptToggle span");
    var text = $("div#transcript");
	if(!showTranscripts) {
        transcriptVisible = false;
		text.hide();
        title.html('Show Transcript');
	}
	$("h2#transcriptToggle").click(function(){
        text.toggle();
        transcriptVisible = !transcriptVisible;
        title.html(transcriptVisible ? "Hide Transcript" : "Show Transcript");
	});
});