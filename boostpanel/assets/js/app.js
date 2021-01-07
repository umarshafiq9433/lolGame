function showWin() {
	var number = $( '#wins_number' ).val();
	document.getElementById( 'wins-value' ).innerHTML = number;
}

function netWins() {
	var number = $( '#net_wins_number' ).val();
	document.getElementById( 'net-wins-value' ).innerHTML = number;
}
/**
 * Function change images
 */
function changeImage( image, division_id = false ) {
	// Get id of the select
	var e = document.getElementById( image.id );
	var selected = e.options[ e.selectedIndex ].value;
	var currentDivision = false;
	var regionArray = [ 'NA', 'OCE', 'EUW', 'TR', 'EUNE' ];
	if ( division_id ) {
		currentDivision = document.getElementById( division_id ).value;
		selected += currentDivision;
	} else if ( selected !== 'Unranked' && !( jQuery.inArray(selected, regionArray) !== -1 ) ) { selected += 'I'; }
	// If it's server, change server img
	if ( selected === 'NA' || selected === 'OCE' || selected === 'EUW' || selected === 'TR' || selected === 'EUNE' ) {
		// Change img
		var img = document.getElementById( image.id + "_img" );
		img.src = "/boostpanel/assets/img/regions/" + "region" + ".png";
	} else { // Else, change league
		// Change img
		var img = document.getElementById( image.id + "_img" );
		img.src = "/boostpanel/assets/img/tiers/" + selected + ".png";
	}
	// If master Or challenger, remove divisions
	if ( selected === 'Master' || selected === 'Challenger' ) {
		$( "#desired_division" ).prop( 'disabled', true );
	} else {
		$( "#desired_division" ).prop( 'disabled', false );
	}
}
/**
 * Function AJAX for price
 */
