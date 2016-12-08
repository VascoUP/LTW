function loadFile(event) {
    var image = document.getElementById('imgRegProfilePic');
    image.src = URL.createObjectURL(event.target.files[0]);
}

function Validate() {
	//Get the password values
	var password = document.forms['vform']['password'];
	var confirmPassword = document.forms['vform']['passwordConfirm'];

	var username = document.forms['vform']['username'];

	//Get div for error display
	var passwordConfirmError = document.getElementById('passwordConfirmError');

	//Validate Password
	if(password.value != confirmPassword.value) {
		password.style.border = "1px solid red";
		confirmPassword.style.border = "1px solid red";
		passwordConfirmError.innerHTML = "The two passwords do not match.";
		return false;
	}

	var isUserTaken;

	//This should not be used, but I don't know how to do it any other way
	var userRequest = $.ajax({
			type:"POST",
			url:"Database/user.php",
			async: false,
			data:{
				action: 'isUserTaken',
				username: username.value,
			},
			success: function(data) {
				isUserTaken = data;
			}
	});

	if(isUserTaken == 'This username is taken.') return false;

	return true;
}

function checkUser(value) {

	var $usernameError = $('#usernameError');

	if(value != '')
		$.ajax({
			type:"POST",
			url:"Database/user.php",
			data:{
				action: 'isUserTaken',
				username: value,
			},
			success: function(data) {
				if(data == 'This username is available.')
					$usernameError.css('color', 'green');
				else 
					$usernameError.css('color', 'red');
				$usernameError.text(data);
			}
		});
	else {
		$usernameError.css('color', 'red');
		$usernameError.text('Please enter an username.');
	}
}


