function loadFile(event) {
    var image = document.getElementById('imgRegProfilePic');
    image.src = URL.createObjectURL(event.target.files[0]);

    var $imageError = document.getElementById('imgError');

    var imageExtension = document.getElementById('regProfilePic').files[0].name.split('.').pop().toLowerCase();
    var imageFile = document.getElementById('regProfilePic').files[0].size;

	if(!checkImageExtension(imageExtension))
		$imageError.innerHTML = "Only jpg/png files are allowed.";
	else
		$imageError.innerHTML = "";

	if(!checkImageSize(imageFile))
		$imageError.innerHTML = "The image is too big. Max 20MB.";
	else
		$imageError.innerHTML = "";
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
	var $imageError = document.getElementById('imgError');

	//Allowed file extensions
	var imageExtension = document.getElementById('regProfilePic').value.split('.').pop().toLowerCase();
	if(!checkImageExtension(imageExtension))
		return false;

	//Check image size
	var imageFile = document.getElementById('regProfilePic').files[0].size;
	if(!checkImageSize(imageFile))
		return false;

	//Check is username is valid
	if(!checkUser(document.getElementById('regUsername').value))
		return false;

	//Check if the First Name and the Last Name is valid
	if(!checkFirstName(document.getElementById('regFirstName').value))
		return false;

	if(!checkLastName(document.getElementById('regLastName').value))
		return false;

	//Checks if email is valid
	if(!checkEmail(document.getElementById('regEmail').value))
		return false;

	//Validate Password
	if(password.value != confirmPassword.value) {
		$passwordbox.css('box-shadow', '0px 0px 5px red');
		$confirmPasswordbox.css('box-shadow', '0px 0px 5px red');
		passwordConfirmError.innerHTML = "The two passwords do not match.";
		return false;
	}

	return true;
}

function checkUser(value) {

	var $usernameError = $('#usernameError');
	var $username = $('#regUsername');
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

	var $email = $('#regEmail');
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
	var $firstname = $('#regFirstName');
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
	var $lastname = $('#regLastName');
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