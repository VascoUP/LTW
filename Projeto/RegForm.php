<?php
	include ('/config/init.php');
	include ('templates/head.php');
?>
    <script type="text/javascript" src="scripts/registrationForm.js"></script>	
</head>
<body>
    <div id="Reg_Form" class="Register_Center Text_Align_Center">
        <form class="class_form">
            <h3> Register </h3>
            <label for="regProfilePic">
                <img class="imgRegProfilePic" src="images/no-user-image.jpg">
            </label>
            <input hidden id="regProfilePic" type="file" onchange="loadFile(event)">
            <p>Username</p>
            <input type="text" name="username" placeholder="Username"/>
            <p>Password</p>
            <input type="password" name="password" placeholder="Password"/>
            <p>Full Name</p>
            <input type="text" name="firstname"/>
            <input type="text" name="lastname"/>
            <p>Email</p>
            <input type="e-mail" name="email"/>
            <p>Age</p>
            <input type="text" name="age"/>
            <p>Bios</p>
            <textarea rows="4" cols="50" name="bios"> </textarea>
            <p>Address</p>
            <input type="text" name="address"/>
            <input class="style_button" type="button" value="Register" />
        </form>
    </div>
</body>
</html>