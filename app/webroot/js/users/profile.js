$(function(){
	$('#userProfileSections a').click(function (event) {
		event.preventDefault();
		$(this).tab('show');
	});
});