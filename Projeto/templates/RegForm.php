<script type="text/javascript" src="scripts/registrationForm.js"></script>	
</head>
<body>
    <div id="Reg_Form" class="Register_Center">
        <h1 class="Text_Align_Center"> Sign Up </h1>
        <form class="class_form" method="POST" action="action_register.php" onsubmit="return Validate()" name="vform">
            <div class="Text_Align_Center">
                <label for="regProfilePic">
                    <img id="imgRegProfilePic" width=200 height=200 src="images/no-user-image.jpg">
                </label>
            <input hidden id="regProfilePic" type="file" name="regProfilePic" onchange="loadFile(event)">
            </div>
            <div>
                <label for="regUsername"> Username: 
                    <input id="regUsername" type="text" name="username" placeholder="Username" required="required" />
                </label>
                <span id="usernameError" class="regError"> </span>
            </div>
            <div>
                <label for="regFullName"> Name: 
                    <input id="regFullName" type="text" name="firstname" placeholder="First Name" required="required"/>
                    <input id="regFullName" type="text" name="lastname" placeholder="Last Name" required="required"/>
                </label>
            </div>
            <div>
                <label for="regEmail"> Email: 
                    <input id="regEmail" type="e-mail" name="email" placeholder="Email" required="required"/>
                </label>
            </div>
            <div>
                <input type="radio" name="userType" value="reviewer" checked="checked">Reviewer
                <input type="radio" name="userType" value="owner">Owner
            </div>
            <div>
                <label for="regPassword"> Password: 
                    <input id="regPassword" type="password" name="password" placeholder="Password" required="required"/>
                </label>
            </div>
            <div>
                <label for="regConfirmPassword"> Confirm Password: 
                    <input id="regConfirmPassword" type="password" name="passwordConfirm" placeholder="Confirm Password" required="required"/>
                </label>
                <div id="passwordConfirmError" class="valError"></div>
            </div>
            <div>
                <input class="style_button" type="submit" value="Register" />
            </div>
        </form>
    </div>
</body>
</html>