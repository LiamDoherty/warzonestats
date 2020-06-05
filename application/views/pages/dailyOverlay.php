<script src="<?php echo base_url(); ?>js/dailyOverlay-refresh.js"></script>

<div class="container">
	<div class="statsContainer">
		<video loop autoplay muted class="video">
			<source src=<?php echo base_url('Src/OverlayDaily.webm'); ?> type="video/webm">
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
			</div>
			<div id="mostRecentMatchId" class="hidden"><?php echo $mostRecentMatchId; ?></div>
			<div id="userName" class="hidden"><?php echo $username;?></div>
			<div id="platform" class="hidden"><?php echo $platform;?></div>
		</div>
	</div>
</div>