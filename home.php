<?php
	session_start();
	if(isset($_SESSION['user_id'])) {
		include_once 'includes/connect.inc.php';
		$usrName = ($_SESSION['user_id']);
		$sql = "SELECT * FROM users WHERE user_name='$usrName';";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		$id = $row['user_id'];
	}
	else {
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style_home.css">
</head>
<body>
	<div class="left">
		<div style="position: relative; height: 100%; width: 100%; left: -10%; top: -30%; transform: scale(0.25);">
			<?php
				echo "<img src=\"includes/profile.inc.php?id=$id\" style=\"border-radius: 50%;box-shadow: 10px 10px #0000007f; height: 100%; width: auto\">";
			?>
		</div>
		<div class="centered">
			<p>
				<?php
					echo "#".$usrName;
				?>
			</p>
		</div>
		<div class="grid-section" style="position: absolute; top: 50%; left: 5%">
			<ul class="grid">
				<li>
					<div class="box" style="background: url('./images/Home/upload_icn.png'); background-size: cover;" id="button1"></div>
				</li>
				<li>
					<div class="box" style="background: url('./images/Home/request_icn.png'); background-size: cover;" id="button2"></div>
				</li>
				<li>
					<div class="box" style="background: url('./images/Home/edit_icn.png'); background-size: cover;" id="button3"></div>
				</li>
				<li>
					<div class="box" style="background: url('./images/Home/signout_icn.png'); background-size: cover;" id="button4"></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="center">
		<?php
			$sql = "SELECT * FROM posts WHERE (uploaded_by IN (SELECT Friend_name FROM friendship WHERE Person_name='$usrName' AND status = '1')) OR uploaded_by='$usrName' ORDER BY `time` DESC";
			if($result = mysqli_query($conn, $sql)) {
				while($row =  mysqli_fetch_array($result)) {
					echo "<div class=\"post\">";
						echo "<div style=\"position: relative;\">";
						$n = $row['uploaded_by'];
						$s = "SELECT * FROM users WHERE user_name='$n'";
						$r = mysqli_query($conn, $s);
						$w =  mysqli_fetch_array($r);
						$i = $w['user_id'];
							echo "<img src=\"includes/profile.inc.php?id=$i\" style=\"border-radius: 50%;box-shadow: 3px 3px #4d4d4d10; height: 9%; width: 9%\">";
							echo "<p style=\"position: absolute; left: 12%; bottom: 0px\">#".$row['uploaded_by']."</p>";
						echo "</div>";
						if(!empty($row['Caption'])) {
							echo "<p>";
								echo $row['Caption'];
							echo "</p>";						
						}
						if(!empty($row['photo'])) {
							echo "<div>";
							$sr = $row['sr_no'];
								echo "<img src=\"includes/posts.inc.php?sr_no=$sr\" style=\"height: auto; width: 100%\">";
							echo "</div>";
						}
					echo "</div>";
				}
			}
		?>
	</div>
	<div class="container" id="container" style="display: none;">
			<div class="card" id="upload">
				<img src="images/Home/close_icn.png" style=" transform: scale(0.1); position: fixed; right: -30%; top: -43%; border-radius: 50%; cursor: pointer;" id="close1">
				<div style="position: relative; width: 85%; height: 15%; left: 7.5%; top:  7.5%; background-color: #FFFFFF00; padding-bottom: 7.5%;">
					<div style="width: 100%; height: 100%; background-image: url('images/Home/add_icn.png'); background-size: 40px 40px; background-position: 275px 15px; background-repeat: no-repeat; cursor: pointer; overflow-y: hidden;" id="image">
						<img src="images/Home/blank.png" id="button_image" style="position: relative; width: 100%; height: auto;  bottom: 250%">
						<img src="images/Home/add_icn.png" style="position: relative; height: 60%; width: auto; top: -790%;">
					</div>
				</div>
				<form action="includes/uploadpost.inc.php" method="POST" enctype="multipart/form-data">
					<input type="file" id="profile" style="display: none;" name="profile">
					<input class="caption" type="text" name="caption" placeholder="Caption Here...">
					<button class="submit" name="post" style="position: absolute;top: 80%; left: 23%;">UPLOAD</button>
					<script type="text/javascript">
						document.getElementById("profile").onchange = function() {
							var reader = new FileReader();
							reader.onload = function (e) {
								document.getElementById('button_image').src = e.target.result;
							};
							reader.readAsDataURL(this.files[0]);
						}
					</script>
					<script>
						var file = document.getElementById('profile');
						document.getElementById('image').onclick = function() {
							profile.click();
						}
					</script>
				</form>
			</div>
			<div class="card" id="request">
				<img src="images/Home/close_icn.png" style=" transform: scale(0.1); position: fixed; right: -30%; top: -43%; border-radius: 50%; cursor: pointer;" id="close2">
				<?php
					$sql = "SELECT * FROM friendship WHERE Person_name='$usrName' AND status = '0'";
					if($result = mysqli_query($conn, $sql)) {
						while($row =  mysqli_fetch_array($result)) {
							echo "<div class=\"post\">";
								echo "<div style=\"position: relative; padding-top: 10px; padding-bottom: 0px\">";
								$n = $row['Friend_name'];
								$s = "SELECT * FROM users WHERE user_name='$n'";
								$r = mysqli_query($conn, $s);
								$w =  mysqli_fetch_array($r);
								$i = $w['user_id'];
									echo "<p style=\"position: absolute; left: 12%; bottom: 5px\">#".$row['Friend_name']."</p>";
									echo "<img src=\"includes/profile.inc.php?id=$i\" style=\"border-radius: 50%;box-shadow: 3px 3px #4d4d4d10; height: 9%; width: 9%; position: relative; left: -45%\">";
									echo "<form action=\"includes/requests.inc.php?sr=".$row['Sr_No']."\" method=\"POST\">";
										echo "<button name=\"accept\" style=\"position: absolute; top: 40%; right: 30%; background-color: #28170bcc; border: none; color: white; width: 15%; height: 25px; text-align: center; font-size: 12px; font-family: Adobe Gothic Std; cursor: pointer; transition: all 0.2s ease;\">ACCEPT</button>";
										echo "<button name=\"reject\" style=\"position: absolute; top: 40%; right: 10%; background-color: #28170bcc; border: none; color: white; width: 15%; height: 25px; text-align: center; font-size: 12px; font-family: Adobe Gothic Std;cursor: pointer; transition: all 0.2s ease;\">REJECT</button>"; 
									echo "</form>";
								echo "</div>";
							echo "</div>";
						}
					}
				?>
			</div>
			<div class="card" id="edit">
				<img src="images/Home/close_icn.png" style=" transform: scale(0.1); position: fixed; right: -30%; top: -43%; border-radius: 50%; cursor: pointer;" id="close3">
				<div style="width: 15%; height: 100%; transform: scale(0.4);">
					<?php
						echo "<img src=\"includes/profile.inc.php?id=$id\" style=\"border-radius: 50%;box-shadow: 10px 10px #4d4d4d10; height: 100%; width: auto\" id=\"display\">"
					?>
					<img src="images/Signup/importSRC.png" id="display_sudo" style="transform: scale(2); position: absolute; bottom: 5%; cursor: pointer;">
					<form style="position: absolute; top: -50%; left: 525%; width: 1000px; height: 200%;" action = "includes/update.inc.php" method="POST" enctype="multipart/form-data">
						<input type="text" class="input" placeholder="new Email" style="position: absolute; top: 15%; left: 40%" name="newemail">
						<input type="password" class="input" placeholder="old password" style="position: absolute; top: 35%; left: 40%" name="oldpswd">
						<input type="password" class="input" placeholder="new password" style="position: absolute; top: 55%; left: 40%" name="newpswd">
						<button class="submit" name="update" style="position: absolute;bottom: 14%;left: 40%;transform: scale(2.5);width: 25%;">UPDATE</button>
						<input type="file" id="display_profile" style="display: none;" name = "display_profile">
						<script type="text/javascript">
							document.getElementById("display_profile").onchange = function() {
								var reader = new FileReader();
								reader.onload = function (e) {
									document.getElementById("display").src = e.target.result;
								};
								reader.readAsDataURL(this.files[0]);
							}
						</script>
					</form>
					<script type="text/javascript">
						document.getElementById("display_sudo").onclick = function() {
							document.getElementById("display_profile").click();
						}
					</script>
				</div>
		</div>
	</div>
		<div style="height: 100%; width: 28%; position: fixed; right: 0; top:0; background-color: #FF000000">
			<div style="width: 100%; height: 10%; background-color: #b17421ff">
				<p style="position: absolute; right: 33%; bottom: 87%; font-size: 25px; font-family: Adobe Gothic Std; color: #ffffff;">Find Friends</p>
			</div>
			<div  style="width: 100%; position: absolute; top: 10%; height: 90%; background-color: #2b11005f; overflow-y: scroll; overflow-x: hidden;">
				<?php
					$sql = "SELECT * FROM `users` WHERE `user_name` NOT IN (SELECT Person_name FROM friendship WHERE Friend_name='$usrName') AND `user_name` != '$usrName'";
					if($result = mysqli_query($conn, $sql)) {
						while($row =  mysqli_fetch_array($result)) {
							echo "<div style=\"width: 100%; height: 10%; background-color: #FF000000; padding-top: 7px; padding-bottom: 7px;\">";
								$i = $row['user_id'];
								echo "<img src=\"includes/profile.inc.php?id=$i\" style=\"border-radius: 50%; box-shadow: 3px 3px #4d4d4d10; height: 80%; width: auto; position: relative; left: 5%\">";
								echo "<p style=\"position: relative; top: -95%; right: -22%; font-family: Adobe Gothic Std; color: #FFFFFF\">#".$row['user_name']."</p>";
								echo "<form style=\"position: relative; top: -158%\" action=\"includes/friends.inc.php?friend=".$row['user_name']."\" method=\"POST\">";
									echo "<button style=\"position: relative; top: -95%; right: -68%; background-color: #28170bcc; border: none; color: white; width: 18%; height: 25px; text-align: center;font-size: 12px; font-family: Adobe Gothic Std; cursor: pointer;\" name=\"friend\">REQUEST</button>";
								echo "</form>";
							echo "</div>";
						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	document.getElementById("button1").onclick = function() {
		document.getElementById("close1").click();
		document.getElementById("close2").click();
		document.getElementById("close3").click();
		document.getElementById("container").style.display = 'block'
		document.getElementById("upload").style.transform = 'rotateX(0deg)';
	}

	document.getElementById("close1").onclick = function() {
		document.getElementById("upload").style.transform = 'rotateX(90deg)';
		document.getElementById("container").style.display = 'none'
	}

	document.getElementById("button2").onclick = function() {
		document.getElementById("close1").click();
		document.getElementById("close2").click();
		document.getElementById("close3").click();
		document.getElementById("container").style.display = 'block'
		document.getElementById("request").style.transform = 'rotateX(0deg)';
	}

	document.getElementById("close2").onclick = function() {
		document.getElementById("request").style.transform = 'rotateX(90deg)';
		document.getElementById("container").style.display = 'none'
	}

	document.getElementById("button3").onclick = function() {
		document.getElementById("close1").click();
		document.getElementById("close2").click();
		document.getElementById("close3").click();
		document.getElementById("container").style.display = 'block'
		document.getElementById("edit").style.transform = 'rotateX(0deg)';
	}

	document.getElementById("close3").onclick = function() {
		document.getElementById("edit").style.transform = 'rotateX(90deg)';
		document.getElementById("container").style.display = 'none'
	}

	document.getElementById("button4").onclick = function() {
		window.location.href = "index.php";
	}
</script>