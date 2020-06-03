<script src="<?php echo base_url(); ?>js/overlay-refresh.js"></script>

<div class="container">
	<div class="statsContainer">
		<video loop autoplay class="video">
			<source src=<?php echo base_url('Src/Overlay.webm'); ?> type="video/webm">
		</video>
		<div class="statsWrapper">
			<div class="stats">
				<div id="kills" class="stat"><?php echo $kills; ?></div>
				<div id="wins" class="stat"><?php echo $wins; ?></div>
				<div id="totalKills" class="stat"><?php echo $totalKills; ?></div>
				<div id="totalWins" class="stat"><?php echo $totalWins; ?></div>
			</div>
			<div id="mostRecentMatchId" class="hidden"><?php echo $mostRecentMatchId; ?></div>
			<div id="userName" class="hidden"><?php echo $username;?></div>
			<div id="platform" class="hidden"><?php echo $platform;?></div>
		</div>
	</div>
</div>
