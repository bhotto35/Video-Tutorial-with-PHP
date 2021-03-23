<!DOCTYPE html>
<html>
<head>
	<title>Video Tutorials - Upload</title>
</head>
<body >
<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		session_destroy();
		header("location: home.php");
	}
?>
<style>
	.btn{
		border:1px solid white;
		color:black;
		padding:3px;
		background: greenyellow;
		border-radius: 5px;
	}
	.hr{
		border-top:1px solid yellow;
		border-bottom:none;
	}
	.btn:hover{
		border:1px solid white;
		color:white;
		background: lime;
	}
	body{
		background: rgba(21,37,43,1);
	}
	h1{
		color: white;
		text-shadow: 3px 0px 4px blue;
	}
	h2{
		color: white;
		text-shadow: 1px 2px #121212;
	}
</style>
<div style="width:100%;padding:1px;background:slateblue;border-radius: 10px 10px 10px;text-align:center"><h1><big>VIDEO TUTORIALS</big></h1><h2>Upload portal</h2>
<hr>
	<div style="text-align:right;padding:5px">
		<?php
			echo "Logged in: ".$_SESSION['username'];
		?>
			&nbsp <a href='logout.php'><button type='button' class='btn'>Logout</button></a>
			&nbsp <a href='home.php'><button type='button' class='btn'>Home</button></a>
	</div>
</div>
<br>
<div style="width:50%;margin:0 auto;padding: 5px;box-shadow:0px 0px 2px 1px yellow;color:white;background:rgba(64,79,81,1)">
	<form action="savelocation.php" method="post" enctype="multipart/form-data">
		<h3 align="center">UPLOAD FORM</h3><hr class='hr'>
	  Choose video file:
	  <input type="file" name="file0" id="file0" required><br><br>
	  Enter name of video:
	  <input type="text" name="vidname" id="vidname" required><br><br>
	  Enter hyphen separated keywords:
	  <textarea name="keywords" placeholder="Eg. keyword1-some other keyword-another keyword-keyword2" required></textarea><br><br>
	  <div style="text-align:center"><button class="btn"type="submit" value="Upload Video" name="submit">Upload</button></span>
	</form>
</div>
</body>
</html>