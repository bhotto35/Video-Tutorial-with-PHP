<html>
	<head>
		<style>
			td{
				padding:10px;
				height:50px;
				border-top: 1px solid #242424;
				border-bottom: 1px solid #242424;
			}
			.tbl td{
				border:none;
			}
			.tr:hover{
				background:darkgray;
				color:black;
			}
			.search{
				height:20px;
				border-radius:15px;
				border:none;
				width:50%;
				padding:5px;
			}
			.btn{
				color: rgb(24,27,46);
				padding:15px;
				border:none;
				font-weight:bold;
				height:100%;
				background: greenyellow;
				outline:none;
			}
			hr{
				border-top:1px solid darkgray;
				border-bottom:none;
			}
			.btn:hover{
				color:white;
				background: lime;
			}
			btn2{
				outline:none;
			}
			.btn2:hover{
				box-shadow: 0px 0px 2px 2px yellow;
			}
			.history{
				padding:5px;
				color:white;
				background: rgba(18,19,22);
				display:none;
				position:absolute;
				text-align: left;
				box-shadow:0px 0px 2px 1px blue;
			}
			h1{
				color: white;
				text-shadow: 3px 0px 4px blue;
			}
			h2{
				color: white;
				text-shadow: 1px 2px #121212;
			}
			body{
				/*background: radial-gradient(rgba(21,37,43,1), black);*/
				background: rgba(21,37,43,1);
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<title>Video Tutorials - Home</title>
	</head>
	<body  >
		<div style="width:100%;padding:1px;background:slateblue; border:none;border-radius: 10px 10px 0px 0px;text-align:center">
		<h1><big>VIDEO TUTORIALS</big></h1><h2>Home</h2>
		</div>
		<div style="text-align:center;padding:0px;width:100%;height:45px;background:greenyellow;border-radius:0px 0px 10px 10px">
			<?php
				session_start();
				if(isset($_SESSION['username'])) // if user is logged in
				{
					echo "Logged in: ".$_SESSION['username'];
					?>
					&nbsp <a href='logout.php'><button type='button' class='btn'>Log out</button></a>
					
					&nbsp 
					<div style='display:inline-block'>
						<button type='button' class='btn' id = 'hbtn' onclick='history()'>View History</button>
						<div id ='history' class='history'></div>
					</div>
				
					&nbsp <a href='uploadfile.php'><button type='button' class='btn'>Upload Video</button></a>
					&nbsp 
					<div style='display:inline-block'><button type='button' id ='pwd'class='btn'>Change Password</button><br>
						<div style='display:none;background: greenyellow;position: absolute;padding:7px;border:1px solid yellow;border-top:none' id='changepwd'>
							<form action='changepwd.php' method='post'> <table class='tbl'>
							<tr><td>Old password:</td><td><input type='password' name='oldpwd' required></td></tr>
							<tr><td>New Password:</td><td><input type='password' name='new0' required></td></tr>
							<tr><td>Retype Password:</td><td><input type='password' name='new1' required></td></tr>
							</table>
							<div style='text-align:center'><button type='submit'>Change</button></div>
							</form>
						</div>
					</div>
					<?php
				}
				else // if no user is logged in
				{
					session_destroy();
					echo "<button class='btn' type='button' onclick='signup()'>Create account</button>";
					echo "<button class='btn'type='button' onclick='login()'>Login</button>";
					session_start();
				}
			?>
		</div>
		<br><br>
		
		<!--Div element containing Login form-->
		<div id="login" style="margin-left:75%;background:black;padding:5px;color:white;display:none;box-shadow:0px 0px 2px 1px cyan;position:absolute">
			<big> Enter credentials</big>
			<hr>
			<form action="redirect.php" method="post">
				<table style='color:white' class='tbl'>
					<tr><td>Username: </td><td><input type="text" name="username" id="username"></td></tr>
					<tr><td>Password: </td><td><input type="password" name="pwd" id="pwd"></td></tr>
				</table>
				<div style='text-align:center'><button type="submit" class="btn">Go</button></div>
			</form>
		</div>
		
		<!--Div element containing Sign-up form-->
		<div id="signup" style="margin-left:75%;background:black;padding:5px;color:white;display:none;box-shadow:0px 0px 2px 1px cyan;position:absolute">
			<big> Enter new credentials</big>
			<hr>
			<form id="signupform"action="createaccount.php" method="post">
				<table style='color:white' class='tbl'>
					<tr><td>Username: </td><td><input type="text" name="username0" id="username0"></td></tr>
					<tr><td>Password: </td><td><input type="password" name="pwd0" id="pwd0"></td></tr>
					<tr><td>Retype Password: </td><td><input type="password" name="pwd1" id="pwd1"></td></tr>
					<tr><td>Email: </td><td><input type="text" name="email" id="email"></td></tr>
				</table>
				<div style='text-align:center'><button type="button" class="btn" onclick="checkpwd()">Go</button></div>
			</form>
		</div>
		
		<!--Div containing list of videos-->
		<div id = "videos"style="width:50%;margin: 0 auto">
			<!--Div containing search area for searching videos-->
			<div style="text-align:center"><input class='search'type="text" id="keyword" onkeyup="filter()" placeholder="Search for a video..." ></div>
			<br>
		<?php
			$link= mysqli_connect("localhost","root","","vtwa");
			if(!$link)
			{
				die("Database did not connect. ".mysqli_error($link));
			}
			else{
			
				$_SESSION['vid_views']=array();
				$_SESSION['name']=array();
				$_SESSION['keywords']=array();
				$query="select * from videos inner join uploads on uploads.video_id=videos.id order by uploads.date_time DESC;";
				$result=mysqli_query($link,$query);
				echo "<table id='video_list' style='box-shadow: 0px 0px 2px 1px lightblue;width:100%;border-collapse:collapse;color:white'>
						<tr style='background:rgba(9,10,24,1)'>
							<td style='font-weight:bold;border:none' colspan='2'>
								Video
							</td>
							<td style='font-weight:bold;border:none'>
								Views
							</td>
							<td style='font-weight:bold;border:none'>
								Helped
							</td>
							<td style='font-weight:bold;border:none'>
								Didn't Help
							</td>
						</tr>
						";
				while($result_array=mysqli_fetch_assoc($result))
				{
					$add=$result_array['address'];
					$str="<tr class='tr'bgcolor='#121212'><td '>
						<form action='vidplay.php' method='post'>
						<button class='btn2'type='submit' style='padding:0px'name='sub' value='".$add."'> 
							<img src='play.png'height='30px' width='45px'></button>
							<input type='number' name='id' value='".$result_array['video_id']."' hidden></form>
							</td><td > ".$result_array['name']."</td>";
					$str=$str."<td>".$result_array['vid_views']."</td>";
					$str=$str."<td>".$result_array['pfeedback']."</td>";
					$str=$str."<td>".$result_array['nfeedback']."</td></tr>";
					$_SESSION['name'][$add]=$result_array['name'];
					$_SESSION['keywords'][$add]=$result_array['keywords'];
					$_SESSION['vid_views'][$add]=$result_array['vid_views'];
					echo $str;
				}
				echo "</form></table>";
			}
		?>
			<!--If no match is found, the div below is visible-->
			<div id="nomatch" style="margin: 0 auto;display:none; font-weight:bold;background:#121212;
				box-shadow: 0px 0px 2px 1px lightblue;padding:5px;color:pink"> No match found </div>
		</div>
		
		
		
		<script>
			var menu1_open=0;
			var menu2_open=0;
			var hist_open=0;
			var changepwd = 0;
			
			//function to filter videos that contain the keyword typed in the search bar
			function filter()
			{
				var keyword= document.getElementById("keyword").value.toUpperCase();
				var found=0;
				var rows=document.getElementById("video_list").rows.length;
				var i=0;
				for (i=1;i<rows;i++)
				{
					var x= document.getElementById("video_list").rows[i].cells.item(1).innerHTML.toUpperCase();
					if(x.includes(keyword))
					{
						document.getElementById("video_list").rows[i].style.display="";
						found=1;
					}
					else
						document.getElementById("video_list").rows[i].style.display="none";
				}
				if (found==0)
				{
					//document.getElementById("nomatch").offsetLeft=document.getElementById("video_list").offsetLeft;
					document.getElementById("nomatch").style.display="block";
					document.getElementById("nomatch").style.margin="0 auto";
				}
				else{
					document.getElementById("nomatch").style.display="none";
				}
			}
			
			//function that displays login div on click of login button
			function login()
			{
				if(menu1_open==0)
				{
					document.getElementById('login').style.display="block";
					document.getElementById('signup').style.display="none";
					menu1_open=1;
					menu2_open=0;
				}
				else{
					document.getElementById('login').style.display="none";
					menu1_open=0;
				}
				console.log("login: after:  ",menu1_open,", ",menu2_open);
			}
			
			//function that displays sign-up div on click of create account button
			function signup()
			{
				if(menu2_open==0)
				{
					document.getElementById('signup').style.display="block";
					document.getElementById('login').style.display="none";
					menu2_open=1;
					menu1_open=0;
				}
				else{
					document.getElementById('signup').style.display="none";
					menu2_open=0;
				}
				console.log("signup: after:  ",menu1_open,", ",menu2_open);
			}
			
			//function that checks if new password and retyped passwords match, for the new account
			function checkpwd()
			{
				var pwd0=document.getElementById('pwd0').value;
				var pwd1= document.getElementById('pwd1').value;
				if(pwd0!=pwd1)
				{
					alert('Passwords do not match');
				}
				else
				{
					var form=document.getElementById('signupform');
					form.submit();
				}
			}
			
			//function that displays the history of recent views
			function history()
			{
				if (hist_open==0)
				{
					$.ajax({
						url : "history.php",
						type : 'post',
						success: function(data) {
						 $('#history').html(data);
						 /*$('#history').css({"display":"block",
							'left' : $('#hbtn').offset().left - 25,
							'right' : 10,
							'top' : $('#hbtn').offset().top +$('#hbtn').height()+10
							});*/
						$('#history').css("display","block");
						 statview=0;
						},
						error: function() {
						 $('#history').text('An error occurred');
						}
					});
					hist_open=1;
				}
				else
				{
					document.getElementById('history').innerHTML="";
					document.getElementById('history').style.display="none";
					hist_open=0;
				}
			}
			$(document).ready(function(){
				$('#pwd').click(function(){
					if(changepwd==0)
					{
						document.getElementById('changepwd').style.display = 'block';
						changepwd =1;
					}
					else
					{
						document.getElementById('changepwd').style.display = 'none';
						changepwd =0;
					}
				});
			});
		</script>
	</body>
</html>