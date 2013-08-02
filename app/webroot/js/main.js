$(function(){
	$("#categories ul li").hover(function(){
		$(this).find("ul.submenu").stop(true,true).delay(100).slideDown();
	}, function(){
		$(this).find('ul.submenu').delay(200).slideUp();
	});
	
	function postLike(_this, listingId) {
		$.ajax({
			url: '/apis/checkfacebookuser',
			data: {listingid: listingId},
			success: function(response){
				var facebookId;
				if(response == false){
					addFavorite(_this);
				}
				else{
					FB.api('me/theboxngo:favorite','post',
					{
						object: window.location.href,
						access_token: response					
					},
						function(response) {
							addFavorite(_this, response.id);
						}
					);
				}
			}
		});
	}

	function addFavorite(_this, facebookId){
		var favoriteClicked = $(_this);
		$.ajax({
			url: getDomain()+'users/addfavorite',
			data: {listingid: $(_this).data('listingid'), facebook_story: facebookId, url: window.location.href},
			success: function(response){
				$(_this).find('.loading').hide();
				$(_this).find('.icon-heart').css({opacity: 1});;
				favoriteClicked.removeClass('addfavorite');
				favoriteClicked.addClass('addfavoriteused');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	}

	//Add favorites
	$("body").on("click", "a.addfavorite", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$(this).find('.icon-heart').css({opacity: 0});;
		$(this).find('i.loading').show();
		postLike(this, $(this).data('listingid'));
	});
	$("body").on("click", "a.addfavoriteused", function(event){
		event.preventDefault();
		var favoriteClicked = $(this);
		$(this).find('.icon-heart').css({opacity: 0});;
		$(this).find('i.loading').show();
		var _this = this;
		$.ajax({
			url: getDomain()+'users/removefavorite',
			data: {listingid: $(this).data('listingid')},
			success: function(response){
				$(_this).find('.loading').hide();
				$(_this).find('.icon-heart').css({opacity: 1});;
				favoriteClicked.removeClass('addfavoriteused');
				favoriteClicked.addClass('addfavorite');
				$("body .favoritemessage").remove();
				$("body").prepend(response);
				$("body .favoritemessage").slideDown().delay(4000).slideUp();
			}
		});
	});
	
	$("#searchTrigger, #listButton").on("click", function(){
		$("#SearchIndexForm").submit();
	});

	$(window).scroll(function(){
	    if($(this).scrollTop()){
	        $('#toTop').fadeIn();
	    }else{
	        $('#toTop').fadeOut();
	    }
	});
});

function getDomain(){
	return "/";
}