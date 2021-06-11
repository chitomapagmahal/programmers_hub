<?php include("header.php"); ?>

<?php

    if (isset($_SESSION['current_user'])) 
    {
        $CURRENT_USER = $_SESSION['current_user'];
    } 

    else
    {
        header("location: login");
    }

    if (isset($_SESSION['current_user_id']))
    {
        $QUERY = "SELECT `name`, `email`, `password` FROM `users` WHERE `id` = '".$_SESSION['current_user_id']."'";
        $RESULT = mysqli_query($CONN, $QUERY);

        $CURRENT_USER_DETAILS = mysqli_fetch_array($RESULT);

        $UPDATE_FULLNAME = $CURRENT_USER_DETAILS['name'];
        $UPDATE_EMAIL = $CURRENT_USER_DETAILS['email'];
        $UPDATE_PASSWORD = $CURRENT_USER_DETAILS['password'];
    }

?>

<body onload="<?php echo $UPDATE_LOADER; ?>">

    <?php
    
        unset($UPDATE_LOADER);
        unset($_SESSION['update_status']);

    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">

        <a class="navbar-brand" href="#"><strong>Programmers <span style="border: 1px solid black; background-color: orange; font-weight: bold; border-radius: 25%;">Hub</span></strong></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">

                        <a class="nav-link active" aria-current="page" href="index">Home</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" aria-current="page" href="#">About</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" aria-current="page" href="#">Contact</a>

                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" style="color: #03f33c;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $CURRENT_USER; ?></a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item text-primary" href="<?php echo $CREATE_QUESTION_TOPIC_LINK; ?>">Create Question/Topic</a></li>
                            <li><a class="dropdown-item text-success" href="update">Update Account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>

                        </ul>

                    </li>

                </ul>

                <form class="d-flex">

                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                    <button class="btn btn-outline-primary" type="submit">Search</button>

                </form>

            </div>

        </div>

    </nav>

    <!-- End TOP -->

    <div class="container">

        <div class="my_header">UPDATE ACCOUNT</div>

        <form action="" method="POST">

            <div class="mb-3">
                
                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="text" name="update_fullname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $UPDATE_FULLNAME; ?>" required>
                
            </div>

            <div class="mb-3">
                
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" name="update_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $UPDATE_EMAIL; ?>" required>
                
            </div>
            
            <div class="mb-3">
                
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="update_password" class="form-control" id="exampleInputPassword1" value="<?php echo $UPDATE_PASSWORD; ?>" required>
            
            </div>

            <div class="mb-3">
                
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" name="update_confirm_password" class="form-control" id="exampleInputPassword1" value="<?php echo $UPDATE_PASSWORD; ?>" required>
            
            </div>
             
            <button type="submit" name="update" class="btn btn-primary my_btn">Submit</button>
        
        </form>

    </div>

    <?php include("footer.php"); ?>