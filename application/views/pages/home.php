<script src="<?php echo base_url(); ?>js/home.js"></script>

<div class="landing-wrapper">
	<h2>Warzone Stats Overlay!</h2>
	<p>Use this stats overlay to display your game stats</p>

	<?php echo validation_errors(); ?>
	<div class="mainContainer">
		<div class="form">
			<?php echo form_open("generate"); ?>
			<div class="input">
				<p>Input your username here</p>
				<p><input class="form-control mr-sm-2" type="text" placeholder="Username" name="username"></p>

				<p> Select your platform</p>
				<p>
					<fieldset>
						<select class="custom-select" name="platform">
							<option selected="">Select Your Platform</option>
							<option value="psn">Playstation</option>
							<option value="xbl">Xbox</option>
							<option value="steam">Steam</option>
							<option value="uno">Activision</option>
							<option value="battle">Battlenet</option>
						</select>
					</fieldset>
				</p>
				<p>Overlay Type</p>
				<p>
					<fieldset>
						<select class="custom-select overlay-type" name="overlayType">
							<option selected="" value="daily">Daily Stats</option>
							<option value="summary">Total & Daily Stats</option>
						</select>
					</fieldset>
				</p>
				<button id="submit-buttons" class="btn btn-success" type="submit" ​​​​​>Generate Link</button>
				<br />
				<div><?php 
				$valid = isset($confirmed);
				$url = 'overlay/';
				if(isset($overlayType))
				{
					if($overlayType == "summary"){
						$url = 'overlay/';
					}
					else if($overlayType == "daily"){
						$url = 'dailyOverlay/';
					}
				}
				if($valid && $confirmed)
				{
					?>
					<div class="sessionStats">
						<label for="link">Session Stats:</label>
						<input type="text" class="form-control" id="fname" name="fname"
							value=<?php echo base_url().$url.$username.'/'.$platform?>>
					</div>
					<?php
				}
				else if($valid && !$confirmed)
				{
					?>
					<div class="alert alert-danger sessionStats">
						User not found, please enter a valid username and platform..
					</div>
					<?php
				} ?>
				</div>
			</div>
			<div>
				</form>
			</div>
		</div>
		<div class="previewWrapper">
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
