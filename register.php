<?php include("header.php"); ?>

<body onload="<?php echo $SIGNUP_LOADER; ?>">

    <?php

        unset($SIGNUP_LOADER);
        unset($_SESSION['signup_status']);

    ?>

    <div class="container my_container">

        <h1>Sign Up Page</h1>

        <br>

        <form action="" method="POST">

            <?php

                if (isset($_SESSION['inputted_name']))
                {
                    $INPUTTED_NAME = $_SESSION['inputted_name'];
                }

                else
                {
                    $INPUTTED_NAME = "";
                }

                if (isset($_SESSION['inputted_email']))
                {
                    $INPUTTED_EMAIL = $_SESSION['inputted_email'];
                }

                else
                {
                    $INPUTTED_EMAIL = "";
                }

                if (isset($_SESSION['inputted_pass1']))
                {
                    $INPUTTED_PASSWORD_1 = $_SESSION['inputted_pass1'];
                }

                else
                {
                    $INPUTTED_PASSWORD_1 = "";
                }

                if (isset($_SESSION['inputted_pass2']))
                {
                    $INPUTTED_PASSWORD_2 = $_SESSION['inputted_pass2'];
                }

                else
                {
                    $INPUTTED_PASSWORD_2 = "";
                }

            ?>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="text" name="signup_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $INPUTTED_NAME; ?>" required>

            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="signup_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $INPUTTED_EMAIL; ?>" required>

            </div>

            <div class="mb-3">

                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="signup_password" class="form-control" id="exampleInputPassword1" value="<?php echo $INPUTTED_PASSWORD_1; ?>" required>

            </div>

            <div class="mb-3">

                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" name="signup_confirm_password" class="form-control" id="exampleInputPassword1" value="<?php echo $INPUTTED_PASSWORD_2; ?>" required>

            </div>

            <button type="submit" class="btn btn-primary" name="register">Create Account</button>

            <p style="margin-top: 20px;">Already had an Account? <a href="login">Sign In</a></p>

        </form>

    </div>

    <?php include("footer.php"); ?>