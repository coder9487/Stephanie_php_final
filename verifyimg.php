<?php

	session_start();
	
	header("content-type: image/jpeg");
	
	//產生隨機數 -> 創建圖片 -> 隨機數寫進圖片 -> 存在session
	
	//第一步 產生隨機數
	$rand = null; 
	
	for($i=0;$i<4;$i++)
	{
		$rand .= dechex(rand(1,15)); //隨機亂數 1~15 再把抽出來的數字利用 dechex 把 10 進制轉為 16 進制
	}
	
	//第二步 創建圖片
	//設置圖片大小
	$im = imagecreatetruecolor(100,34);
	
	//設置顏色
	$bg = imagecolorallocate($im,0,0,0); //更改背景色
	imagefill($im,0,0,$bg);
	$te = imagecolorallocate($im,255,255,255); //文字顏色

	//製作線條干擾
	for($i=0;$i<5;$i++)
	{
		$te2 = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imageline($im,rand(0,100),0,100,30,$te2);
	}

	//製作點干擾
	//rand()%100 = 取得 0~100 以內的數字
	for($i=0;$i<400;$i++)
	{
		imagesetpixel($im,rand()%100,rand()%34,$te2);
	}

	//第三步隨機數寫進圖片
	imagestring($im,rand(4,6),rand(3,70),rand(0,16),$rand,$te);

	//輸出圖片	
	imagejpeg($im);


	//第四步 存在session
	$_SESSION['verify'] = $rand;