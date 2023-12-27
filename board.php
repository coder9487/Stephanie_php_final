<?php

	session_start();
	include('db.php');
	
	try
	{
		$sql = "SELECT * FROM info";
		$query = $db -> query($sql);
		
		//分頁
		//計算資料總共筆數
		$query_nums = $query->rowCount();
		
		//每頁顯示筆數
		$max_count = 5;
		
		//總共有多少頁 ceil 有小數直接進位
		$pages = ceil($query_nums/$max_count);
		
		if( !isset( $_GET['page'] ) or (int)$_GET['page'] < 1 or (int)$_GET['page'] > $pages )
		{
			$page = 1;
		}
		else
		{
			$page = (int)$_GET['page'];
		}
		
		//每一頁開始的資料序號
		$start = ( $page - 1 ) * $max_count;
		
		//ORDER BY id DESC 由最後一筆排到第一筆
		//LIMIT 由第 $start 開始, 最多取 $max_count 筆數
		$sql = "SELECT * FROM info ORDER BY id DESC LIMIT {$start}, {$max_count}";
		$query = $db -> query($sql);	
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		exit;
	}	


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
				
				<!-- 訊息 -->
				<?php if( $message ): ?>
					<div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
				<?php endif; ?>	
	
				<!-- 留言 -->
				<?php foreach( $query as $key => $val ) : ?>
				
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">
								<?php echo $val['name'] . ' 在 ' . $val['date'] . ' 留言' ?>
							</h3>
							
							<?php if( isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin_yes' ): ?>
								
								<a href="delete_message.php?id=<?php echo $val['id']; ?>&page=<?php echo $page; ?>"> <div class="text-right">刪除</div> </a>
							
							<?php endif; ?>
							
						</div>
						<div class="panel-body">
							<?php echo nl2br($val['content']); ?>
						</div>
					</div>
					
				<?php endforeach; ?>
				
					<!-- 分頁區塊 -->
					<div class="text-center">
						<ul class="pagination">

						<?php
						
							//分頁
							//不是首頁 在顯示回到首頁的標籤
							if( $page != 1 )
							{
								echo '<li><a href="?page=1">&laquo;</a></li>';
							}					

							//頁碼
							for( $i=1 ; $i<=$pages ; $i++ ) 
							{
								if( $page-3 < $i && $i < $page+3 )
								{
									if( $i == $page )
									{
										echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
									}
									else
									{
										echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
									}
								}
							} 					
							
							//不是最後一頁 在顯示到最後一頁的標籤
							if( $page != $pages )
							{
								echo '<li><a href=?page=' . $pages . '>&raquo;</a></li>';
							}
							
						?>
					
						</ul>
					</div>
		
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