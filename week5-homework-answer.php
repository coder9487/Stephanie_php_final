<?php

	$last_name = "王";
	
	try
	{
		$db = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', '12345678');
		$db -> query("SET NAMES 'UTF8'");
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//:last_name 是要過濾的變數 的索引
		$sql = "SELECT a.id, a.name, a.scunumber, b.name as clsid0_name, c.name as clsid1_name 
				FROM user as a
				JOIN clsid0 as b ON (a.clsid0_id = b.id)
				JOIN clsid1 as c ON (a.clsid1_id = c.id)
				WHERE a.name LIKE :last_name";
		
		$stmt = $db->prepare($sql);
		
		//bindValue 綁定参數 第一個参數放索引 第二個放藥處裡的變數
		$stmt -> bindValue(':last_name', "{$last_name}%");
		
		//bindValue 是字串型態 ， 所以要轉數字型態
		//$stmt -> bindValue(':limit', 5, PDO::PARAM_INT);
		$stmt -> execute();
		//var_dump($sql);
		
		
		//這裡改用 fetchAll 取出所有結果
		$query = $stmt -> fetchAll(PDO::FETCH_ASSOC);
		
		foreach( $query as $val )
		{
			var_dump($val);
		}	
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>