<?php

// Connection to the MySQL server using MySQLi API Procedural style

function dbConnect($serverName, $connectionInfo){

	//$serverName = "RaviKumarJangra";
	//$connectionInfo = array("Database"=>"joe");	
	$connection = sqlsrv_connect($serverName, $connectionInfo);
	if (!$connection) {
			die(print_r(sqlsrv_errors(), true));
			//return die("Unable to Connect to the Server");
	} else {
			return $connection;
	}
}




function runQuery($db,$query,$params = ''){
	global $db;
	if(empty($params)){
		$params = array();	
	}
	$stmt = sqlsrv_query($db,$query,$params);
	if(!$stmt){
		return die("Error with the Statement [ $query ]"); /* for simple methoud */
		if(ERROR_SEND == 'LOG'){
			error_log("\nError With = SQL\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = ".print_r(sqlsrv_errors())."\nError Query = $query \n--------------------------------------------------------------------------------------------------", 3, "mySQLErrorLog.txt");
		}
		if(ERROR_SEND == 'MAIL'){
			error_log("\nError With = SQL\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = ".print_r(sqlsrv_errors())."\nError Query = $query \n--------------------------------------------------------------------------------------------------",1,SITE_ERROR_TO_MAIL,"From: Error Log <error@".DOMAIN.">");
		}
		
	}else{
		return $stmt;
	}
}




function fetchNRow($db,$query){
	global $db;
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );	
	$stmt = sqlsrv_query($db,$query,$params,$options);
	$row_count = sqlsrv_num_rows($stmt);
	if ($row_count === false){
		die(print_r(sqlsrv_errors(), true));
	} else {
		return $row_count;
	}
return false;
}




function fetchAsocRow($db,$query){
	global $db;
	$stmt = runQuery($db,$query);
	if($stmt){
		$dataRow = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
		return $dataRow;
	}
return false;
}




function fetchAsocRows($db,$query){
	global $db;
	$stmt = runQuery($db,$query);
	if($stmt){
		$dataRows = array();
		while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}


function fetchAsoc($db,$query){
	global $db;
	$stmt = runQuery($db,$query);
	if($stmt){
		$dataRows = array();
		while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		$dataRows[] = $row;
		}
		return $dataRows;
	}
return false;
}



function isAffected($stmt){
	$result =  sqlsrv_rows_affected($stmt);
	if($result > 0){
		return $result;
	}else{
		return 0;	
	}
}




function isInserted($stmt) {
    sqlsrv_next_result($stmt);
    sqlsrv_fetch($stmt);
    return sqlsrv_get_field($stmt, 0);
}




function escStr($data) {
	$escaped_string = htmlentities($data,ENT_QUOTES);
	return $escaped_string;
}