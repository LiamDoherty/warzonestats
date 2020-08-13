<div class="landing-wrapper bg-primary">
	<h2>Tutorial</h2>
	<div class="mainContainer">
    <div style="width: 100%">
        <div class="vids">
            <iframe src="https://www.youtube.com/embed/IjS8o2h8qLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </br>
			<p>If you are a streamer that plays COD Warzone, this is the perfect stats overlay for you.</p>
            <p>This tutorial will help you get the stats overlay up and running and ready for streaming. 
             Additionally we will run through the different options and future plans for the overlay.
             This overlay will work with all major streaming platforms. Including Twitch, Mixer and Youtube. 
             So long as your streaming software supports browser sources.</p>

            <p>Currently there are two overlay variations available to choose from. One a minimal overlay for displaying daily stats. The other displays both daily and total stats.</p>

            <p>This overlay is still in beta so any feedback or feature suggestions would be great.</p>
        </br>
            <h3>Overview</h3>
            <p>These stats overlays are specifically for Call of Duty’s free-to-play battle royale Warzone. The two options that are available are daily stats and total & daily stats.</p>
            <p>Daily stats overlay is the more minimal version of the overlay, only displaying daily kills and daily wins.</p>
            <p>For the time being we only have an overlay for COD Warzone stats. Future plans include creating overlays for regular Modern Warfare stats.</p>
            <div class ="std-image-wrapper">
                <div class="center top-gap std-image">
                    <img alt="call of duty stats overlay" src=<?php echo base_url("Src/DailyPreview.png"); ?>>
                </div>
            </div>
            </br>
            <p>Total and Daily Stats overlay displays the same daily stats. However in addition to these stats you will also see total wins & kills stats.</p>
            <div class ="std-image-wrapper">
                <div class="center top-gap std-image">
                    <img alt="call of duty overlay" src=<?php echo base_url("Src/OverlayPreview.png"); ?>>
                </div>
            </div>
            </br>
            <p>Once you start the overlay your daily stats will start at zero and get updated every ten minutes.</p>
        </br>
            <h3>Generating The Overlay</h3>
            <p>First things first. Go to the home page. Here you should see this setup screen for the stats overlay.</p>
            <div class ="std-image-wrapper">
                <div class="center top-gap std-image">
                    <img alt="call of duty tutorial preview" src=<?php echo base_url("Src/homepagePreview.png"); ?>>
                </div>
            </div>
            </br>
            <p>Enter you username and select the correct platform. If either of these aren’t correct you should be notified when you try to generate a link.</p>
            <p>When changing the overlay type, the preview image will update. This gives you some insight of which overlay is better suited for your stream setup.</p>
            <p>Once you have input your details, press the generate link button. A link will appear below if the username and platform were correct.</p>
            <div class ="std-image-wrapper">
                <div class="center top-gap std-image">
                    <img alt="overlay session url" src=<?php echo base_url("Src/sessionurl.png"); ?>>
                </div>
            </div>
            </br>
            <h3>Adding The Overlay To Streamlabs</h3>
            <p>Now that you have your link you will need to copy it. Open up Streamlabs, Obs or any streaming software that supports a browser source.</p>
            <p>Right click your browser source of choice and select properties. Set the width to 1920 and the height 400.</p>
            <p>If you do not use the correct width or height, the overlay could show off center. Additionally the overlay may get clipped or not show at all.</p>
            <p>Using the URL from the website enter it into the browser source.</p>
            <div class ="std-image-wrapper">
                <div class="center top-gap std-image">
                    <img alt="overlay session url" src=<?php echo base_url("Src/streamlabs-preview.png"); ?>>
                </div>
            </div>
            </br>
            <p>The overlay will now display if you have your browser source active. Position and resize the browser source as you please.</p>
            <p>Keep in mind that refreshing the browser source will reset your daily stats back to zero. Refreshing the browser source happens when a scene becomes active and the “Refresh Browser Source When Scene Becomes Active” setting is enabled.</p>
            </br>
            <h3>Future Plans</h3>
            <p>At the moment the overlay is only works with COD warzone stats. In the future we would like to add an overlay for the Modern Warfare multiplayer stats.</p>
            <p>Additionally there are some plans to add a section to the website for displaying career stats. This is for viewing in depth stats of your multiplayer career.</p>
            <p>In future updates, a color setting will be added. This will allow you to change the color of the stats overlay to better suit your branding.</p>
            <p>Once more features start to get added, the mobile version of the site will also become more optimized. We have prioritized the desktop version, as the stats overlay is the only feature available for now.</p>
		</div>
	</div>
</div>