<html>
	<body>
		<?php
			session_start();
			print_r($_POST);
			$link = mysqli_connect("localhost","root","","vtwa");
			if(!$link)
				die("Couldn't connect to DB");
			if(isset($_SESSION['username']) && isset($_POST['oldpwd']))
			{
				$query = "select pwd from users where username = '".$_SESSION['username']."';";
				$r = mysqli_query($link,$query);
				$ra = mysqli_fetch_assoc($r);
				
				if($_POST['oldpwd']==$ra['pwd'])
				{
					if($_POST['new0']==$_POST['new1'])
					{
						$q = "update users set pwd = '".$_POST['new0']."' where username = '".$_SESSION['username']."';";
						$exec = mysqli_query($link,$q);
						echo "<script>
							alert('Password changed successfully');
							window.location.replace('home.php');
						</script>";
					}
					else{
						echo "<script>
							alert('New passwords do not match');
							window.location.replace('home.php');
						</script>";
					}
				}
				else
					echo "<script>
					alert('Old password is incorrect');
					window.location.replace('home.php');
				</script>";
				
				
				
				
			}
			else
			{
				session_destroy();
				header("location: home.php");
			}
			
		?>
	</body>
</html>