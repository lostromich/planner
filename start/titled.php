<html>
	<head>
		<title>Wander</title>
		<script type="text/javascript" src="coop/jquery-1.10.2.min.js"></script><!--this loads the jquery library-->
		<script type='text/javascript' src='titled.js'></script>
		<link type="text/css" rel="stylesheet" href ="titled.css"/>
	</head>
	<body>
		<div id='header'>
			<div id='thwrapper'>
				<button type='button' onclick='backward()'>Backward</button>
				<div id='timeheader'>
					<script>timeHeader()</script>
				</div>
				<button type='button' onclick='forward()'>Forward</button>
				<a id='logIn' onclick='openLogIn()'>Log In</a>
			</div>
		</div>
		<div id="month"></div>
		<div id="logInForm">
		    <form name='login' action='titledLogin.php' method='post'>
				<a id = "x" onclick="closeLogIn()">close</a>
				<p>Username</p><input type="text" name="username" class="logininput">
				<p>Password</p><input type="text" name="password" class="logininput">
				<input type='submit' name='submit' id='submit' value='Login'>
            </form>
		</div>
	</body>
</html>