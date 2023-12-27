<?php
/*
				$sql = "SELECT * FROM user WHERE account = :account AND password = :password";
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

*/



	session_start();
	include('db.php');
	
	if( isset( $_POST['submit'] ) && isset($_SESSION['verify']) )
	{
		$name = trim($_POST['name']);
		$verify = trim($_POST['verify']);
		$content = trim($_POST['content']);
		$password = trim($_POST['password']);
		$date = date("Y-m-d H:i:s");

		$TOKEN = 0;
		try {
			$sql = "SELECT * FROM user WHERE username = :name AND password = :password";
			$res = $db->prepare($sql);
			$res -> bindValue(':name', $name);
			$res -> bindValue(':password', $password);
			$res -> execute();
			$check_account = $res -> rowCount();
			if($check_account === 1)
			{
				setcookie('message', "Success");
				$TOKEN = 1;
			}
			else
				setcookie('message',"No such user");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			setcookie('message', $e->getMessage());
		}



		if( $TOKEN === 1)
		{	
		if( !empty($name) && !empty($verify) && !empty($content) )
		{
			if( $_SESSION['verify'] == $verify )
			{
				unset($_SESSION['verify']); //刪除驗證碼 防止重複提交表單
				
				try
				{
					$sql = "INSERT INTO info(name, content, date) VALUES(:name, :content, :date)";
					$res = $db->prepare($sql);
					$res -> bindValue(':name', $name);
					$res -> bindValue(':content', $content);
					$res -> bindValue(':date', $date);
					$res -> execute();	

					$check = $res->rowCount();
					
					if( $check === 1 )
					{
						setcookie('message', '新增成功');
					}
					else
					{
						setcookie('message', '新增失敗');
					}	
				}
				catch(PDOException $e)
				{
					setcookie('message', $e->getMessage());
				}
			}
			else
			{
				setcookie('message', '驗證碼錯誤');
			}
		}
		else
		{
			setcookie('message', '請確實填寫欄位');
		}
		}
		else
		{
			//setcookie('message', '登入失敗');

		}
	}
	else
	{
		setcookie('message', '參數錯誤');
	}
	
	header("Location: index.php");