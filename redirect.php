<html>
</body>
<?php
	session_start();
	$_SESSION['username']="";
	$username=$_POST['username'];
	$pwd=$_POST['pwd'];
	$link= mysqli_connect("localhost","root","","vtwa");
	if(!$link)
	{
		die("Database did not connect. ".mysqli_error($link));
	}
	$query="select pwd from users where username='$username';";
	$results=mysqli_query($link,$query);
	$pwd0='';
	$found=0;
	while($result_array=mysqli_fetch_assoc($results))
	{
		$pwd0=$result_array['pwd'];
		if(strcmp($pwd,$pwd0)==0)
		{
			$found=1;
		}
	}
	if($found==0)
	{
		unset($_SESSION['username']);
		echo "<script>alert('Incorrect username or password');
			window.location.replace('home.php');
		</script>";
		//window.location.replace('home.php');
	}
	else
	{
		$_SESSION['username']=$username;
		echo "<script>alert('Successful login');
			window.location.replace('home.php');
		</script>";
	}
?>
</body>
</html>