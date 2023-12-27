<?php

	session_start();
	include('db.php');
	
	if( isset($_GET['id']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin_yes' )
	{
		$id = trim($_GET['id']);
		$page = trim($_GET['page']);

		try
		{
			$sql = "DELETE FROM info WHERE id = :id";
			$res = $db->prepare($sql);
			$res -> bindValue(':id', $id, PDO::PARAM_INT);
			$res -> execute();
			
			$check = $res->rowCount();
			
			if( $check === 1 )
			{
				setcookie('message', '刪除成功');
			}
			else
			{
				setcookie('message', '查無資料');
			}
			
		}
		catch(PDOException $e)
		{
			setcookie('message', $e->getMessage());
		}
	}
	else
	{
		setcookie('message', '參數錯誤');
	}
	
	header("Location: board.php?page={$page}");