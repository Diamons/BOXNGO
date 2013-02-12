$(function(){
	$(document).foundationCustomForms();
	$("#categories ul li").hover(function(){
		$(this).find("ul.submenu").stop(true,true).delay(100).slideDown();
	}, function(){
		$(this).find('ul.submenu').delay(200).slideUp();
	});
	
	//Add favorites
	$("body").on("click", "a.addfavorite", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$.ajax({
			url: getDomain()+'users/addfavorite',
			data: {listingid: $(this).data('listingid')},
			success: function(response){
				favoriteClicked.removeClass('addfavorite');
				favoriteClicked.addClass('addfavoriteused');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	});
	$("body").on("click", "a.addfavoriteused", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$.ajax({
			url: getDomain()+'users/removefavorite',
			data: {listingid: $(this).data('listingid')},
			success: function(response){
				favoriteClicked.removeClass('addfavoriteused');
				favoriteClicked.addClass('addfavorite');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	});
	
});

function getDomain(){
	return "/";
}