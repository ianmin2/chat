<?php

	$id = "index.php";
	$connect = true;
	chdir("..");
	include 'r_main.php';
	chdir("code");
	
/* ADD A USER TO THE CHAT PROGRAM */
	function addUser($connection, $user, $pass){
		
		$query = $connection->query("INSERT INTO users ( _user, _pass ) VALUES ( '".$user."', '".$pass."' )");		
		if($query){
			return 1;
		}else{
			return 0;
		}
		
	}
	/*Testing */
	//echo addUser($connection, "ianmin2", "ian");
	/* EOTest*/

	
	
/* VERIFY THE LOGIN CREDENTIALS */
	function doLogin($connection, $user, $pass){
		
		$query = $connection->num_rows("SELECT * FROM users WHERE _user='".$user."' AND _pass='".$pass."' LIMIT 1");
		if($query == 1){			
			return 1;			
		}else{			
			return 0;			
		}
		
	}
	/*Testing */
	//echo doLogin($connection, "stern", "stern");
	/* EOTest*/

	
	
/* WRITE A CHAT TO A USER */	
	function doChat($connection, $to, $from, $message ){
		
		if(checkUser($connection, $to) == 1){
		
			$now = date("d-m-Y h:i:s");
			$query = $connection->query("INSERT INTO chats ( _to, _from, _message, _time  ) VALUES ( '".$to."', '".$from."', '".$message."', '".$now."') ");
			
			if($query){
				return 1;
			}else{
				return 0;
			}
			
		}else{
			return 3;
		}
		
	}
	/*Testing */
	//echo doChat($connection, "ianmin2", "stern", addslashes("It's working!") );
	/* EOTest*/

	
	
/* DELETE A USER FROM THE CHAT */
	function delUser($connection, $user){
	
		$query = $connection->query("DELETE FROM users WHERE _user='".$user."' LIMIT 1 ");
		
		if($query){
			return 1;
		}else{
			return 0;
		}
		
	}
	/*Testing */
	//echo delUser($connection, "ianmin2");
	/* EOTest*/

	
	
/* GET THE CHATS ADDRESSED TO THE USER */	
	function readChat( $connection, $user ){
		
		$da = "";
		$query = $connection->query("SELECT * FROM chats WHERE _to='".$user."' OR _from='".$user."' ");
		
		$i = 0;
		while( $resp = mysqli_fetch_array($query) ){
			
			if($resp['_from'] == $user ){
				$da .= "ME -> ". $resp['_to'].":\r ".$resp['_message']."\r\n\t ".$resp['_time']."\r\n" ;			
			}else{
				$da .= $resp['_from'].": \r ".$resp['_message']."\r\n\t ".$resp['_time']."\r\n";
			}
			
			$i++;
		}
		
		return $da;
		
	}
	/*Testing 
	echo  "<pre>";
		print_r(readChat($connection, "stern"));
	echo "</pre>";
	/* EOTest*/

		
/* GET CHAT USER DATA */
	function getUser( $connection, $userid ){
		
		$query = $connection->query("SELECT _user FROM users WHERE id='".$userid."' LIMIT 1");
		while($da = mysqli_fetch_array($query)){			
			return $da['_user'];			
		}
		
	}
	/*Testing */
	//echo getUser($connection, "5");
	/* EOTest*/
	
/* CHECK IF USERNAME EXISTS */
	function checkUser($connection, $user){
		
		return $connection->num_rows("SELECT id FROM users WHERE _user='".$user."' LIMIT 1");
		
	}
	/*Testing */
		//echo checkUser($connection, "sterns");
	/* EOTest*/
	
	