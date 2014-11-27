<?php

	/* FILE PROCESSING LAYOUT */
	/*
	
	1.$argv
		=> [0]   = 	filename e.e [
									s_interface.php
								 ]
								 
		=> [1] 	 = 	action to take e.g [
							addUser
							doLogin
							doChat
							delUser
							readChat
							checkUser
						   ]	
		
		=> [2] ... =   other arguments e.g [
											user
											pass
											to
											from
											message
											...
											] 
	
	/*EO FILE LAYOUT*/

	/* GENERAL SENDING FORMAT */
	/*
	 'action' => defines action to take
	 ... => [
			 user
			 pass
			 to
			 from
			 message
			 ]
	 */
	/* EO SENDING FORMAT */



$action= @$argv[1];
$filename = "response.chat";

function curl( $url, $filename ){
	
	$ch = curl_init("http://41.89.162.150/chat/code/s_interface.php?".$url);
	$fp = fopen($filename, "w");	
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	
}



switch ($action){
	
	//HANDLE USER ADDITION
	case "addUser":
		$url = "action=".$action."&user=".@$argv[2]."&pass=".@$argv[3];
		curl($url, $filename);
	break;
	
	//HANDLE LOGIN REQUESTS
	case "doLogin":
		$url = "action=".$action."&user=".@$argv[2]."&pass=".@$argv[3];
		curl($url, $filename);
	break;
	
	//HANDLE CHAT TRANSFER
	case "doChat":
		$url = "action=".$action."&to=".@$argv[2]."&from=".@$argv[3]."&message=".@htmlspecialchars(addslashes($argv[4]));
		curl($url, $filename);
	break;
	
	//HANDLE USER DELETION
	case "delUser":
		$url = "action=".$action."&user=".@$argv[2];
		curl($url, $filename);
	break;

	//HANDLE CHAT FETCHING
	case "readChat":
		$url = "action=".$action."&user=".@$argv[2];
		$filename = "chat.chat";
		curl($url, $filename);
	break;
	
	//CHECK IF USER IS VALID
	case "checkUser":
		$url = "action=".$action."&user=".@$argv[2];
		curl($url, $filename);
	break;
	
	//HANDLE UNKNOWN ERRORS
	default:	
		curl("action=''",$filename);	
	break;
	
}

?>