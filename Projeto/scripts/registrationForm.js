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
	var $passwordbox = $('#regPassword');
	var $confirmPasswordbox = $('#regConfirmPassword');
	var passwordConfirmError = document.getElementById('passwordConfirmError');

	//Validate Password
	if(password.value != confirmPassword.value) {
		$passwordbox.css('box-shadow', '0px 0px 5px red');
		$confirmPasswordbox.css('box-shadow', '0px 0px 5px red');
		passwordConfirmError.innerHTML = "The two passwords do not match.";
		return false;
	}

	var isUserTaken = document.getElementById('usernameError').textContent;
	if(isUserTaken == 'This username is taken.' || isUserTaken == 'Please only use letters and/or numbers.')
		return false;

	var isValidEmail = document.getElementById('emailError').textContent;
	if(isValidEmail == '') 
		checkEmail(document.getElementById('regEmail').value);
	if(isValidEmail == 'Not a valid email.') return false;

	return true;
}

function checkUser(value) {

	var $usernameError = $('#usernameError');
	var $validUser;

	if(value != '') {

		$.ajax({
			type:"POST",
			url: "functions/validationFunctions.php",
			async: false,
			data: {
				action: 'validateUsername',
				username: value
			},
			success: function(isValid) {
				$validUser = JSON.parse(isValid).success;
			}
		});

		if($validUser) {
			$.ajax({
				type:"POST",
				url:"Database/user.php",
				data:{
					action: 'isUserTaken',
					username: value
				},
				success: function(data) {
					if(data == 'This username is available.')
						$usernameError.css('color', 'green');
					else 
						$usernameError.css('color', 'red');
					$usernameError.text(data);
				}
			});
		} else {
			console.log($validUser);
			$usernameError.css('color', 'red');
			$usernameError.text('Please only use letters and/or numbers.');
		}
	}
	else {
		$usernameError.css('color', 'red');
		$usernameError.text('Please enter an username.');
	}
}

function checkEmail(value) {

	var $emailError = $('#emailError');
	var $email = $('#regEmail');

	if(value != '')
		$.ajax({
				type:"POST",
				url:"functions/validationFunctions.php",
				async:false,
				data:{
					action: 'validateEmail',
					email: value
				},
				success: function(data) {
					if(data == 'Valid email.')
						$emailError.css('color', 'green');
					else { 
						$email.css('box-shadow', '0px 0px 5px red');
						$emailError.css('color', 'red');
					}
					$emailError.text(data);
				}
		});
	else {
		$emailError.css('color', 'red');
		$emailError.text('Please enter an email.');
	}
}


