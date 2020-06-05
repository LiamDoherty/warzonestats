$(document).ready(function () {
	setTimeout(UpdateOverlayAJAX, 600000);
});

function UpdateOverlayAJAX() {
	var kills = $("#killStat").text();
	var mostRecentMatchId = $("#mostRecentMatchId").text();
	var username = $('#userName').text();
	var platform = $('#platform').text();
	var wins = $('#winStat').text();

	$.ajax({
		url: '/update_dailyOverlay',
		type: 'POST',
		data: {
			kills: kills,
			wins: wins,
			mostRecentMatchId: mostRecentMatchId,
			username: username,
			platform: platform
		},
		error: function () {
		},
		success: function (data) {
			var jsonResponse = $.parseJSON(data)
			$('#killStat').text(jsonResponse.kills);
			$('#winStat').text(jsonResponse.wins);
			$('#mostRecentMatchId').text(jsonResponse.mostRecentMatchId);
			setTimeout(UpdateOverlayAJAX, 600000);
		}
	});
}