<?php 

/**
 * Orders Class
 */

class Order{

	/**
	 * Get all the Orders for boosters
	 */
	public function allOrders(){
		require 'Database.php';
		$req = $db->query("SELECT orders.order_id, booster_id, order_price, order_status, users.username
		 FROM orders 
		 INNER JOIN users 
		 ON booster_id = users.id
		 WHERE status = 'Looking for booster'");
		$orders = $req->fetchAll();

		return $orders;
	}

	/**
	 * Admin orders :
	 * Get orders where booster are assigned
	 */
	public function runingOrders(){

		require 'Database.php';

		$req = $db->prepare("SELECT orders.order_id, orders.booster_id, orders.order_price, orders.order_status, users.username
		 FROM orders
		 INNER JOIN users
		 ON orders.booster_id = users.id
		 WHERE order_status = ?");
		$req->execute(array("In progress"));
		$orders = $req->fetchAll();
		
		return $orders;
	}

	/**
	 * Admin, boosters orders :
	 * Get orders where booster are not assigned (free order)
	 */
	public function waitingOrders(){

		require 'Database.php';

		$req = $db->prepare("SELECT order_id, start_league, lol_server, start_division, desired_league, desired_division, order_wins, order_price, order_status, order_queue, order_boost, order_type, DATE_FORMAT(order_date, '%d/%m/%Y') AS order_date FROM orders WHERE booster_id = ? ORDER BY order_date");
		$req->execute(array("0"));
		$waitOrders = $req->fetchAll();

		return $waitOrders;

	}

	/**
	 * Admin orders :
	 * Get finished orders
	 */
	public function finishedOrders(){

		require 'Database.php';

		$req = $db->prepare("SELECT orders.order_id, order_queue, order_boost, start_league, start_division, desired_league, desired_division, DATE_FORMAT(order_date, '%d/%m/%Y') AS date, order_price, order_wins, lol_summoner, users.username, boosters.paypal, boosters.percentage, booster_id
			FROM orders 
			INNER JOIN users 
			ON users.id = orders.booster_id 
			INNER JOIN boosters 
			ON users.email = boosters.email 
			WHERE order_status = ? AND booster_payed = ?
			");
		$req->execute(array("Finished", "0"));
		return $req->fetchAll();

	}

	/**
	 * Get specific order
	 */
	public function getOrder()
	{
		require 'Database.php';

		$order = $db->prepare("SELECT order_id, lol_account, lol_password, lol_summoner, lol_server, start_league, start_division,
			current_league, current_division, current_lp, desired_league, desired_division, order_queue, order_boost, order_wins, order_type, order_notes, order_date,
			order_price, order_status, order_pause
			FROM orders 
			WHERE user_id = ?");
		$order->execute(array($_SESSION['id']));
		return $order->fetch();
	}

	/**
	 * Total revenue booster
	 */
	
	public function totalRevenue(){

		require 'Database.php';

		$req = $db->prepare("SELECT orders.order_price, boosters.percentage 
			FROM orders 
			INNER JOIN users 
			ON orders.booster_id = users.id 
			INNER JOIN boosters 
			ON users.email = boosters.email 
			WHERE order_status = ? AND booster_id = ? AND booster_payed = ?");
		$req->execute(array("Finished", $_SESSION['id'], "1"));
		$totalRevenue = $req->fetchAll();
		if(sizeof($totalRevenue) != 0)
		{
			$percentage = $totalRevenue[0]['percentage'];
			$price = 0;
			for($i = 0 ; $i < sizeof($totalRevenue) ; $i++)
			{
				$price += $totalRevenue[$i]['order_price'] * ($percentage / 100);
			}
			return $price;
		}else{
			return "0";
		}

	}

	/**
	 * Payment pendin booster
	 */
	public function paymentPending()
	{
		require 'Database.php';

		$req = $db->prepare("SELECT orders.order_price, boosters.percentage 
			FROM orders 
			INNER JOIN users 
			ON orders.booster_id = users.id 
			INNER JOIN boosters 
			ON users.email = boosters.email 
			WHERE order_status = ? AND booster_id = ? AND booster_payed = ?");
		$req->execute(array("Finished", $_SESSION['id'], "0"));
		$pending = $req->fetchAll();
		if(sizeof($pending) != 0)
		{
			$percentage = $pending[0]['percentage'];
			$price = 0;
			for($i = 0 ; $i < sizeof($pending) ; $i++)
			{
				$price += $pending[$i]['order_price'] * ($percentage / 100);
			}
			return $price;
		}else{
			return "0";
		}
	}

	/**
	 * Get the number of orders
	 */
	public function orderCount()
	{
		require 'Database.php';

		$req = $db->prepare("SELECT COUNT(*) FROM orders WHERE booster_id = ? AND order_status = ?");
		$req->execute(array($_SESSION['id'], "In progress"));
		return $req->fetch();
	}

	/**
	 * Get Order Booster
	 */
	
	public function getOrderBooster($order_id){
		require 'Database.php';

		$order = $db->prepare("SELECT orders.order_id, lol_account, lol_password, lol_summoner, lol_server, start_league, start_division,
			current_league, current_division, current_lp, desired_league, desired_division, order_queue, order_boost, order_wins, order_type, order_notes, order_date, options.flash,
			order_price, order_status, order_pause
			FROM orders 
			INNER JOIN options 
			ON options.order_id = orders.order_id
			WHERE orders.order_id = ? AND orders.booster_id = ?");
		$order->execute(array($order_id, $_SESSION['id']));
		return $order->fetch();
	}

	/**
	 * Progress orders boosters
	 */
	public function getOrderIDBooster(){
		require 'Database.php';

		$order = $db->prepare("SELECT order_id FROM orders WHERE booster_id = ? AND order_status = ?");
		$order->execute(array($_SESSION['id'], "In progress"));
		return $order->fetchAll();
	}

	/**
	 * Completer orders
	 */
	public function completedOrder(){
		require 'Database.php';

		$req = $db->prepare("SELECT order_id, start_league, start_division, desired_league, desired_division, order_price, order_boost, order_type, order_queue, DATE_FORMAT(order_date, '%d/%m/%Y') AS order_date, order_wins, booster_payed FROM orders WHERE booster_id = ? AND order_status = ? ORDER BY booster_payed");
		$req->execute(array($_SESSION['id'], "Finished"));
		return $req->fetchAll();
	}

}

 ?>