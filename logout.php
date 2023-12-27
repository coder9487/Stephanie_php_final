<?php
	
	session_start();
	session_destroy(); //清空 session
	header("Location: admin.php");