<?php

session_start();

$msg = 'wrong';

if(isset($_SESSION['register']) and isset($_SESSION['fullname'])){
	$loginname = $_SESSION['register'];	

	if(file_exists("online/$loginname")){
		touch("online/$loginname"); // for online keeping			

		$w = trim($_REQUEST['w']);
		//$h = trim($_REQUEST['h']);

		// SAVE TO FILE		
		$fp = fopen("screen/$loginname", "w+");
		
		if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock
			fwrite($fp, "$w\n");
			fflush($fp);            // flush output before releasing the lock
			flock($fp, LOCK_UN);    // release the lock
		} 
		$msg = 'ok';
	}
}

echo "$msg";

?>