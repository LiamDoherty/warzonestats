<script src="<?php echo base_url(); ?>js/overlay-refresh.js"></script>

<?php 
	if(isset($bgType))
	{
		if($bgType == "green"){
			echo '<body style="background-color:#00b140">';
		}
	}
?>

<div class="container">
	<div class="statsContainer">
		<video loop autoplay muted class="video">
			<source src=<?php echo base_url('Src/Overlay.webm'); ?> type="video/webm">
		</video>
		<div class="statsWrapper">
			<div class="stats">
				<div id="kills" class="statMax">
					<div class="statWrapper">
						<div class="innerStat">
							<div id="killStat" class="stat"><?php echo $kills; ?></div>
						</div>
					</div>
				</div>
				<div id="wins" class="statMax">
					<div class="statWrapper">
						<div class="innerStat">
							<div id="winStat" class="stat"><?php echo $wins; ?></div>
						</div>
					</div>
				</div>
				<div id="totalKills" class="statMax">
					<div class="statWrapper">
						<div class="innerStat">
							<div class="stat"><?php echo $totalKills; ?></div>
						</div>
					</div>
				</div>
				<div id="totalWins" class="statMax">
					<div class="statWrapper">
						<div class="innerStat">
							<div class="stat"><?php echo $totalWins; ?></div>
						</div>
					</div>
				</div>
			</div>
			<div id="mostRecentMatchId" class="hidden"><?php echo $mostRecentMatchId; ?></div>
			<div id="userName" class="hidden"><?php echo $username;?></div>
			<div id="platform" class="hidden"><?php echo $platform;?></div>
		</div>
	</div>
</div>
