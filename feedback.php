<?php
	session_start();
	$link= mysqli_connect("localhost","root","","vtwa");
	if(!$link)
	{
		die("Database did not connect. ".mysqli_error($link));
	}
	$feed = number_format($_POST['feed']);
	$q = "select pfeedback, nfeedback from videos where id=".$_POST['id'].";";
	$r = mysqli_query($link,$q);
	$ra = mysqli_fetch_assoc($r);
	if($feed==1)
	{
		$pfeed = number_format($ra['pfeedback']) + 1;
		$query = "update videos set pfeedback=".$pfeed." where id=".$_POST['id'].";";
		mysqli_query($link,$query);
	}
	
	if($feed==-1)
	{
		$nfeed = number_format($ra['nfeedback']) + 1;
		$query = "update videos set nfeedback=".$nfeed." where id=".$_POST['id'].";";
		mysqli_query($link,$query);
	}
	
?>