    <link rel="stylesheet" href="css/registerForm.css">
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="scripts/registrationForm.js"></script>	
</head>
<body>
    <div id="reg-form">
        <form method="POST" action="action_register.php" enctype="multipart/form-data" onsubmit="return Validate()" name="vform">
            <div hidden id='img-error'></div>
            <div id="img-reg-div">
                <img id="reg-profile-picture" src="images/no-user-image.jpg">
                <label id="choose-image" for="reg-file"> Choose an image</label>
                <input hidden id="reg-file" type="file" accept="image/png,image/jpeg" name="regProfilePic" onchange="loadFile(event)">
            </div>
            <div id="user-reg-div">
                <input id="reg-username" type="text" onblur="checkUser(this.value)" name="username" placeholder="Username" required="required" autocomplete="off" maxlength="15" />
                <span id="check-user"> Check availability</span>
            </div>
            <div id="input-reg-div">
                <input id="reg-first-name" type="text" onblur="checkFirstName(this.value)" name="firstname" placeholder="First Name" required="required" autocomplete="off" maxlength="15"/>
                <input id="reg-last-name" type="text" onblur="checkLastName(this.value)" name="lastname" placeholder="Last Name" required="required" autocomplete="off" maxlength="15"/>
            </div>
            <div id="input-reg-div">
                <input id="reg-email" type="e-mail" name="email" placeholder="email@domail.com" onblur="checkEmail(this.value)" required="required" autocomplete="off" maxlength="30"/>
            </div>
            <div id="input-reg-div">
                <input id="reg-reviewer" type="radio" name="userType" value="reviewer" checked="checked">
                <label for="reg-reviewer" id="label-reg-reviewer">Reviewer</label>
                <input id="reg-owner" type="radio" name="userType" value="owner">
                <label for="reg-owner" id="label-reg-owner">Owner</label>
            </div>
            <div id="input-reg-div">
                <input id="reg-password" type="password" name="password" placeholder="Password" required="required" maxlength="20"/>
            </div>
            <div id="input-reg-div">
                <input id="reg-confirm-password" type="password" name="passwordConfirm" placeholder="Confirm Password" required="required" maxlength="20"/>
                <div id="password-confirm-error" class="valError"></div>
            </div>
            <div id="input-reg-div">
                <input id="signup-button" type="submit" value="✓" />
            </div>
        </form>
    </div>
</body>
</html>