$(function(){
	//Initialize the gallery
	$("#gallery").mCustomScrollbar({
    	scrollButtons:{
			enable:true
		},
		theme: "dark"
    });
});

//Comment Form
$("#addComment").on("click", function(event){
	event.preventDefault();
	$("#CommentViewlistingForm").stop(true,true).slideToggle(500);
});

//Gallery/Lightbox
$('#displayPicture').magnificPopup({
	delegate: 'a',
	type: 'image'
});

//Functionality for gallery
$(".imageContainer").click(function(){
	$("#gallery .imageContainer").removeClass("selected");
	$(this).addClass("selected");
	$("#displayPicture a").removeClass('show').addClass('hidden');
	var currentImage = $("#lightboxImage"+$(this).data('order'));
	$(currentImage).removeClass('hidden').addClass('show');
});

$("#gallery div.imageContainer:first-child").click();
