<?php

// Connection to the MySQL server using MySQLi API Procedural style
define('MYERROR', 'LOG');

function dbConnect($host, $username, $password, $database){
$conn = mysqli_connect($host, $username, $password, $database);
	if(!$conn){
		return die("Unable to Connect to the Server");
	}else{
		return $conn;
	}
}

function runQuery($db,$query){
	global $db;
	$queryResult = mysqli_query($db,$query);
	if(!$queryResult){
		//return die("Unable to Run Query [ $query ]"); /* for simple methoud */
		if(MYERROR == 'LOG'){
			error_log("\nError With = SQL\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = ".mysqli_error($db)."\nError Query = $query \n--------------------------------------------------------------------------------------------------", 3, "mySQLErrorLog.txt");
		}
		if(MYERROR == 'MAIL'){
			error_log("\nError With = SQL\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = ".mysqli_error($db)."\nError Query = $query \n--------------------------------------------------------------------------------------------------",1,SITE_ERROR_TO_MAIL,"From: Error Log <error@".DOMAIN.">");
		}
	}else{
		return $queryResult;
	}
}

function fetchNRow($db,$query){
	global $db;
	$queryResult = runQuery($db, $query);
	if($queryResult){
		$rows = mysqli_num_rows($queryResult);
		return $rows;
	}
return false;
}

function fetchRow($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$dataRow = mysqli_fetch_row($queryResult);
		return $dataRow;
	}
return false;
}

function fetchRows($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$dataRows = array();
		while($row = mysqli_fetch_assoc($queryResult)) {
			$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}

function fetchArray($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$dataRows = array();
		while($row = mysqli_fetch_array($queryResult)) {
		$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}

function fetchAsoc($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$dataRows = array();
		while($row = mysqli_fetch_assoc($queryResult)) {
			$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}

function fetchAsocRow($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$row = mysqli_fetch_assoc($queryResult);
		return $row;
	}
return false;
}

function fetchObj($db,$query){
	global $db;
	$queryResult = runQuery($db,$query);
	if($queryResult){
		$dataRows = array();
		while($row = mysqli_fetch_object($queryResult)) {
			$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}

function isAffected(){
	global $db;
	$result =  mysqli_affected_rows($db);
	if($result > 0){
		return true;
	}else{
		return false;	
	}
}

function isInserted(){
	global $db;
	$result =  mysqli_insert_id($db);	
	if($result>0){
		return true;
	}else{
		return false;	
	}
}

function inserted(){
	global $db;
	return mysqli_insert_id($db);	
}


## Filter the String for Special Charectors if any used ##
function escStr($string){
	global $db;
	$escaped_string = mysqli_real_escape_string($db, $string);
	$escaped_string = htmlentities($escaped_string,ENT_QUOTES);
	return $escaped_string;
}