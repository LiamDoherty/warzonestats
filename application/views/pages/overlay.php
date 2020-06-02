<script src="<?php echo base_url(); ?>js/overlay-refresh.js"></script>

<video loop autoplay>
  <source src=<?php echo base_url('Src/Overlay.webm'); ?> type="video/webm">
</video><div id="kills"><?php echo $kills; ?></div>
<div id="wins"><?php echo $wins; ?></div>
<div id="totalKills"><?php echo $totalKills; ?></div>
<div id="totalWins"><?php echo $totalWins; ?></div>
<div id="mostRecentMatchId" class="hidden"><?php echo $mostRecentMatchId; ?></div>
<div id="userName" class="hidden"><?php echo $username;?></div>
<div id="platform" class="hidden"><?php echo $platform;?></div>