<script src="<?php echo base_url(); ?>js/home.js"></script>

<div class="landing-wrapper bg-primary">
	<h2>Warzone Stats Overlay!</h2>
	<p>Use this stats overlay to display your warzone stats while streaming</p>

	<div class="mainContainer">
		<div class="form">
			<?php echo form_open("generate"); ?>
			<div class="input">
				<p>Input your username here</p>
				<p><input class="form-control mr-sm-2" type="text" placeholder="Username" name="username"
						value=<?php echo urldecode($username) ?>></p>

				<p> Select your platform</p>
				<p>
					<fieldset>
						<select class="custom-select" name="platform">
							<option>Select Your Platform</option>
							<option <?php if($platform=="psn"): ?>selected="selected" <?php endif;?> value="psn">
								Playstation</option>
							<option <?php if($platform=="xbl"): ?>selected="selected" <?php endif;?> value="xbl">Xbox
							</option>
							<option <?php if($platform=="steam"): ?>selected="selected" <?php endif;?> value="steam">
								Steam</option>
							<option <?php if($platform=="uno"): ?>selected="selected" <?php endif;?> value="uno">
								Activision</option>
							<option <?php if($platform=="battle"): ?>selected="selected" <?php endif;?> value="battle">
								Battlenet</option>
						</select>
					</fieldset>
				</p>
				<p>Overlay Type</p>
				<p>
					<fieldset>
						<select class="custom-select overlay-type" name="overlayType">
							<option <?php if($overlayType=="daily"): ?>selected="selected" <?php endif;?> value="daily">
								Daily Stats</option>
							<option <?php if($overlayType=="summary"): ?> selected="selected" <?php endif; ?>
								value="summary">Total & Daily Stats</option>
						</select>
					</fieldset>
				</p>
				<button id="submit-buttons" class="btn btn-success" type="submit" ​​​​​>Generate Link</button>
				<br />

			</div>
			<div>
				</form>
			</div>
		</div>
		<div class="previewWrapper">
			<div class="preview-bg">
				<div class="preview">
					<div>
						<img class="dailyPreview" src=<?php echo base_url('Src/DailyPreview.png'); ?>
							alt="warzone-daily-stats-overlay">
					</div>
					<div>
						<img class="summaryPreview" src=<?php echo base_url('Src/OverlayPreview.png'); ?>
							alt="warzone-summary-stats-overlay">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div><?php 
				$url = 'overlay/';
				if(isset($overlayType))
				{
					if($overlayType == "summary"){
						$url = 'overlay/';
					}
					else if($overlayType == "daily"){
						$url = 'dailyoverlay/';
					}
				}
				if(isset($confirmed) && $confirmed)
				{
					?>
		<div class="sessionStats">
			<label for="link">Session Stats:</label>
			<input type="text" class="form-control" id="fname" name="fname"
				value=<?php echo base_url().$url.$username.'/'.$platform?>>
		</div>
		<?php
				}
				else if(isset($confirmed) && !$confirmed)
				{
					?>
		<div class="alert alert-danger sessionStats">
			User not found, please enter a valid username and platform..
		</div>
		<?php
				} ?>

	<!-- <p>Generate link isn't work at the moment. A fix is being worked on. In the meantime fill in your data to the template links below to get your overlay.</p>
	<p>Platforms are as follows: Playstation = psn, Xbox = xbl, Steam = steam, Activision = uno, Battlenet = battle.</p>
	<p>Daily Stats: https://warzonestats.net/dailyoverlay/username/platform</p>
	<p>Total & Daily: https://warzonestats.net/overlay/username/platform</p>
	<p>Example: https://warzonestats.net/overlay/tasty_lempons/psn</p> -->
	</div>
</div>
