<?php

require 'config.php'; // Get Variables

/**
 * Get price
 */

$tiers = array(
    'Iron IV' => 0,
    'Iron III' => 1,
    'Iron II' => 2,
    'Iron I' => 3,
    'Bronze IV' => 4,
    'Bronze III' => 5,
    'Bronze II' => 6,
    'Bronze I' => 7,
    'Silver IV' => 8,
    'Silver III' => 9,
    'Silver II' => 10,
    'Silver I' => 11,
    'Gold IV'   => 12,
    'Gold III'   => 13,
    'Gold II'   => 14,
    'Gold I'   => 15,
    'Platinum IV' => 16,
    'Platinum III' => 17,
    'Platinum II' => 18,
    'Platinum I' => 19,
    'Diamond IV'  => 20,
    'Diamond III'  => 21,
    'Diamond II'  => 22,
    'Diamond I'  => 23,
    'Master' => 24,
    'Grandmaster' => 24,
    'Challenger' => 25,
);

$lp = array(
    '0-20'  => 0,
    '21-40' => 1,
    '41-60' => 2,
    '61-80' => 3,
    '81-100' => 4,
);

// Cost of LP for a division
$lpCost = array(
    0, 4, 8, 12, 16, 20,
);

	// Division prices
	if( $_POST[ 'type' ] === 'division' ) {
		$costs = array(
		    $Iron_4, $Iron_3, $Iron_2, $Iron_promo, // Iron IV, Iron III, Iron II, Iron I -> Bronze IV
		    $Bronze_4, $Bronze_3, $Bronze_2, $Bronze_promo, // Bronze IV, Bronze III, Bronze II, Bronze I -> Silver IV
		    $Silver_4, $Silver_3, $Silver_2, $Silver_promo, // Silver IV, Silver III, Silver II, Silver I -> Gold IV
		    $Gold_4, $Gold_3, $Gold_2, $Gold_promo, // Gold IV, Gold III, Gold II, Gold I -> Platinum IV
		    $Platinum_4, $Platinum_3, $Platinum_2, $Platinum_promo, // Platinum IV, Platinum III, Platinum II, Platinum I -> Diamond IV
		    $Diamond_4, $Diamond_3, $Diamond_2, $Diamond_promo,  // Diamond IV, Diamond III, Diamond II, Diamond I -> Master I
		    $Challenger, // Challenger price
		);

		// Get variables
		$actual = $_POST[ 'current_rank' ];
		$desired = $_POST[ 'desired_rank' ];
		$leaguepoints = $_POST['current_leaguePoints'];
		$actual = $tiers[$actual];
		$desired = $tiers[$desired];
		$leaguepoints = $lp[$leaguepoints];

		// Get LP percentage
		$priceLP = $lpCost[$leaguepoints];

	$price = 0;
	if ($actual < $desired)
	{
		for ($i = $actual; $i < $desired; $i++)
		{
			$price += $costs[$i];
		}
		if($_POST['current_league'] === $_POST['desired_league'])
		{
			$price = $price - ($price * ($priceLP / 100));
			echo $price;
		}else{
			echo $price;
		}

	}else{
		echo $price;
	}

	} elseif( $_POST[ 'type' ] === 'win' ) // Win Boost
	{
		$costs = array(
		    $wins_Iron_4, $wins_Iron_3, $wins_Iron_2, $wins_Iron_1,
		    $wins_Bronze_4, $wins_Bronze_3, $wins_Bronze_2, $wins_Bronze_1,
		    $wins_Silver_4, $wins_Silver_3, $wins_Silver_2, $wins_Silver_1,
		    $wins_Gold_4, $wins_Gold_3, $wins_Gold_2, $wins_Gold_1,
		    $wins_Platinum_4, $wins_Platinum_3, $wins_Platinum_2, $wins_Platinum_1,
		    $wins_Diamond_4, $wins_Diamond_3, $wins_Diamond_2, $wins_Diamond_1,
		);

		// $actual = $_POST['current_league'] . ' ' . $_POST['current_division'];
		$actual = $_POST[ 'current_rank' ];
		$actual = $tiers[ $actual ];
		$amount = $_POST[ 'wins_number' ];

		$price = $costs[ $actual ] * $amount;
		echo $price;

	} elseif( $_POST['type'] === 'placement' ) // Placement Boost
	{
		$tiers = array(
		    'Unranked' => 0,
		    'Iron' => 1,
		    'Bronze' => 2,
		    'Silver' => 3,
		    'Gold' => 4,
		    'Platinum' => 5,
		    'Diamond' => 6,
		    'Master' => 7,
		    'Challenger' => 8,
		);

			$costs = array(
			    $placement_Unranked, $placement_Iron, $placement_Bronze, $placement_Silver, $placement_Gold,
			    $placement_Platinum, $placement_Diamond, $placement_Master, $placement_Challenger,
			);

		$actual = $_POST[ 'current_rank' ];
		$actual = $tiers[ $actual ];
		$amount = $_POST[ 'wins_number' ];

		$price = $costs[ $actual ] * $amount;
		echo $price;
	}
