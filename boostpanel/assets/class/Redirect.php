<?php

/**
 * Redirect user in member area, or booster area, or admin area
 * See if cookies is here, if so, redirect user
 */

class Redirect{

	private $host = 'https://smurfbuddy.com/boostpanel'; // URL to redirect

	/**
	 * If there's cookie, initiate sessions
	 */
	private function getSessions(){
		if(isset($_COOKIE['remember']))
		{
			require 'Database.php';
			// Verify if token exist
			$req = $db->prepare("SELECT token, type, id FROM users WHERE token = ?");
			$req->execute(array($_COOKIE['remember']));
			$cookie = $req->rowCount();

			if($cookie == 1)
			{
				// If cookie true
				$cookie = $req->fetch();
				$_SESSION['type'] = $cookie['type'];
				$_SESSION['id'] = $cookie['id'];
			}
		}
	}

	/**
	 * Redirect user if cookie, or session exist on "login.php"
	 */
	public function login()
	{
		$this->getSessions();
		// If sessions exists we redirect user in function of the type 
		if(isset($_SESSION['type']))
		{
			$session = $_SESSION['type']; // Get type of user (admin, member, booster)
			if($session == "member"){// Update current league, LP
					$update = new Member();
					$update->updateOrderLeague();
					
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/member/index.php"
					</SCRIPT>';
				}else if($session == "admin"){
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/dashboard/index.php"
					</SCRIPT>';
				}else if($session == "booster"){
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/booster/index.php"
					</SCRIPT>';
				}

		}
	}

	public function dashboard(){
		$this->getSessions();

		if(isset($_SESSION['type']))
		{
			$session = $_SESSION['type']; // Get type of user (admin, member, booster)
			if($session == "member")
			{
				$update = new Member();
				$update->updateOrderLeague();
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/member/index.php"
					</SCRIPT>';
			}else if($session == "booster")
			{
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/booster/index.php"
					</SCRIPT>';
			}
		}else{
				 if($_GET['sid']!="" && $_GET['user']!="")
		    {
		        $_SESSION['id'] = $_GET['sid'];
				$_SESSION['type'] = $_GET['user']; 
				 
		        header('Location: index.php');
				 
		    }
		    else
		    {
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/login.php"
					</SCRIPT>';
		    }
			}
	}

	public function booster(){
		$this->getSessions();

		if(isset($_SESSION['type']))
		{
			$session = $_SESSION['type']; // Get type of user (admin, member, booster)
			if($session == "member"){// Update current league, LP
					$update = new Member();
					$update->updateOrderLeague();
					
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/member/index.php"
					</SCRIPT>';
				}else if($session == "admin"){
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/dashboard/index.php"
					</SCRIPT>';
				}
		}else{
		    
		   	 if($_GET['sid']!="" && $_GET['user']!="")
		    {
		        $_SESSION['id'] = $_GET['sid'];
				$_SESSION['type'] = $_GET['user']; 
				 
		        header('Location: index.php');
				 
		    }
		    else
		    {
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/login.php"
					</SCRIPT>';
		    }
			}
	}

	public function member(){
		$this->getSessions();

		if(isset($_SESSION['type']))
		{
			$session = $_SESSION['type']; // Get type of user (admin, member, booster)
			if($session == "booster"){// Update current league, LP
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/booster/index.php"
					</SCRIPT>';
			}else if($session == "admin"){
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/dashboard/index.php"
					</SCRIPT>';
			}
		}else{
				 if($_GET['sid']!="" && $_GET['user']!="")
		    {
		        $_SESSION['id'] = $_GET['sid'];
				$_SESSION['type'] = $_GET['user']; 
				 
		        header('Location: index.php');
				 
		    }
		    else
		    {
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/login.php"
					</SCRIPT>';
		    }
			}
	}


}


?>