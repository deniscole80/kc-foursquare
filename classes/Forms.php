<?php
	class Forms{

		public static function checkUsernameAvailability($table, $field, $variable, $field2){

			$sel = mysql_query("SELECT * FROM $table WHERE $field = '$variable'");

			$num = mysql_num_rows($sel);

			if($num > 0){

				echo $field2.' already taken';

			}

			else{

				if ( preg_match("/^[A-Za-z][A-Za-z0-9]{2,15}$/", $variable)) {

					echo $field2.' available!';

				}

				else{

					echo 'Invalid!';

				}

			}

			

		}

		
		public static function usernameAvailability($table, $field, $variable){

			$sel = mysql_query("SELECT * FROM $table WHERE $field = '$variable'");

			$num = mysql_num_rows($sel);

			if($num > 0){

				return false;

			}

			else{

				if ( preg_match("/^[A-Za-z][A-Za-z0-9]{2,15}$/", $variable)) {

					return true;

				}

				else{

					return false;

				}

			}

			

		}

		

		public static function checkEmailAvailability($table, $field, $variable, $field2){			

			$sel = mysql_query("SELECT * FROM $table WHERE $field = '$variable'");

			$num = mysql_num_rows($sel);

			if($num > 0){

				echo $field2.' already taken';

			}

			else{

				if(filter_var($variable, FILTER_VALIDATE_EMAIL)){

					echo $field2.' available!';

				}else{

					echo 'Invalid!';

				}

			}

		}

		

		public static function emailAvailability($table, $field, $variable){

			

			$sel = mysql_query("SELECT * FROM $table WHERE $field = '$variable'");

			$num = mysql_num_rows($sel);

			if($num > 0){

				return false;

			}

			else{

				if(filter_var($variable, FILTER_VALIDATE_EMAIL)){

					return true;

				}else{

					return false;

				}

			}

		}

		
		public static function inputValidation($data1, $data2){

			if ( !preg_match ("/^[a-zA-Z\s]+$/", $data1) || strlen($data1) < 3 || strlen($data1) > 15 ) {

				echo 'Invalid '.$data2.'!';

			}

			else{

				echo 'Valid '.$data2.'!';

			}

		}

		

		public static function inputValid($data){

			if ( !preg_match ("/^[a-zA-Z\s]+$/", $data) || strlen($data) < 3 || strlen($data) > 15 ) {

				return false;

			}

			else{

				return true;

			}

		}

		

		public static function passwordValidation($data){

			if ( strlen($data) < 6 || strlen($data) > 30 ) {

				echo 'Invalid password!';

			}

			else{

				echo 'Valid password!';

			}

		}

		
		public static function phoneValidation($data){

			if ( strlen($data) == 11 && preg_match ("/[0-9]$/", $data) ) {

				echo 'Valid phone number!';

			}

			else{

				echo 'Invalid phone number!';

			}

		}

		

		public static function passwordValid($data){

			if ( strlen($data) < 6 || strlen($data) > 30 ) {

				return false;

			}

			else{

				return true;

			}

		}

		

		public static function phoneValid($data){

			if ( strlen($data) == 11 && preg_match ("/[0-9]$/", $data) ) {

				return true;

			}

			else{

				return false;

			}

		}

		

		public static function login($table, $username, $password){

			$sel = mysql_query("SELECT * FROM $table WHERE username = '$username' AND password= '$password'");

			$num = mysql_num_rows($sel);

			if($num == 1){

				$sel_id = mysql_query("SELECT * FROM $table WHERE username = '$username' AND password= '$password'");

				$row = mysql_fetch_array($sel_id);

				$user_id = $row['id'];

				return $user_id;

				return true;

			}

			else{

				return false;

			}	

		}

	}

?>