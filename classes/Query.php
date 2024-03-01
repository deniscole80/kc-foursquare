<?php



class Query
{

	public static function payedindbInsert($conn, $tableName, $myFields, $myVariables, $successFeedbackMessage, $failureFeedbackMessage)
	{



		if (mysqli_query($conn, "INSERT INTO `$tableName` ($myFields) VALUES ($myVariables)")) {

			$last_id = $conn->insert_id;
		} else {

			echo $failureFeedbackMessage;
		}
	}
	public static function pbulkdbInsert($conn, $tableName, $myFields, $myVariables, $successFeedbackMessage, $failureFeedbackMessage)
	{



		if (mysqli_query($conn, "INSERT INTO `$tableName` ($myFields) VALUES ($myVariables)")) {

			$last_id = $conn->insert_id;
			echo $successFeedbackMessage;
		} else {

			echo $failureFeedbackMessage;
		}
	}


	public static function dbInsert($conn, $tableName, $myFields, $myVariables, $successFeedbackMessage, $failureFeedbackMessage)
	{
		// echo " $tableName, $myVariables, $myFields";
		$query = "INSERT INTO `$tableName` ($myFields) VALUES ($myVariables)";

		try {
			mysqli_query($conn, $query);

			$last_id = $conn->insert_id;

			echo $successFeedbackMessage;
			return $last_id;
		} catch (Exception $th) {
			//throw $th;
			echo $failureFeedbackMessage;
			// echo $th;
		}
	}



	public static function dbUpdate($conn, $tableName, $fieldAndVariable, $field2AndVariable2, $successFeedbackMessage, $failureFeedbackMessage)
	{



		if (mysqli_query($conn, "UPDATE $tableName set $fieldAndVariable WHERE $field2AndVariable2")) {

			echo $successFeedbackMessage;
		} else {

			echo $failureFeedbackMessage;
		}
	}



	public static function dbDelete($conn, $tableName, $field2AndVariable2, $successFeedbackMessage, $failureFeedbackMessage)
	{



		if (mysqli_query($conn, "DELETE FROM $tableName WHERE $field2AndVariable2")) {

			echo $successFeedbackMessage;
		} else {

			echo $failureFeedbackMessage;
		}
	}
}
