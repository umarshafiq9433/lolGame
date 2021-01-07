<?php 

/**
 * Class for members
 */

class Member{

	/**
	 * Change Account information (lol summoner name, lol password etc...)
	 */
	public function accountChange(){
		
		// If user want to change his informations
		if(isset($_POST['account_save']))
		{
			require 'Database.php';
			
			$order_id = $_REQUEST['order_id'];
			if($order_id!="")
			{
			    // Update database with his informations
			$req = $db->prepare("UPDATE orders SET lol_server = ?, lol_summoner = ?, lol_account = ?, lol_password = ? WHERE order_id = ?");
			$req->execute(array($_POST['server'], $_POST['summonername'], $_POST['accountname'], $_POST['accountpassword'], $order_id));
			$_SESSION['account_information'] = 1;
			
			// Update current league, LP
			$update = new Member();
			$update->updateOrderLeague();
			}
			else 
			{

			// Update database with his informations
			$req = $db->prepare("UPDATE orders SET lol_server = ?, lol_summoner = ?, lol_account = ?, lol_password = ? WHERE user_id = ?");
			$req->execute(array($_POST['server'], $_POST['summonername'], $_POST['accountname'], $_POST['accountpassword'], $_SESSION['id']));
			$_SESSION['account_information'] = 1;
			
			// Update current league, LP
			$update = new Member();
			$update->updateOrderLeague();
			}
echo "<script>window.location='index.php'</script>";
			//header('Location: index.php');
		}

	}

	/**
	 * Return All orders of the cutsomer
	 */
	public function allOrders()
	{
		require 'Database.php';

		$req = $db->prepare("SELECT lol_server,lol_summoner,lol_account,lol_password,order_id, order_queue, order_boost, order_type, order_wins, start_league, start_division, desired_league, desired_division, order_date, DATE_FORMAT(order_date, '%d/%m/%Y') AS date, order_price, order_status, order_pause FROM orders WHERE user_id = ? ORDER BY order_status");
		$req->execute(array($_SESSION['id']));

		return $req->fetchAll();
	}

	/**
	 * Update current_league
	 */
	public function updateOrderLeague(){
		// Get order details 
		$order = new Order();
		$order = $order->getOrder();

		// Update his current league before he connect
		$api = new APIcall();
		$api->updateCurrentLeague($order['lol_summoner'], $order['lol_server'], $order['order_queue']);
	}

}


?>