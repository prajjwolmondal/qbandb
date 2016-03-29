<?php
	// resume session
    session_start ();

	echo "Logging out";

	// end session
	unset($_SESSION['mem_id']);
	session_destroy();

	// send to index.php
	header("Location: index.php");
?>