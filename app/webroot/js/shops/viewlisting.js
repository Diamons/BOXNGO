$(function(){
	$("#addComment").on("click", function(event){
		event.preventDefault();
		$("#CommentViewlistingForm").stop(true,true).slideToggle(500);
	});

	var image = document.getElementById("displayPicture");
	image.innerHTML = "<img src='' />";

	$("#gallery").mCustomScrollbar({
    	scrollButtons:{
			enable:true
		},
		theme: "dark"
    });

    $("#gallery").on("click", ".imageContainer", function(){
    	$("#displayPicture img").attr('src', $(this).data('image'));
    	$("#gallery .imageContainer").removeClass("selected");
    	$(this).addClass("selected");
    });

    $("#gallery div.imageContainer:first-child").click();
});