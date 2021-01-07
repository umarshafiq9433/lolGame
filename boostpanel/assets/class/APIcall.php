<?php 

/**
 * Call for riot API
 */

class APIcall{

	public function updateCurrentLeague($name, $region, $type){

		// Use region for API
		switch($region)
		{
			default:
				$region = 'euw1';
				break;
			case 'EUW':
				$region = 'euw1';
				break;
			case 'EUNE':
				$region = 'eun1';
				break;
			case 'NA':
				$region = 'na';
				break;
			case 'OCE':
				$region = 'oce1';
				break;
			case 'TR':
				$region = 'tr1';
				break;
			
		}

		// Change queueType for API
		switch($type)
		{
			case 'Solo/Duo (5v5)':
				$type = 'RANKED_SOLO_5x5';
				break;
			case 'Flex (5v5)':
				$type = 'RANKED_FLEX_SR';
				break;
			case 'Flex (3v3)':
				$type = 'RANKED_FLEX_TT';
				break;
			default:
				$type = 'RANKED_SOLO_5x5';
				break;
		}

		// Call RIOT API
		$api = new riotapi($region);

		// Get the ID of the customer
		$summoner = $api->getSummonerByName($name);
		if(sizeof($summoner) == 1)
		{
			// Summoner name false
		}else{
			$summoner = $summoner['id']; 
			$current = $api->getLeaguePosition($summoner);
			
			if(sizeof($current) != 0)
			{
				for($i = 0 ; $i < sizeof($current) ; $i++)
				{
					if($current[$i]['queueType'] === $type)
					{
						$array = $i;
					}else{
						$league = "Unranked";
						$division = "";
						$lp = "";
					}
				}
				$league = ucfirst(strtolower($current[$array]['tier']));
				$division = $current[$array]['rank'];
				$lp = $current[$array]['leaguePoints'];
			}else{
				$league = "Unranked";
				$division = "-";
				$lp = "0";
			}

			require 'Database.php';

			// Update current league and LP
			$req = $db->prepare("UPDATE orders SET current_league = ?, current_division = ?, current_lp = ? WHERE user_id = ?");
			$req->execute(array($league, $division, $lp, $_SESSION['id']));
		}


	}
	
	
		
	public function getleagueinfo($name, $region, $type){
 

		// Change queueType for API
		switch($type)
		{
			case 'Solo/Duo (5v5)':
				$type = 'RANKED_SOLO_5x5';
				break;
			case 'Flex (5v5)':
				$type = 'RANKED_FLEX_SR';
				break;
			case 'Flex (3v3)':
				$type = 'RANKED_FLEX_TT';
				break;
			default:
				$type = 'RANKED_SOLO_5x5';
				break;
		}

		// Call RIOT API
		$api = new riotapi($region);

		// Get the ID of the customer
		$summoner = $api->getSummonerByName($name);
		if(sizeof($summoner) == 1)
		{
			// Summoner name false
		}else{
			$summoner = $summoner['id']; 
			$current = $api->getLeaguePosition($summoner); 
			if(sizeof($current) != 0)
			{
				for($i = 0 ; $i < sizeof($current) ; $i++)
				{
					if($current[$i]['queueType'] === $type)
					{
						$array = $i;
					}else{
						$league = "Unranked";
						$division = "";
						$lp = "";
					}
				}
				$league = ucfirst(strtolower($current[$array]['tier']));
				$division = $current[$array]['rank'];
				$lp = $current[$array]['leaguePoints'];
			}else{
				$league = "Unranked";
				$division = "-";
				$lp = "0";
			}
			if($region == "na1")
			{
			    $regionval="NA";
			}
			else if($region == "euw1")
			{
			    $regionval="EUW";
			}
			else if($region == "eun1")
			{
			    $regionval="EUNE";
			}
			else if($region == "oc1")
			{
			    $regionval="OCE";
			}
			else if($region == "la1")
			{
			    $regionval="LAN";
			}
			else if($region == "la2")
			{
			    $regionval="LAS";
			}
			
			$data = array("current_league"=>$league,"current_division"=>$division,"current_lp"=>$lp,"summoner"=>$name,"region"=>$regionval);
			
			return $data;
			 
		}


	}

}

?>