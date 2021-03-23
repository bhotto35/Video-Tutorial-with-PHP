<html>
</body>
	<?php
		$link = mysqli_connect("localhost","root","","vtwa");
		if(!$link)
		{
			die("Could not connect to database");
		}
		$query ="select * from comments where video_id=".$_POST['video_id'].";";
		$r = mysqli_query($link, $query);
		$num = mysqli_num_rows($r);
		echo "<h3>Comments (".$num."):</h3>";
	
		while($ra = mysqli_fetch_assoc($r))
		{
			$str = "<hr><div style='padding:5px;text-align:left;color:lightblue'>".$ra['user_'];
			$str = $str."<div style='color: white;text-align: left;padding:3px'>".$ra['contents']."</div>";
			$str = $str."<div style='text-align:right'>".$ra['datetime_']."</div></div>";
			echo $str;
		}
		echo "<hr>";
	?>
</body>
</html>