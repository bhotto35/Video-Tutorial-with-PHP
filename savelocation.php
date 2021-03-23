<html>
	<body>
		<?php
		session_start();
		$uploads_dir = 'videos';
		if (isset($_FILES["file0"]) && $_FILES["file0"]["error"] == 0) { 
          
			$link= mysqli_connect("localhost","root","","vtwa");
			if(!$link)
			{
				die("Database did not connect. ".mysqli_error($link));
			}
			$vid_name=$_POST['vidname'];
			$username=$_SESSION['username'];
			$keywords=$_POST['keywords'];
			$file_name     = basename($_FILES["file0"]["name"]); 
			$file_type     = $_FILES["file0"]["type"]; 
			$file_size     = $_FILES["file0"]["size"]; 
			$file_tmp_name = $_FILES["file0"]["tmp_name"]; 
			//echo $file_name."<br>";
			$datetime= date('Y-m-d')." ".date('H:m:s');
			
			/*id of new video*/
			$query="select max(id) from videos;";
			$id=0;
			$results=mysqli_query($link,$query);
			$result_array=mysqli_fetch_assoc($results);
			$id=$result_array['max(id)']+1;
			
			/*id of new upload*/
			$query0="select max(id) from uploads;";
			$r = mysqli_query($link,$query0);
			$ra = mysqli_fetch_assoc($r);
			$upload_id = $ra['max(id)']+1;
			
			$query1="insert into videos values($id, '$vid_name','$uploads_dir/$username/$file_name',0,'$keywords', 0,0);";
			$query2="insert into uploads values($upload_id, $id, '$username','$datetime');";
			
			if(!is_dir("$uploads_dir/$username"))
			{
				mkdir("$uploads_dir/$username");
			}
			
			if(!file_exists("$uploads_dir/$username/$file_name"))
			{
				if(move_uploaded_file($file_tmp_name, "$uploads_dir/$username/$file_name"))
				{
					mysqli_query($link,$query1);
					mysqli_query($link,$query2);
					echo "<script>alert('Successful upload');
						window.location.replace('uploadfile.php');
					</script>";
					
				}
				else
					echo "<script>alert('Could not upload');
						window.location.replace('uploadfile.php');
					</script>";
			}
			else{
				echo "<script>alert('File already exists in database');
						window.location.replace('uploadfile.php');
					</script>";
			}
		}
		else{
			//session_destroy();
			header("location: home.php");
		}
		?>
	</body>
</html>