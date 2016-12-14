$(document).ready( function() { hearder_buttons() } )

function hearder_buttons () {
	loadHeaderHandlers( $('#log_site').children('li') );
	$('.black-screen').first().click(
		function() {
			hideForms();
		});
}

function loadHeaderHandlers ( liElems ) {
	for( var i = 0; i < liElems.length; i++ ) {	
		var type = $(liElems[i]).children('input').attr('id');
		if( type == 'Logout_Button' ) {
			$(liElems[i]).children('form').click(
				function() {
					logoutButton();
			});
		} else if( type == 'loginButton') {
			$(liElems[i]).children('input').click(
				function() {
					loginButton();
			});
		} else if( type == 'Reg_Button') {
			$(liElems[i]).children('input').click(
				function() {
					registerButton();
			});
		}
	}
}

function hideForms () {
	$('.black-screen').first().fadeOut(300);
	$('#login-form').first().fadeOut(300);
}

function registerButton () {
    var url = (window.location.href).substring( 0, (window.location.href).lastIndexOf( "/" ) + 1) + "RegForm.php"
    window.location.href = url;
}

function loginButton () {
	$('.black-screen').first().fadeIn(200);
	$('#login-form').first().fadeIn(300);
}

function loadFile(value) {
	var $profilePicture = $('#login-profile-picture');

    if(value != "") {
    	$.ajax({
			type:"POST",
			url: "Database/user.php",
			data: {
				action: 'getProfilePicture',
				username: value
			},
			success: function(data) {
				console.log(data);
				$picture = JSON.parse(data).ProfilePicture;
				var url = "Database/ProfilePictures/Thumbnail/".concat($picture);
				if($picture && $picture != "NULL") {
					$profilePicture.fadeOut(0).attr('src', url).fadeIn(500);
				} else {
					if($profilePicture.attr('src') != 'images/no-user-image.jpg') {
    					$profilePicture.fadeOut(0).attr('src', 'images/no-user-image.jpg').fadeIn(250);
    				}
				}
			}
		});
    } else {
    	if($profilePicture.attr('src') != 'images/no-user-image.jpg') {
    		$profilePicture.fadeOut(0).attr('src', 'images/no-user-image.jpg').fadeIn(250);
    	}
    }
}

function validateLogin() {
	$username = $('#login-username');
	$password = $('#login-password');
	$usernameText = $('#login-username').val();
	$passwordText = $('#login-password').val();

	var $validUser = false;
	
	if($usernameText != "" && $passwordText != "") {
		$.ajax({
			type:"POST",
			url: "Database/user.php",
			async: false,
			data: {
				action: 'verifyUser',
				username: $usernameText,
				password: $passwordText 
			},
			success: function(data) {
				$validUser = JSON.parse(data).success;
			}
		});
		if(!$validUser) {
			$username.css("box-shadow", "0px 0px 5px red");
			$password.css("box-shadow", "0px 0px 5px red");
			$username.effect("shake", {distance: 5});
			$password.effect("shake", {distance: 5});
		}
	}

	if($usernameText == "" && $passwordText != "") {
		$username.css("box-shadow", "0px 0px 5px red");
		$username.effect("shake", {distance: 5});
	}

	if($usernameText != "" && $passwordText == "") {
		$password.css("box-shadow", "0px 0px 5px red");
		$password.effect("shake", {distance: 5});
	}

	if($usernameText == "" && $passwordText == "") {
		$username.css("box-shadow", "0px 0px 5px red");
		$password.css("box-shadow", "0px 0px 5px red");
		$username.effect("shake", {distance: 5});
		$password.effect("shake", {distance: 5});
	}

	return $validUser;
}

function showScrollDown() {
	$('#ProfileScrollDown').toggle(200);
}

function toggleButtons() {

	$('.HeaderButton').toggle(200);
}

function showSearchDropdown() {
	$('.searchOption').each(function(index) {
		$(this).toggle(100);
	});
}

function editRestaurant() {
	$url = $(location).attr('href');
	$restaurantID = $url.substring($url.indexOf("id") + 3, $url.indexOf("id") + 4);

	$editPageUrl = (window.location.href).substring( 0, (window.location.href).lastIndexOf( "/" ) + 1) + "edit_restaurant.php?id=" + $restaurantID;
	window.location.href = $editPageUrl;
}

function editProfile() {
	$url = $(location).attr('href');
	$username = $url.substring($url.indexOf("username=") + 9);
	console.log($username);
	$editPageUrl = (window.location.href).substring( 0, (window.location.href).lastIndexOf( "/" ) + 1) + "edit_profile.php?username=" + $username;
	window.location.href = $editPageUrl;
}