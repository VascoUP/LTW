$(document).ready( function() { 
	$("#reg-profile-picture").click(function () {
    	$("#reg-file").trigger('click');
	});
});

function loadFile(event) {
    var image = document.getElementById('reg-profile-picture');
    image.src = URL.createObjectURL(event.target.files[0]);

    var $imageError = $('#img-error');

    var imageExtension = document.getElementById('reg-file').files[0].name.split('.').pop().toLowerCase();
    var imageFile = document.getElementById('reg-file').files[0].size;

	if(!checkImageExtension(imageExtension)) {
		$imageError.text("Only jpg/png files are allowed.");
		$imageError.fadeIn(1000);
	}
	else
		if(!checkImageSize(imageFile)) {
			$imageError.text("The image is too big. Max 20MB.");
			$imageError.fadeIn(1000);
		}
		else {
			$imageError.innerHTML = "";
			$imageError.fadeOut(1000);
		}
}

function Validate() {
	//Get the password values
	var password = document.forms['vform']['password'];
	var confirmPassword = document.forms['vform']['passwordConfirm'];
	console.log("1");

	var username = document.forms['vform']['username'];

	//Get div for error display
	var $passwordbox = $('#reg-password');
	var $confirmPasswordbox = $('#reg-confirm-password');
	var passwordConfirmError = document.getElementById('password-confirm-error');
	var $imageError = document.getElementById('img-error');
	//Allowed file extensions

	if(document.getElementById('reg-file').value) {
		var imageExtension = document.getElementById('reg-file').value.split('.').pop().toLowerCase();
		if(!checkImageExtension(imageExtension))
			return false;

		//Check image size
		var imageFile = document.getElementById('reg-file').files[0].size;
		if(!checkImageSize(imageFile))
			return false;
	}

	//Check is username is valid
	if(!checkUser(document.getElementById('reg-username').value))
		return false;

	//Check if the First Name and the Last Name is valid
	if(!checkFirstName(document.getElementById('reg-first-name').value))
		return false;

	if(!checkLastName(document.getElementById('reg-last-name').value))
		return false;

	//Checks if email is valid
	if(!checkEmail(document.getElementById('reg-email').value))
		return false;

	console.log("1");
	//Validate Password
	if(password.value != confirmPassword.value) {
		$passwordbox.css('box-shadow', '0px 0px 5px red');
		$confirmPasswordbox.css('box-shadow', '0px 0px 5px red');
		passwordConfirmError.innerHTML = "The two passwords do not match.";
		return false;
	}
	console.log("1");

	return true;
}

function checkUser(value) {

	var $usernameError = $('#check-user');
	var $username = $('#reg-username');
	var $validUser = false;

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
					if(data == 'This username is available.') {
						$username.css('box-shadow', '0px 0px 5px green');
						$usernameError.css('color', 'green');
					}
					else {
						$validUser = false;
						$username.css('box-shadow', '0px 0px 5px red');
						$usernameError.css('color', 'red');
					}
					$usernameError.text(data);
				}
			});
		} else {
			$username.css('box-shadow', '0px 0px 5px red');
			$usernameError.css('color', 'red');
			$usernameError.text('Please only use letters and/or numbers.');
		}
	}
	else {
		$username.css('box-shadow', '0px 0px 5px red');
		$usernameError.css('color', 'red');
		$usernameError.text('Please enter an username.');
	}
	return $validUser;
}

function checkEmail(value) {

	var $email = $('#reg-email');
	var $validEmail = false;

	if(value != '')
		$.ajax({
				type:"POST",
				url:"functions/validationFunctions.php",
				async:false,
				data:{
					action: 'validateEmail',
					email: value
				},
				success: function(isValid) {
					$validEmail = JSON.parse(isValid).success;

					if($validEmail)
						$email.css('box-shadow', '0px 0px 5px green');
					
					else
						$email.css('box-shadow', '0px 0px 5px red');
					
				}
		});

	return $validEmail;
}

function checkFirstName(value) {
	var $firstname = $('#reg-first-name');
	var $valid = false;

	if(value != '')
		$.ajax({
				type:"POST",
				url:"functions/validationFunctions.php",
				async:false,
				data:{
					action: 'validateName',
					name: value
				},
				success: function(isValid) {
					$valid = JSON.parse(isValid).success;
					if($valid)
						$firstname.css('box-shadow', '0px 0px 5px green');
					else { 
						$firstname.css('box-shadow', '0px 0px 5px red');
					}
				}
		});
	return $valid;
}

function checkLastName(value) {
	var $lastname = $('#reg-last-name');
	var $valid = false;

	if(value != '')
		$.ajax({
				type:"POST",
				url:"functions/validationFunctions.php",
				async:false,
				data:{
					action: 'validateName',
					name: value
				},
				success: function(isValid) {
					$valid = JSON.parse(isValid).success;
					if($valid)
						$lastname.css('box-shadow', '0px 0px 5px green');
					else { 
						$lastname.css('box-shadow', '0px 0px 5px red');
					}
				}
		});
	return $valid;
}

function checkImageExtension(fileExtension) {
	var extensions = ['jpg', 'jpeg', 'png'];

	for(var index in extensions) {

        if(fileExtension === extensions[index]) {
            return true;
        }
    }

    return false;
}

function checkImageSize(size) {

	if(size <= 20971520)
		return true;
	else
		return false;
}