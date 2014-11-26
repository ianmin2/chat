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

$action= $arg[1];

switch ($action){
	
	//HANDLE USER ADDITION
	case "addUser":
		
	break;
	
	//HANDLE LOGIN REQUESTS
	case "doLogin":
		
	break;
	
	//HANDLE CHAT TRANSFER
	case "doChat":
		
	break;
	
	//HANDLE USER DELETION
	case "delUser":
		
	break;

	//HANDLE CHAT FETCHING
	case "readChat":
		
	break;
	
	//CHECK IF USER IS VALID
	case "checkUser":
		
	break;
	
	//HANDLE UNKNOWN ERRORS
	default:	
			
	break;
	
}

?>