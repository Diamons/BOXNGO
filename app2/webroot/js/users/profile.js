$(function(){
	var changeView = function(event){
		event.preventDefault();
		if(event.target.id == "favoritesView"){
			$("#favorites").stop(true,true).slideDown();
			$("#shopItems").stop(true,true).slideUp();
		}else{
			$("#shopItems").stop(true,true).slideDown();
			$("#favorites").stop(true,true).slideUp();
		}
	};
	$("#favoritesView, #itemslistedView").on("click", changeView);	
});