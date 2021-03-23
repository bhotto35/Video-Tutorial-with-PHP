<html>
	<head>
		<style>
			.play{
				background: slateblue;
				color: white;
				border:white;
				padding: 3px;
			}
			.play:hover{
				background:black;
				color:blue;
			}
			hr{
				border-bottom:none;
				border-top:1px solid red;
			}
		</style>
	</head>
<body>
<?php
	session_start();
	
	$link= mysqli_connect("localhost","root","","vtwa");
	if(!$link)
	{
		die('Database did not connect'.mysqli_error($link));
	}
	$query = "select history, history_index from users where username= '".$_SESSION['username']."';";
	$r = mysqli_query($link, $query);
	$history=array();
	$index = 0;
	while($ra = mysqli_fetch_assoc($r))
	{
		$history = explode (',',$ra['history']);
		$index = $ra['history_index'];
	}
	$len = 10;
	$newuser = 1;
	$i = $index-1;
	echo "<h3>Recent Views</h3><hr>";
	if($i<0)
	{$i=$len-1;}
	echo "<ul>";
	while(1)
	{
		
		if($history[$i]!='0')
		{
			$query_ = "select * from videos where id=".$history[$i].";";
			$r_ = mysqli_query($link,$query_);
			while($ra_ = mysqli_fetch_assoc($r_))
			{
				$str = "<li><form action ='vidplay.php' method='post'>
					".$ra_['name']." &nbsp 
					<button type='submit' class='play' name='sub' value='".$ra_['address']."'>Play</button>
					<input type='number' name='id' value='".$ra_['id']."' hidden>
					</li></form>
					";
				echo $str;
			}
			$newuser = 0;
			
			//echo "i: ".$i." index: ".$index." len: ".$len."<br>";
		}
		if($i==$index)
		{
			break;
		}
		$i-=1;
		if($i<0)
		{$i=$len-1;}
	}
	echo "</ul>";
	if($newuser==1)
	{
		echo "
			<i>Looks like you're a new user :) </i>
		";
	}
?>
</body></html>