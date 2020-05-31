$(document).ready(function () {
	setTimeout(UpdateOverlayAJAX, 300000);
	//RegisterTesting();
});

function UpdateOverlayAJAX() {
	var kills = $("#kills").text();
	var mostRecentMatchId = $("#mostRecentMatchId").text();
	var username = $('#userName').text();
	var platform = $('#platform').text();

	$.ajax({
		url: '/update_overlay',
		type: 'POST',
		data: {
			kills: kills,
			mostRecentMatchId: mostRecentMatchId,
			username: username,
			platform: platform
		},
		error: function () {
			alert('Something is wrong');
		},
		success: function (data) {
			var jsonResponse = $.parseJSON(data)
			console.log(jsonResponse.kills);
			$('#kills').text(jsonResponse.kills);
			$('#mostRecentMatchId').text(jsonResponse.mostRecentMatchId);
			setTimeout(UpdateOverlayAJAX, 300000);
		}
	});
}


function RegisterTesting() {
	$('.btn').click(function () { //Fake some kill data on front end also woth match id, initial run test witha match id to get the base kills
		//First run force start id 10358638857626709554 end id 12965382139924755474
		//base kills 44
		var kills = $("#kills").text();
		var mostRecentMatchId = $("#mostRecentMatchId").text();
		var username = $('#userName').text();
		var platform = $('#platform').text();
		var wins = $('#wins').text();

		$.ajax({
			url: '/update_overlay',
			type: 'POST',
			data: {
				kills: kills,
				wins: wins,
				mostRecentMatchId: mostRecentMatchId,
				username: username,
				platform: platform
			},
			error: function () {
				alert('Something is wrong');
			},
			success: function (data) {
				var jsonResponse = $.parseJSON(data)
				console.log(jsonResponse.kills);
				$('#kills').text(jsonResponse.kills);
				$('#wins').text(jsonResponse.wins);
				$('#mostRecentMatchId').text(jsonResponse.mostRecentMatchId);
				setTimeout(UpdateOverlayAJAX, 300000);
			}
		});
	});
}
