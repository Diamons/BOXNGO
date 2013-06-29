filepicker.setKey('A4piuF5imQ6K6kgc3f51_z');
//When the user clicks the button, import a file using Filepicker.io
var editPane = document.getElementById('upload');
editPane.onclick = function(){
	var cover = $(document.createElement("div"));
	cover.css({'position': 'fixed', 'top': 0, 'bottom': 0, 'right': 0,left: 0, 'background-color': 'rgba(0,0,0,.6)', 'opacity': '0.5', 'z-index': 10000});
	$("#content.wrapper input[type='submit']").fadeOut();
	filepicker.pickMultiple({
		mimetype: 'image/*',
	}, function(fpfiles) {
		for(i = 0; i < fpfiles.length; i++){
			filepicker.store(fpfiles[i], function(copy){
				$("input[type='submit']").fadeIn();
				var idDiv = getId(copy.url);
				var html="<div id='"+idDiv+"'><img src='"+copy.url+"' /><a href='#' onclick='deleteImage(\""+copy.url+"\"); return false;'>Delete</a></div>";
				$("#editor").append($(html));
				appendImages();
			});
		}
	});
};

function deleteImage(div){
	var file = {url: div};
	$("div#" + getId(file.url)).slideUp().remove();
	$("#ShopImages").val($("#ShopImages").val().replace(div + ";", ""));
	filepicker.read(file, function(data){
		filepicker.remove(file, function(){
		});
	});
}

function getId(fpUrl){
	fpUrl = fpUrl.split("/");
	return fpUrl[fpUrl.length-1];
}

function appendImages(){
	newUrls = "";
	$("#mainImage").remove();
	var div = document.createElement("div");
	$(div).text('Main Image').attr({'id' : 'mainImage'});
	$('#editor > div img').each(function(index) {
		if(index==0){
			$(this).parent().append(div);
		}
		
		newUrls += $(this).attr('src') + ";";
	});
	$("#ShopImages").val('').val(newUrls);
}
$(document).ready(function(){
    $( "#editor" ).sortable({
    stop: function() {
		appendImages();
    }
	});
	$("#editor").disableSelection();

	if($("#ShopShipping1").attr('checked') == "checked"){
		$("#shipping").slideDown();
	}
	var images = $("#ShopImages").text().split(";");
	for(i = 0; i < images.length -1; i++){
		var idDiv = getId(images[i]);
			var html="<div id='"+idDiv+"'><img src='"+images[i]+"' /><a href='#' onclick='deleteImage(\""+images[i]+"\"); return false;'>Delete</a></div>";
			$("#editor").append($(html));
	}
	appendImages();
	
});