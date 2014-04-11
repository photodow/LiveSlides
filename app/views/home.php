<section id="welcome" class="welcome">
	<article id="presentation">
    	<button class="left"><i class="icon-chevron-left"></i></button>
    	<ul class="pages">
        	<li class="page one active">
            	<div class="centVert">
                	<i class="icon-liveslides"></i>
                	<h1>Audience Devices Sync Live</h1>
                	<p>Audience Members Can View Your Presentation From Their Mobile Devices</p>
                    <p><a href="/register" class="button" title="Click here and get started by registering today!">Get Started <i class="icon-caret-right"></i></a></p>
 				</div>
         	</li>
        	<li class="page">Page #2</li>
        </ul>
    	<button class="right"><i class="icon-chevron-right"></i></button>
	</article>
</section>
<section id="features" class="features">
	<div class="innerWrapper">
		<ul>
        	<li class="linebreak">
            	<h2>
                	<i class="icon-eye"></i>
                    Live Presentations
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        	<li>
            	<h2>
                	<i class="icon-pencil"></i>
                    Presentation Editor
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        	<li>
            	<h2>
                	<i class="icon-mail-forward"></i>
                    Share Presentations
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        	<li class="linebreak">
            	<h2>
                	<i class="icon-mobile-phone"></i>
                    Mobile Access
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        	<li>
            	<h2>
                	<i class="icon-search"></i>
                    Search Engine Friendly
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        	<li>
            	<h2>
                	<i class="icon-cloud"></i>
                    Available in the Cloud
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu orem.</p>
            </li>
        </ul>
    </div>
</section>
<section id="about" class="about">
	<div class="innerWrapper">
        <h2><i class="icon-liveslides"></i> About Us</h2> <!-- TO DO: Add custom LiveSlide Font Icon -->
        <div class="two-col">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu elementum lorem. Phasellus accumsan felis vitae dolor iaculis sagittis. Mauris sollicitudin purus tellus, a sodales nisl rutrum a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec sit amet fringilla nibh. Aliquam tincidunt accumsan aliquet.</p>
            <p>In fringilla elit lorem, lacinia dictum tortor molestie at. Fusce sagittis erat diam, sit amet molestie sem sodales et. Nulla lobortis aliquam tortor, sed ultricies odio porta eu. Nunc fringilla nibh id urna sagittis convallis. Nam sed mauris lobortis, euismod neque eget, varius lectus. Vestibulum id faucibus orci, vel sagittis felis. Pium sem, vitae pellentesque nisl est sit amet lacus. Phasellus tempor arcu non mauris convallis congue. Duis vel sagittis sapien, at porta risus. Vivamus pellentesque. tiam commodo mi lorem, vel vulputate iaculis elit. Aliquam gravida arcu sit amet commodo egestas.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim sodales augue eu fringilla. Aenean a pretium augue, eu elementum lorem. Phasellus accumsan felis vitae dolor iaculis sagittis. Mauris sollicitudin purus tellus, a sodales nisl rutrum a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec sit amet fringilla nibh. Aliquam tincidunt accumsan aliquet.</p>
            <p>In fringilla elit lorem, lacinia dictum tortor molestie at. Fusce sagittis erat diam, sit amet molestie sem sodales et. Nulla lobortis aliquam tortor, sed ultricies odio porta eu. Nunc fringilla nibh id urna sagittis convallis. Nam sed mauris lobortis, euismod neque eget, varius lectus. Vestibulum id faucibus orci, vel sagittis felis. Pium sem, vitae pellentesque nisl est sit amet lacus. Phasellus tempor arcu non mauris convallis congue. Duis vel sagittis sapien, at porta risus. Vivamus pellentesque. tiam commodo mi lorem, vel vulputate iaculis elit. Aliquam gravida arcu sit amet commodo egestas.</p>
        </div>
    </div>
</section>
<section id="contact" class="contact">
	<div class="innerWrapper">
    	<section class="left">
        	<h2><i class="icon-envelope"></i> Contact Us</h2>
            <div class="contactFormWrapper">
                <div class="overlayMessage loading">
                	<div class="centerVert">
                    	<p>Processing Email...</p>
                        <div class="spin"></div>
                    </div>
                </div>
                <div class="overlayMessage sent">
                	<div class="centerVert">
                    	<h3><i class="icon-bullhorn"></i> Thanks for Contacting Us!</h3>
                    	<p>Your message has successfully been processed, and we will get back with you shortly. In the meantime, if you would like to send us another message just click the button below. Thanks again!</p>
                        <p><button type="button" class="button newMessage">New Message <i class="icon-envelope"></i></button></p>
                    </div>
                </div>
                <form id="contactForm" action="/process/contactform" method="POST">
                    <p class="error" style="display: none;"><i class="icon-exclamation-circle"></i> There was a problem processing your email. Please review the fields below and try again.</p>
                    <div>
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name" class="name" />
                    </div>
                    <div>
                        <label for="email">Your Email Address</label>
                        <input type="text" name="email" id="email" class="email" />
                    </div>
                    <div>
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" />
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea name="message" id="message"></textarea>
                    </div>
                    <div class="last">
                        <button name="submit" id="submit" class="submit">Send <i class="icon-envelope"></i></button>
                    </div>
                </form>
            </div>
        </section>
        <section class="right">
        	<h2><i class="icon-heart"></i> Special Thanks</h2>
            <ul>
            	<li>Coming Soon</li>
            </ul>
        </section>
    </div>
</section>