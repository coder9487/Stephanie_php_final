<?php

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
						<li><a href="board.php">查看留言</a></li>
						<li><a href="admin.php">管理者</a></li>
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
                    <form action="insert_message.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="name" placeholder="姓名 *">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control input-lg" name="password" placeholder="密碼 *">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="verify" placeholder="驗證碼 *">
                                </div>
                                <div class="form-group">
									<img src="verifyimg.php" name="img">
									<a href="index.php">看不清楚? 刷新</a>
                                </div>								
                            </div>
                            <div class="col-md-6">
								<div class="form-group">
                                    <textarea class="form-control" name="content" rows="5" placeholder="留言 *"></textarea>
                                </div>
                            </div>   
                            <div class="col-md-12 text-center">
								<?php if( $message ): ?>
									<div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
								<?php endif; ?>	
                                <button type="submit" class="btn btn-success" name="submit">送出</button>
                            </div>
                        </div>
                    </form>
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