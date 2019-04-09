<!DOCTYPE html>
<html>
<head>
	<title>Landing Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/croppie.js"></script>
</head>
<body>
	<div class = "right">
		<div class="centered">
			<div class="container" style="transform: scale(1.15);">
				<div id="card" class="card">
					<!--Login Page-->
					<div class="front">
						<h1>LOGIN</h1>
						<form action = "includes/login.inc.php" method="POST">
							<input type="text" class="user" name="usrName" placeholder="User Name" style="margin-top: 35px;" required>
							<input type="password" name="pswd" class="password" placeholder="Password" required>
							<br/><a style="font-family: sans-serif; font-size: 12px; color: #3e3748ff; margin-bottom: 40px" href="#">Forgot Password?</a><br/>
							<button class="submit" name="login">LOGIN</button>
						</form>
						<p style="font-family: sans-serif; font-size: 12px; color: #3e3748ff; margin-bottom: 0px">Don't have an account yet?</br>Sign up now</p>
						<div class="arrow" id="flip" style="margin-top: 10px;"></div>
						<script>
							var card = document.getElementById('card');
							flip.onclick = function() {
								card.style.transform = 'rotateY(180deg)';
							}
						</script>
					</div>
					<!--SignUp Page-->
					<div class="back">
						<h1></h1>
						<div style="top: -25%;position: relative; left: 27%; height: 30%; width: 30%;">
							<img src="images/Signup/userDefault.png" style="border-radius: 50%;box-shadow: 5px 5px #4d4d4d10; height: 100%; width: auto" id="profile_image">
							<script>
								profile_image.onclick = function() {
									var el = document.getElementById('profile_image');
									var resize = new Croppie(el, {
									    viewport: { width: 100, height: 100 },
									    boundary: { width: 300, height: 300 },
									    showZoomer: false,
									    enableResize: true,
									    enableOrientation: true,
									    mouseWheelZoom: 'ctrl'
									});
									resize.bind({
									    url: el.src,
									});
								}
							</script>
						</div>
						<div style="top: -35%; position: relative; left: -15%;">
							<img src="images/Signup/importSRC.png" id="sudo" style="transform: scale(0.6); cursor: pointer;">
							<script>
								var file = document.getElementById('profile');
								sudo.onclick = function() {
									profile.click();
								}
							</script>
						</div>
						<form style="top: 23%;position: absolute;" action = "includes/signup.inc.php" method="POST" enctype="multipart/form-data">
							<input type="text" class="user" name="usrName" placeholder="User Name" style="top: -25%;" required>
							<input type="text" class="email" name="email" placeholder="Email" required>
							<input type="password" name="pswd" class="password" placeholder="Password" required>
							<input type="password" name="repswd" class="password" placeholder="Re-Password" required>
							<button class="submit" name="signup" style="position: absolute;top: 105%;left: 23%;">SIGN UP</button>
							<input type="file" id="profile" style="display: none;" name = "profile">
							<script type="text/javascript">
								document.getElementById("profile").onchange = function() {
									var reader = new FileReader();
									reader.onload = function (e) {
										document.getElementById("profile_image").src = e.target.result;
									};

									reader.readAsDataURL(this.files[0]);
								}
							</script>
						</form>
						<p style="font-family: sans-serif;font-size: 12px;color: #3e3748ff;margin-bottom: 0px;position: absolute;top: 88%;left: 28%;">Already have an account?<br>Login now</p>
						<div class="arrow" id="flipRev" style="transform: scale(-0.75);margin-top: 5px;position: absolute;top: 93%;left: 57%;"></div>
						<script>
							var card = document.getElementById('card');
							flipRev.onclick = function() {
								card.style.transform = 'rotateY(360deg)';
							}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>