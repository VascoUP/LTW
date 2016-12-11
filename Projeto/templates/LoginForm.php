<div hidden class="black-screen">
</div>
<div hidden id="login-form">
	<img id="login-profile-picture" src="images/no-user-image.jpg">
	<form class="class_form" id="login_form" method="POST" action="action_login.php">
		<input id="login-username" type="text" name="username" placeholder="Username" onblur="loadFile(this.value)"/>
		<input id="login-password" type="password" name="password" placeholder="Password"/>
		<input id="signin-button" type="submit" value="Sign in" />
	</form>
</div>
