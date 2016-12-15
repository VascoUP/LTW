<?php
	$username = $_SESSION['username'];
	if( !$username || $username != $_GET['username'])
        	header ('Location: Error.php');

	$userInfo = getUserInfoPhp($username);
	$userReviews = getUserReviews($username);
	$userFavourites = getUserFavourites($username);    
?>

<div id="reg-form">
    <form method="POST" action="Database/updateProfile.php" name="vform" onsubmit="return updateProfile()">
        <div hidden id='img-error'></div>

        <div id="img-reg-div">
            <img id="reg-profile-picture" src="images/no-user-image.jpg">
            <label id="choose-image" for="reg-file"> Choose an image</label>
            <input hidden id="reg-file" type="file" accept="image/png,image/jpeg" name="regProfilePic" onchange="loadFile(event)">
        </div>

        <div id="user-reg-div">
            <input id="reg-username" type="text" onblur="checkUser(this.value)" name="username" value=<?=$userInfo['Username']?> required="required" autocomplete="off" maxlength="15" />
            <span id="check-user"> Check availability</span>
        </div>

        <div id="input-reg-div">
            <input id="reg-first-name" type="text" onblur="checkFirstName(this.value)" name="firstname" value=<?=$userInfo['FirstName']?> required="required" autocomplete="off" maxlength="15"/>
            <input id="reg-last-name" type="text" onblur="checkLastName(this.value)" name="lastname" value=<?=$userInfo['LastName']?> required="required" autocomplete="off" maxlength="15"/>
        </div>

        <div id="input-reg-div">
            <input id="reg-email" type="e-mail" name="email" value=<?=$userInfo['Email']?> onblur="checkEmail(this.value)" required="required" autocomplete="off" maxlength="30"/>
        </div>

        <div id="input-reg-div">
            <input id="reg-old-password" type="password" name="oldpassword" placeholder="Old Password" maxlength="20"/>
        </div>

        <div id="input-reg-div">
            <input id="reg-password" type="password" name="password" placeholder="New Password" maxlength="20"/>
        </div>

        <div id="input-reg-div">
            <input id="reg-confirm-password" type="password" name="passwordConfirm" placeholder="Confirm Password" maxlength="20"/>
            <div id="password-confirm-error" class="valError"></div>
        </div>

        <div id="input-reg-div">
            <input id="update" type="submit" value="✓" />
        </div>
    </form>
</div>
