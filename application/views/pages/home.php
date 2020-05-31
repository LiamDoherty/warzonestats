<div class="landing-wrapper">
	<h2>Warzone Stats Overlay!</h2>
	<p>Use this stats overlay to display your game stats</p>

<?php echo validation_errors(); ?>

<?php echo form_open("overlay"); ?>
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
	</div>
		<button id="submit-buttons" class="btn btn-success" type="submit" ​​​​​>Generate Link</button>
	</form>
</div>
