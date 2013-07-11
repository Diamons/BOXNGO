<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '116996495106723', // App ID from the App Dashboard
      channelUrl : '//theboxngo.com/channel.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });

  };

  function login(url) {
	var _this = this;
	FB.login(function(response) {
		
		if (response.authResponse) {
			var date = new Date();
			var time = 2;
			date.setTime(date.getTime() + (time * 60 * 1000));
			document.cookie='fbAccess='+response.authResponse.accessToken+'; path=/; expires='+date.toUTCString()+';';
			$.ajax({
				data: {userID: response.authResponse.userID},
				url: getDomain()+'users/facebook/self',
				success: function(response){
					console.log(response);
					$.ajax({
						url: url,
						success: function(response){
							console.log(response);
							$("a#shareFacebook").fadeOut(300);
							$("#facebookLinked").delay(400).fadeIn();
						}
					});
				}
			});
		} else {
			// cancelled
		}
	}, {scope: 'email,publish_stream,publish_actions'});
}
  // Load the SDK's source Asynchronously
  // Note that the debug version is being actively developed and might 
  // contain some type checks that are overly strict. 
  // Please report such bugs using the bugs tool.
  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
</script>