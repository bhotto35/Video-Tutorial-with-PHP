<html>
	<body>
		<?php
			$link= mysqli_connect("localhost","root","","vtwa");
			if(!$link)
			{
				die("Database did not connect. ".mysqli_error($link));
			}
			$video_id =$_POST['video_id'];
			$user_ = $_POST['user_'];
			$comment = $_POST['comment'];
			$q = "select max(id) from comments";
			$r0 = mysqli_query($link,$q);
			$ra0 = mysqli_fetch_assoc($r0);
			$id = $ra0['max(id)']+1;
			$datetime_=date('Y-m-d')." ".date('H:m:s');
			$query = "insert into comments values(".$id.",'".$user_."',".$video_id.", '".$datetime_."','".$comment."' )";
			mysqli_query($link,$query);
		?>
	</body>
</html>