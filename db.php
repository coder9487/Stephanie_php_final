<?php

	try
	{
		$db = new PDO('mysql:host = 127.0.0.1; dbname=test', 'user', ''); //連接資料庫
		$db -> query("SET NAMES 'UTF8'"); //指定編碼
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //捕捉錯誤訊息
	}
	catch(PDOException $e)
	{
		setcookie('message', $e->getMessage());
		header("Location: index.php");
		exit;
	}