function getPrice( boost, isDuo = 0 ) {
	var _getPriceUrl = '/boostpanel/assets/getprice.php';
	// Ajax call for division Boost
	if ( boost === 'division' ) {
		try {
			changeImage( { id : 'current_rank' }, 'current_division' );
			changeImage( { id : 'desired_rank' }, 'desired_division' );
		} catch (_err) {}
		var price = 0;
		var duo = 0;
		var current_league = document.getElementById( "current_rank" ).value;
		var current_division = document.getElementById( "current_division" ).value;
		var desired_league = document.getElementById( "desired_rank" ).value;
		var desired_division = document.getElementById( "desired_division" ).value;
		var current_rank = current_league + " " + current_division;
		var desired_rank = desired_league + " " + desired_division;
		if ( desired_league == "Master" || desired_league == "Challenger" ) {
			desired_rank = desired_league;
		}
		var isDuo = '';
		var server = '';
		try {
			isDuo = document.getElementById( 'duo' ).checked;
			server = document.getElementById( 'server' ).value;
		} catch ( _err ) {}
		if ( isDuo == true ) {
			duo = 1;
		}
		var dataString = 'type=division&current_rank=' + current_rank + "&desired_rank=" + desired_rank + "&server=" + server + "&isDuo=" + duo;
		$.ajax( {
			type: 'POST',
			data: dataString,
			url: _getPriceUrl,
			success: function( data ) {
				if ( data == 0 ) {
					document.getElementById( 'price' ).innerHTML = "This boost is not possible.";
				} else {
					document.getElementById( 'price' ).innerHTML = data + " $";
					document.getElementById( 'review_type' ).innerHTML = "Division";
					document.getElementById( 'review_boost' ).innerHTML = current_rank + " to " + desired_rank;
					document.getElementById( 'review_server' ).innerHTML = server;
					document.getElementById( 'review_price' ).innerHTML = data;
				}
			}
		} );
	} else if ( boost === 'win' ) {
		try { changeImage( { id : '__win_rank' }, '__win_division' ); } catch (_err) {}
		try { changeImage( { id : 'current_rank' }, 'current_division' ); } catch (_err) {}
		var price = 0;
		var duo = 0;
		if ( document.getElementById( '__win_rank' ) ) {
			var current_league = document.getElementById( '__win_rank' ).value;
		} else var current_league = document.getElementById( 'current_rank' ).value;

		if ( document.getElementById( '__win_division' ) ) {
			var current_division = document.getElementById( '__win_division' ).value;
		} else var current_division = document.getElementById( 'current_division' ).value;

		if ( document.getElementById( 'net_wins_number' ) ) {
			var wins = document.getElementById( 'net_wins_number' ).value;
		} else var wins = document.getElementById( 'wins_number' ).value;

		var current_rank = current_league + ' ' + current_division;
		var isDuo = '';
		var server = '';
		try {
			isDuo = document.getElementById( 'duo' ).checked;
			server = document.getElementById( 'server' ).value;
		} catch ( _err ) {}
		if ( isDuo == true ) {
			duo = 1;
		}
		var dataString = 'type=win&current_rank=' + current_rank + "&desired_rank=" + desired_rank + "&server=" + server + "&isDuo=" + duo + "&wins_number=" + wins;
		$.ajax( {
			type: 'POST',
			data: dataString,
			url: _getPriceUrl,
			beforeSend: function( data ) {
				try { document.getElementById( 'wins_number' ).disabled = true; } catch ( _err ){}
				try { document.getElementById( 'net_wins_number' ).disabled = true; } catch ( _err ){}

			},
			success: function( data ) {
				try { document.getElementById( 'wins_number' ).disabled = false; } catch ( _err ){}
				try { document.getElementById( 'net_wins_number' ).disabled = false; } catch ( _err ){}

				if ( data == 0 ) {
					document.getElementById( 'price' ).innerHTML = 'This boost is not possible.';
				} else {
					data = parseFloat( data ).toFixed( 2 );
					document.getElementById( 'price' ).innerHTML = data + ' $';
					document.getElementById( 'review_type' ).innerHTML = 'Net Wins';
					document.getElementById( 'review_boost' ).innerHTML = current_rank + ' - ' + wins + ' Games';
					document.getElementById( 'review_server' ).innerHTML = server;
					document.getElementById( 'review_price' ).innerHTML = data;
				}
			}
		} );
	} else if ( boost === 'placement' ) {
		var price = 0;
		var duo = 0;
		if ( document.getElementById( '__placement_rank' ) ) {
			var current_rank = document.getElementById( '__placement_rank' ).value;
		} else var current_rank = document.getElementById( 'current_rank' ).value;
		var wins = document.getElementById( 'wins_number' ).value;
		var isDuo = '';
		var server = '';
		try {
			isDuo = document.getElementById( 'duo' ).checked;
			server = document.getElementById( 'server' ).value;
		} catch ( _err ) {}
		if ( isDuo == true ) {
			duo = 1;
		}
		var dataString = 'type=placement&current_rank=' + current_rank + '&server=' + server + '&isDuo=' + duo + '&wins_number=' + wins;
		$.ajax( {
			type: 'POST',
			data: dataString,
			url: _getPriceUrl,
			beforeSend: function( data ) {
				try { document.getElementById( 'wins_number' ).disabled = true; } catch ( _err ){}

			},
			success: function( data ) {
				try { document.getElementById( 'wins_number' ).disabled = false; } catch ( _err ){}

				if ( data == 0 ) {
					document.getElementById( 'price' ).innerHTML = "This boost is not possible.";
				} else {
					data = parseFloat( data ).toFixed( 2 );
					document.getElementById( 'price' ).innerHTML = data + ' $';
					document.getElementById( 'review_type' ).innerHTML = 'Placement';
					document.getElementById( 'review_boost' ).innerHTML = current_rank + ' - ' + wins + ' Games';
					document.getElementById( 'review_server' ).innerHTML = server;
					document.getElementById( 'review_price' ).innerHTML = data;
				}
			}
		} );
	}
}