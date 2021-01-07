<?php 

/**
 * Profile Class
 */

class Profile{

	/**
	 * Change Profile
	 */
	public function change()
	{
		require 'Database.php';
		if(isset($_POST['save_profile']))
		{
			// If user change his avatar
			if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))
			{
				$maxSize = 5120000; // 50 Ko
				$validesExt = array('jpg', 'jpeg', 'png'); // Only jpg, jpeg or png

				if($_FILES['avatar']['size'] <= $maxSize)
				{
					$extUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); // Get extension
					if(in_array($extUpload, $validesExt))
					{
						$path = "../assets/img/avatars/".$_SESSION['id'].".".$extUpload; // Upload the avatar
						$dep = move_uploaded_file($_FILES['avatar']['tmp_name'], $path); // move the file to the folder

						// Check if the importation of the avatar is successful or not
						if($dep)
						{
							$avatar = $db->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
							$avatar->execute(array(
								'avatar' => $_SESSION['id'].".".$extUpload,
								'id'     => $_SESSION['id']
							));
							$_SESSION['avatar'] = 1;
							header('Location: index.php');
						}else{
							$_SESSION['dep'] = 1;
						}
					}else{
						$_SESSION['extension'] = 1; // Extensions not valid
					}
				}else{
					$_SESSION['maxSize'] = 1; // 50 Ko only !
				}
			}
			// End avatar
			// Change password
			if(!empty($_POST['new_password']))
			{
				$req = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
				$req->execute(array(hash('SHA512', $_POST['new_password']), $_SESSION['id']));

				$_SESSION['password'] = 1;
				header('Location: index.php');
			}
		}
	}

	/**
	 * Get profile info
	 */
	public function getProfile()
	{
		require 'Database.php';

		$user = $db->prepare("SELECT username, avatar FROM users WHERE id = ?");
		$user->execute(array($_SESSION['id']));
		return $user->fetch();
	}

}

 ?>