<?php 

/**
 * Do all the modifications on admin dashboard
 */
class Booster{

	/**
	 * Add booster if the user want to add booster
	 */
	public function addBooster()
	{
		// When addBooster save button is submit
		if(isset($_POST['booster_save']))
		{
			require 'Database.php'; // Access to database
			// Insert user
			$req = $db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, type = ?");
			$req->execute(array($_POST['username'], hash('SHA512', $_POST['password']), $_POST['email'], 'booster'));
			// Insert booster
			$bs = $db->prepare("INSERT INTO boosters SET email = ?, paypal = ?, percentage = ?, rank = ?");
			$bs->execute(array($_POST['email'], $_POST['paypal'], $_POST['percentage'], $_POST['rank']));
			$_SESSION['addBooster'] = 1;
		}
	}

	/**
	 * Get all boosters from database
	 */
	public function Boosters()
	{
		require 'Database.php'; // Access to database
		$req = $db->query("SELECT username, users.email, boosters.email, type, paypal, percentage, rank 
			FROM users 
			INNER JOIN boosters 
			ON users.email = boosters.email");
		$boosters = $req->fetchAll();

		return $boosters;
	}

}

 ?>