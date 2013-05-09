filepicker.setKey('A4piuF5imQ6K6kgc3f51_z');
//When the user clicks the button, import a file using Filepicker.io
var editPane = document.getElementById('upload');
editPane.onclick = function(){
	var cover = $(document.createElement("div"));
	cover.css({'position': 'fixed', 'top': 0, 'bottom': 0, 'right': 0,left: 0, 'background-color': 'rgba(0,0,0,.6)', 'opacity': '0.5', 'z-index': 10000});
	$("#UserManageaccountForm input[type='submit']").fadeOut();
	filepicker.pick({
		mimetype: 'image/*',
		services: ['COMPUTER', 'DROPBOX', 'FACEBOOK', 'FLICKR', 'GOOGLE_DRIVE']
	}, function(FPFile) {
		filepicker.store(FPFile, function(copy){
			$("#UserProfilepic").val(copy.url);
			$("#UserManageaccountForm input[type='submit']").fadeIn();
			var idDiv = getId(copy.url);
			var html="<div id='"+idDiv+"'><img src='"+copy.url+"' /></div>";
			$("#editor").html($(html));
		});
	});
};

function getId(fpUrl){
	fpUrl = fpUrl.split("/");
	return fpUrl[fpUrl.length-1];
}

function updateCountdown() {
    var remaining = 300 - jQuery('#UserProfileInfo').val().length;
    jQuery('.countdown').text(remaining + ' characters remaining.');
}

$(document).ready(function(){
	if($("#UserProfilepic").val() != ""){
		$("#editor").html("<img src='"+$("#UserProfilepic").val()+"' />");
	}
	updateCountdown();
    $('#UserProfileInfo').change(updateCountdown);
    $('#UserProfileInfo').keyup(updateCountdown);
});