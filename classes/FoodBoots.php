<?php
	// include 'DB/conn_db.php';
	//session_start();

	class FoodBoots{

		public static function getBoots($conn){
			$_SESSION['foodboots'] = array();

			$boots = mysqli_query($conn, "SELECT * FROM foodboots");

			$num = mysqli_num_rows($boots);

			if ($num > 0) {
				while($row = mysqli_fetch_array($boots)) {
					$_SESSION['foodboots'][] = ['id' => $row['id'], 'name' => $row['name']];
				}

				return $_SESSION['foodboots'];

			} else {
				return [];
			}

		}

		public static function getRandom ($boots) {
			return $boots[rand(0, count($boots) - 1)]['name'];
		}

	}

?>