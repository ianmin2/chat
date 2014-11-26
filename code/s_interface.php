<?php 

	include_once 'index.php';
	
	$args = $_REQUEST;
	
	/* GENERAL RECEIVING FORMAT */
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
	/* EO RECEIVING  FORMAT */
	$user 		= $args['user'] ;
	$pass 		= $args['pass'];
	$to   		= $args['to'];
	$from 		= $args['from'];
	$message 	= $args['message'];
	
	switch ($args['action']){
	
		//HANDLE USER ADDITION
		case "addUser":
			echo addUser( $connection, $user, $pass );
			exit;
			break;
	
			//HANDLE LOGIN REQUESTS
		case "doLogin":
			echo doLogin( $connection, $user, $pass );
			break;
	
			//HANDLE CHAT TRANSFER
		case "doChat":
			echo doChat($connection, $to, $from, $message);
			exit;
			break;
	
			//HANDLE USER DELETION
		case "delUser":
			echo delUser($connection, $user);
			exit;
			break;
	
			//HANDLE CHAT FETCHING
		case "readChat":
			print_r( readChat($connection, $user) );
			exit;
			break;
	
			//CHECK IF USER IS VALID
		case "checkUser":
			echo checkUser($connection, $user);
			exit;
			break;
	
			//HANDLE UNKNOWN ERRORS
		default:
			echo "404";
			exit;
			break;
	
	}

?>