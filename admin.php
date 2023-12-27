<?php
	
	session_start();
	
	if( isset($_COOKIE['message']) )
	{
		$message = $_COOKIE['message'];
		setcookie('message','');
	}
	else
	{
		$message = '';
	}
	
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
	
	<!-- 指定網頁編碼 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<!-- 
		響應式網頁 
		width=device-width 頁面寬度與螢幕可視寬度相同	
		initial-scale=1 手機上畫面放大倍率
		user-scalable=0 手機上禁止縮放
	-->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	
    <!-- title旁的小圖案-->
    <link rel="icon" href="img/board.ico">	
	
	<!-- 網頁文件標題 -->
	<title>留言板</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="css/board.css" type="text/css">
	
</head>

<body>
	
	<!-- 頁面標題 -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>留言板</h2>
					<ol class="breadcrumb">
						<li><a href="index.php">填寫留言</a></li>
						<li><a href="board.php">查看留言</a></li>
						<li><a href="admin_register.php">註冊管理者帳號</a></li>
					</ol>
					<hr>
                </div>
            </div>
        </div>
    </header>
	
	<!-- 頁面內容 -->
	<section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
				
				<?php if( isset($_SESSION['admin'])  ): ?>
				
					<div class="text-center">

						<?php if( $message ): ?>
							<div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
						<?php endif; ?>	
						
						<a href="logout.php">
							<button class="btn btn-success">登出</button>
						</a>
						
					</div>
					
				<?php else: ?>				
				
                    <form action="check_admin.php" method="post">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="account" placeholder="帳號 *">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="密碼 *">
                                </div>							
                            </div>

                            <div class="col-md-12 text-center">
								<?php if( $message ): ?>
									<div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
								<?php endif; ?>	
                                <button type="submit" class="btn btn-success" name="submit">登入</button>
                            </div>
                        </div>
                    </form>				
				
				<?php endif; ?>
				
                </div>
            </div>
        </div>
    </section>
	
	<!-- 頁面底部 -->
    <footer>  
         <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
					<hr>
                    <h5>留言板建置實作</h5>
                </div>
            </div>
        </div>     
    </footer>	
	
    <!-- jQuery -->
    <script src="bootstrap/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
	
</body>

</html>