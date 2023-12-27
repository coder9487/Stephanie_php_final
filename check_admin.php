<?php
	
	session_start();
	include('db.php');

	if( isset( $_POST['submit'] ) )
	{
		$account = trim($_POST['account']);
		$password = trim($_POST['password']);
		
		if( !empty($account) && !empty($password) )
		{
			try
			{
				$sql = "SELECT * FROM admin WHERE account = :account AND password = :password";
				$res = $db->prepare($sql);
				$res -> bindValue(':account', $account);
				$res -> bindValue(':password', md5($password));
				$res -> execute();
				$check_account = $res -> rowCount();
				
				if( $check_account === 1 )
				{	
					setcookie('message', '登入成功');
					$_SESSION['admin'] = 'admin_yes';
				}
				else
				{
					setcookie('message', '登入失敗');
				}
			}
			catch(PDOException $e)
			{
				setcookie('message', $e->getMessage());
			}
		}
		else
		{
			setcookie('message', '請確實填寫欄位');
		}
	}
	else
	{
		setcookie('message', '參數錯誤');
	}
	
	header("Location: admin.php");