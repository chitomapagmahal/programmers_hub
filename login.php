<?php include("header.php"); ?>

<?php

    if (isset($_SESSION['current_user'])) 
    {
        header("location: index");
    }

?>

    <body onload="<?php echo $LOGIN_LOADER; ?>">

        <?php

            unset($LOGIN_LOADER);
            unset($_SESSION['login_status']);

        ?>
    
        <div class="container my_container">

            <h1>Login Page</h1>

            <br>
        
            <form action="" method="POST">

                <?php

                    if (isset($_SESSION['login_email']))
                    {
                        $USER_EMAIL = $_SESSION['login_email'];
                    }

                    else
                    {
                        $USER_EMAIL = "";
                    }

                ?>
    
                <div class="mb-3">
        
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="login_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $USER_EMAIL; ?>" required>
        
                </div>
                
                <div class="mb-3">
                
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="login_password" class="form-control" id="exampleInputPassword1" required>
    
                </div>
     
                <button type="submit" class="btn btn-primary" name="login">Login</button>

                <p style="margin-top: 20px;">Need an Account? <a href="register">Sign Up</a></p>
            
            </form>
        
        </div>

<?php include("footer.php"); ?>