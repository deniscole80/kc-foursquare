<?php
	require 'conn_db.php';
	require '../Query.php';
	
	$username = 'Oladepo';
	$phone = '08104005114';
	//$newname = 'Tunde';
	//$myTableName = 'testing';
	//$myTableArray = "username, phone";
	
	//$myVarArray = "'$username', '$phone'";
	
	//mysql_query("INSERT INTO `$myTableName` ($myTableArray) VALUES ($myVarArray)");
	
	//$sel = mysql_query("SELECT * FROM testing WHERE username = '$username'");
	
	//mysql_query("UPDATE testing set username = '$newname' WHERE username = '$username'");
	
	//mysql_query("DELETE FROM testing WHERE username = '$newname'");
	
	//$myString = "username = '$username',phone = '$phone',new = '$newname'";
	//$myArray =  $myString;
	//print_r($myArray);
	
	$tableFields = "username, phone";
	$variables = "'$username', '$phone'";
	$table = 'testing';
	$success='Successful';
	$failure='Failed';
	Query::dbInsert($table, $tableFields, $variables, $success, $failure);
	
	//$table = 'testing';
	//$n = "username='Kunmi', phone='999999999'";
	//$a = "username='Oladepo'";
	//$success = 'O wole kanle';
	//$failure = 'Doing rubbish';
	
	//Query::dbUpdate($table, $n, $a, $success, $failure);
	
	//$username = 'Kunmi';
	//$table = 'testing';
	//$where = "username='$username'";
	//$success = 'Deleted';
	//$fail = 'Failed';
	
	//Query::dbDelete($table, $where, $success, $fail);
	
	/*function checkBadGuy(){
		var fname = parseInt($('#firstname_initial').text());
		var lname = parseInt($('#lastname_initial').text());
		var uname = parseInt($('#username_initial').text());
		var e_mail = parseInt($('#email_initial').text());
		var pword = parseInt($('#password_initial').text());
		var phone_num = parseInt($('#phone_initial').text());
		var sum = fname + lname + uname + e_mail + pword + phone_num;
		if($sum != 6 && $('#terms').is(":checked")){
			$('#submit').attr('disabled', 'disabled');
		}else{
			
		}
	}
	setInterval(checkBadGuy(), 200);
	
	var count_term = 0;
	$('#terms').change(function(){
		count_term = count_term + 1;
		if(count_term % 2 ==1){
			var fname = parseInt($('#firstname_initial').text());
			var lname = parseInt($('#lastname_initial').text());
			var uname = parseInt($('#username_initial').text());
			var e_mail = parseInt($('#email_initial').text());
			var pword = parseInt($('#password_initial').text());
			var phone_num = parseInt($('#phone_initial').text());
			var sum = fname + lname + uname + e_mail + pword + phone_num;
			alert(sum);
			
			if(sum == 6){
				$('#submit').removeAttr('disabled');
			}
		}else{
			$('#submit').attr('disabled', 'disabled');
			var fname = parseInt($('#firstname_initial').text());
			var lname = parseInt($('#lastname_initial').text());
			var uname = parseInt($('#username_initial').text());
			var e_mail = parseInt($('#email_initial').text());
			var pword = parseInt($('#password_initial').text());
			var phone_num = parseInt($('#phone_initial').text());
			var sum = fname + lname + uname + e_mail + pword + phone_num;
			alert(sum);
		}
	});
	
	/*var fname = parseInt($('#firstname_initial').text());
	var lname = parseInt($('#lastname_initial').text());
	var uname = parseInt($('#username_initial').text());
	var e_mail = parseInt($('#email_initial').text());
	var pword = parseInt($('#password_initial').text());
	var phone_num = parseInt($('#phone_initial').text());
	var sum = fname + lname + uname + e_mail + pword + phone_num;
	
	if(sum != 6){
		$('#terms').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
	}else{
		$('#terms').removeAttr('disabled');
		
		$('#submit').removeAttr('disabled');
	}*/

	/*$('#terms').change(function(){
		var fname = parseInt($('#firstname_initial').text());
		var lname = parseInt($('#lastname_initial').text());
		var uname = parseInt($('#username_initial').text());
		var e_mail = parseInt($('#email_initial').text());
		var pword = parseInt($('#password_initial').text());
		var phone_num = parseInt($('#phone_initial').text());
		var sum = fname + lname + uname + e_mail + pword + phone_num;
		if ($('#terms').is(":checked")){
			if(sum == 6){
				$('#submit').removeAttr('disabled');
			}else{
				$('#submit').attr('disabled', 'disabled');
			}
		}
		else{
			$('#submit').attr('disabled', 'disabled');
		}
		
	});*/
?>