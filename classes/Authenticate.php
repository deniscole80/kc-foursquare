<?php
include 'DB/conn_db.php';
//session_start();

class Authenticate
{

	public function login($conn, $username, $password, $table)
	{

		//$sql = "SELECT * FROM $table WHERE hotel_username = '$username' AND password= '$password'";

		$sel = mysqli_query($conn, "SELECT * FROM $table WHERE email = '$username' AND password= '$password'");

		$this->getActiveCamp($conn);

		$num = mysqli_num_rows($sel);

		if ($num == 1) {

			$row = mysqli_fetch_array($sel);

			$id = $row['id'];
			$email = $row['email'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];

			$_SESSION['userId'] = $id;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email'] = $email;

			//return $id;

			echo "1";
		} else {

			echo "0";
		}

		mysqli_close($conn);
	}

	public static function getActiveCamp($conn) {

		$selCamp = mysqli_query($conn, "SELECT * FROM camps WHERE status = 'active'");

		$rowCamp = mysqli_fetch_array($selCamp);

		if (mysqli_num_rows($selCamp) > 0) {
			$campId = @$rowCamp['id'];
			$regularFee = @$rowCamp['regular_fee'];
			$campName = @$rowCamp['name'];

			$_SESSION['campId'] = $campId;
			$_SESSION['campName'] = $campName;
			$_SESSION['regularFee'] = $regularFee;
		}
	}

	public static function lockUser()
	{

		if (!isset($_SESSION['hotel_id']) && !isset($_SESSION['staff_id'])) {

			echo '<script> document.location = "index.php" </script>';
		}
	}
}
