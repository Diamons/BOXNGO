$(function(){
	$("#addComment").on("click", function(event){
		event.preventDefault();
		$("#CommentViewlistingForm").stop(true,true).slideToggle(500);
	});
	
});