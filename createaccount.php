<html>
<body>
<?php
	session_start();
	if(!isset($_POST))
		header("location: home.php");
	$link= mysqli_connect("localhost","root","","vtwa");
	if(!$link)
	{
		die("Database did not connect. ".mysqli_error($link));
	}
	$pwd=$_POST['pwd0'];
	$username=$_POST['username0'];
	$email=$_POST['email'];
	if($username!='0')
	{
		$query="insert into users values('$username','$pwd','$email','0,0,0,0,0,0,0,0,0,0',0);";
		//mysqli_query($link,$query);
		//echo mysqli_error($link);
		if(mysqli_query($link,$query))
		{
			echo "<script>alert('Account created');
				window.location.replace('home.php');
			</script>";
		}
		else
		{
			echo "<script>alert('Username/email is unavailable.');
				window.location.replace('home.php');
			</script>";
		}
	}
	else{
		echo "<script>alert('No one can have username 0');
				window.location.replace('home.php');
			</script>";
	}
?>
</body>
</html>