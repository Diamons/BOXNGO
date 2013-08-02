<?php 
$this->start('css');
echo $this->Html->css(array('dashboard/main', 'pages/main', 'screen')); 
$this->end(); 
$this->start('scriptBottom');
echo $this->Html->script(array('timeliner.min', 'pages/about'));
$this->end(); 
?>
<div class="wrapper" id="content">
	<div class="aboutus row">
		<div class="row founder">
			<div class="col-2 col-lg-2">
				<img src="/images/founders/shahruk.jpg" />
			</div>
			<div class="col-10 col-lg-10">
				<h2>Shahruk Khan Age 19 <span class="title">Co-Founder</span></h2>
				<p>I got into web development in my senior year Web Development class at Brooklyn Tech High School. From there, I picked up Java, HTML, CSS, PHP, and Javascript. After graduating, I attended Hunter College and joined a company working $5 an hour for 40 hours a week in after classes and on the weekends. I also started a web development business when I turned 18 on the side and worked with clients such as lawyers, restaurants, artisans, and more. From there I learned various methodologies and skills such as PHP5, Python, MVC, Git, marketing, public speaking, MongoDB, AngularJS, and much more.</p>
				<p>BOX'NGO was originally my final project for my high school senior year Web Development class. Originally, the idea was a for a trading escrow service. Eventually, we got interviewed by the NYU Poly Incubator program and a major rehaul of our idea was necessary. Shortly afterward, I began discussing BOX'NGO with my long time friend Minling Zhao and from there we launched the site on December 2nd, 2012. From there, we've constantly iterated with improvements to the homepage, adding features like the <a href="/concierges/hunter_college">Concierge</a> feature, working on Facebook integration, and much more. BOX'NGO is a continuous process and entirely funded by the money we make.</p>
			</div>
		</div>
		<div class="row founder">
			<div class="col-10 col-lg-10">
				<h2>Minling Zhao Age 19 <span class="title">Co-Founder</span></h2>
				<p>I've been selling online for quite some time now. When I was 13, I started my eBay shop and from there I've been selling on platforms like eBay and Etsy. I've managed to make enough profit off my stores to keep myself going through college. Currently, I am a Bio-Medical major at NYU Poly. I founded BOX'NGO with Shahruk because I was tired of the way the only selling marketplace is right now. eBay recently raised its fees and many platforms are just too complicated and impersonal. You list something and it becomes hard for people to find your listings very quickly. Right now BOX'NGO helps solve that by charging a flat fee to the seller, having quick customer service and an easy listing process, and promoting listings that aren't doing so well across the site.</p>
				<p>
					Right now, we run BOX'NGO under the company Chocolate Squared LLC. We registered with New York State in January 2013 as an official business. I currently work on BOX'NGO in between school and homework and am always working on making the site grow.
				</p>
			</div>
			<div class="col-2 col-lg-2">
				<img src="/images/founders/minling.jpg" />
			</div>
		</div>
	</div>
	
	<div class="clearfix" id="timelineContainer">
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">High School</h2>
			<dl class="timelineMinor">
				<dt id="event01"><a>June 2011</a></dt>
				<dd class="timelineEvent" id="event01EX" style="display: none; ">
					<p>BOX'NGO was built using standard PHP for web development class. The concept of an online escrow trading service was built over 3 sleepless nights and received great praise from our teacher.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">March 2012</h2>
			<dl class="timelineMinor">
				<dt id="event02"><a>NYU Poly Incubator Rejection</a></dt>
				<dd class="timelineEvent" id="event02EX" style="display: none; ">
					<p>The idea for a trading site still prominent, we applied for a position in the accelerator program hosted by NYU Poly and got called in for an interview. The team consisted of Shahruk Khan, Brandon Jee, and Elliott James. We were quickly shot down and left very disheartened.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event03"><a>Future Co-founders Meet</a></dt>
				<dd class="timelineEvent" id="event03EX" style="display: none; ">
					<p>Shahruk reconnects with Minling Zhao.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">June 2012</h2>
			<dl class="timelineMinor">
				<dt id="event04"><a>Launch Page</a></dt>
				<dd class="timelineEvent" id="event04EX" style="display: none; ">
					<p>Extremely bored one day, Shahruk puts up a splash page for TheBoxnGo.com after buying the domain name. There was very little reception. <a target="_blank" href="http://i.imgur.com/6BdqwyG.jpg">(link)</a></p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">September - October 2012</h2>
			<dl class="timelineMinor">
				<dt id="event05"><a>Minling Bullies Shahruk</a></dt>
				<dd class="timelineEvent" id="event05EX" style="display: none; ">
					<p>Shahruk casually mentions BOX'NGO to Minling Zhao. She immediately jumps on board and wants to be involved. In an effort to make him stop being lazy, Minling continuously annoys Shahruk to build the site. Shahruk, after lots of nagging, continues to be lazy and does nothing.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event06"><a>Hurricane Sandy Hits NYC</a></dt>
				<dd class="timelineEvent" id="event06EX" style="display: none; ">
					<p>October 29th, 2012 Hurricane Sandy hit New York City. Power and transporation was out in many parts of the city for nearly a week. While a tragedy to many, Hurricane Sandy became a blessing for us. Giving us a week off from school, Shahruk built the intiial BOX'NGO platform in a week. <a target="_blank" href="http://i.imgur.com/ZjKwhE6.png">(link)</a></p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">December Launch</h2>
			<dl class="timelineMinor">
				<dt id="event07"><a>December 2nd, 2012</a></dt>
				<dd class="timelineEvent" id="event07EX" style="display: none; ">
					<p>We uploaded the site online, posted on Facebook, and shared with various groups and communities. We got lots of intitial traffic but very little registration.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event08"><a>Became Social</a></dt>
				<dd class="timelineEvent" id="event08EX" style="display: none; ">
					<p>We created our Facebook page, added a Support page, and started tweeting.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">January of 2013</h2>
			<dl class="timelineMinor">
				<dt id="event09"><a>Blog</a></dt>
				<dd class="timelineEvent" id="event09EX" style="display: none; ">
					<p>We setup a blog and styled it to look like our main site.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event10"><a>New Homepage</a></dt>
				<dd class="timelineEvent" id="event10EX" style="display: none; ">
					<p>People kept asking us the same question. What is BOX'NGO? Obviously, our homepage wasn't working so we redesigned the homepage to tell people more about what our site is about.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event11"><a>Social Login</a></dt>
				<dd class="timelineEvent" id="event11EX" style="display: none; ">
					<p>We worked on getting people logged in via Facebook. The overall integration took two nights.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event12"><a>Cease and Desist</a></dt>
				<dd class="timelineEvent" id="event12EX" style="display: none; ">
					<p>Another company sent us a letter to take down our domain and return it. We had to scramble to hire the services a lawyer, incorporate our LLC, and figure out how to afford it all.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event13"><a>All is good now!</a></dt>
				<dd class="timelineEvent" id="event13EX" style="display: none; ">
					<p>After days of not eating lunch to save money, scrounging for pennies, and selling our electronics, we managed to pay off our lawyer fees. We were successfully incorporated in New York State under the company Chocolate Squared LLC and quickly separated our personal and business finances to prevent a piercing of the corporate veil. Overall, we spent over $1500 to take care of all these problems.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event14"><a>Hunter Concierge</a></dt>
				<dd class="timelineEvent" id="event14EX" style="display: none; ">
					<p>One of our most massive creations to date, the Hunter Concierge feature lets people at Hunter College buy, sell, and trade textbooks based off a directory of every single class at the university. <a target="_blank" href="/concierges/hunter_college">(link)</a></p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event15"><a>Site Died :(</a></dt>
				<dd class="timelineEvent" id="event15EX" style="display: none; ">
					<p>Due to an error on Shahruk's part, we lost the site for 2 weeks around January 22nd. Our GIT files got overwritten and we had no working backup of the site's files. We had to wait for 2 weeks before Heroku could respond and we were worried we had lost all of our work. In the end, a combination of directly tweeting and constantly spamming got us our site back. Honestly, this is one of our most scariest moments because we genuinely thought that everything was gone and there was no way to get our files back.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">February 2013</h2>
			<dl class="timelineMinor">
				<dt id="event16"><a>We're Alive!</a></dt>
				<dd class="timelineEvent" id="event16EX" style="display: none; ">
					<p>Brought the site back up after 2 weeks of downtime.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event17"><a>New Categories</a></dt>
				<dd class="timelineEvent" id="event17EX" style="display: none; ">
					<p>We introduced a new categories feature which allowed people to select categories to list stuff in.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event18"><a>Trades, Promotions, and More!</a></dt>
				<dd class="timelineEvent" id="event18EX" style="display: none; ">
					<p>We allowed people in the same school to start trading. We also started running monthly promotions. For February, we gave away free charms. <a target="_blank" target="/promotions/february2013">(link)</a></p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event19"><a>New Homepage and Minor Redesign</a></dt>
				<dd class="timelineEvent" id="event19EX" style="display: none; ">
					<p>We redesigned our homepage to look more professional and help explain what BOX'NGO is. <a target="_blank" href="http://i.imgur.com/rxlWP4A.png">(link)</a></p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">March 2013</h2>
			<dl class="timelineMinor">
				<dt id="event20"><a>Acceptance into Stanford Bootcamp</a></dt>
				<dd class="timelineEvent" id="event20EX" style="display: none; ">
					<p>We learned we were heading to Stanford University's Entrepreneurs Bootcamp! <a target="_blank" target="http://bases.stanford.edu/e-bootcamp/">(link)</a>.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event21"><a>Messaging Built</a></dt>
				<dd class="timelineEvent" id="event21EX" style="display: none; ">
					<p>We setup the system to allow users to message one another.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event22"><a>Facebook Integration Updates</a></dt>
				<dd class="timelineEvent" id="event22EX" style="display: none; ">
					<p>We completely refined our Facebook approach. We cleaned up the source code, updated functionality, and used our app. Updates such as listing an item, liking a listing, and more are automatically displayed on a user's profile. We also updated which image and description Facebook automatically pulls when someone links to our site.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event23"><a>Free Coupons! Oh Boy!</a></dt>
				<dd class="timelineEvent" id="event23EX" style="display: none; ">
					<p>We built a coupon system which allows us to create coupons that users can use and receive a certain percentage off their purchase, a certain amount off their purchase, etc.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event24"><a>Stalker Alert! We Got Maps Now!</a></dt>
				<dd class="timelineEvent" id="event24EX" style="display: none; ">
					<p>We display a user's school's geographical information on a map. A nifty little feature that we're planning to open up for trading soon.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event25"><a>No More Logouts</a></dt>
				<dd class="timelineEvent" id="event25EX" style="display: none; ">
					<p>We took care of a really annoying issue where anytime the site was updated, users would all be logged out.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event26"><a>View Listing Touchup</a></dt>
				<dd class="timelineEvent" id="event26EX" style="display: none; ">
					<p>Our view listing page felt a little too dark, so we removed the dark background, touched up the sliders, and made it feel fresher and sleeker.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event27"><a>Facebook Open Graph</a></dt>
				<dd class="timelineEvent" id="event27EX" style="display: none; ">
					<p>We completely revamped our Facebook approach and used Open Graph now using our Facebook application.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">April 2013</h2>
			<dl class="timelineMinor">
				<dt id="event28"><a>Stanford Bootcamp</a></dt>
				<dd class="timelineEvent" id="event28EX" style="display: none; ">
					<p>On April 17th, we flew out to California to attend Stanford Bootcamp. The program lasted for 4 days. We spoke with venture capitalists, angel investors, attended keynotes given by speakers such as the 3rd employee of eBay, the CEO of Eventbrite, the CEO of YouNoodle, a member of Google's board of directors, and much more.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event29"><a>New Homepage, New Mission</a></dt>
				<dd class="timelineEvent" id="event29EX" style="display: none; ">
					<p>April 24th we launched a new homepage <a target="_blank" href="http://i.imgur.com/QKacDNE.jpg">(link)</a> and redefined our mission. EDU email address only was something we pursued to help us get started and figure out the glitches with the site. We felt we were ready to target a much broader audience and reach for greater heights after Stanford E-Bootcamp.</p>
				</dd>
			</dl>
			<dl class="timelineMinor">
				<dt id="event30"><a>Few Minor Updates and Finals</a></dt>
				<dd class="timelineEvent" id="event30EX" style="display: none; ">
					<p>After we opened up our platform and removed the EDU email restriction, we saw a huge growth in our site. We received nearly 10 - 15 new registrations per day and went from about 30 to 420 listings on our site in the course of 3 weeks. We are now working on tweaking our platform to create a better experience for our buyers and sellers. We replaced Disqus for comments and shuffled the view listing page around a bit <a href="http://i.imgur.com/9jWtjU6.png" target="_blank">(link)</a>, changed the look of the categories <a href="http://i.imgur.com/oTSL0aK.png" target="_blank">(link)</a>, and completely redesigned the profile page <a href="http://i.imgur.com/I5e5IJM.png" target="_blank">(link)</a>. Finals week is next week so we're taking things a little slowly as of late until we get all this college stuff over with.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">May 2013</h2>
			<dl class="timelineMinor">
				<dt id="event31"><a>Finals</a></dt>
				<dd class="timelineEvent" id="event31EX" style="display: none; ">
					<p>We're buckling down for finals season.</p>
				</dd>
			</dl>
		</div>
		<div class="timelineMajor">
			<h2 class="timelineMajorMarker">June 2013</h2>
			<dl class="timelineMinor">
				<dt id="event32"><a>Improved Home Page</a></dt>
				<dd class="timelineEvent" id="event32EX" style="display: none; ">
					<p>We added a "featured seller" part to our homepage (for our users!). Now users can check out interesting sellers on the BOX'NGO platform. In addition, we've added a little stream of recent activity so people can see the latest shop views.</p>
				</dd>
				<dt id="event33"><a>New Buy Now Button</a></dt>
				<dd class="timelineEvent" id="event33EX" style="display: none; ">
					<p>We supersized our buy now button and made it much more prominent.</p>
				</dd>
			</dl>
		</div>
	</div>
</div>
