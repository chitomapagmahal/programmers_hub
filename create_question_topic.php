<?php include("header.php"); ?>

<?php

if (isset($_SESSION['current_user'])) {
    $CURRENT_USER = $_SESSION['current_user'];
} else {
    header("location: login");
}

?>

<body onload="<?php echo $CREATE_QT_LOADER; ?>">

    <?php
    
        unset($CREATE_QT_LOADER);
        unset($_SESSION['create_qt_status']);

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

    <!-- END TOP -->

    <!-- START CONTENT -->

    <div class="container">

        <div class="my_header">CREATE QUESTION/TOPIC</div>

        <form actions="" method="POST">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Author Name</label>
                <input type="text" name="create_qt_author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['current_user']; ?>" readonly>

            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Question/Topic Head</label>
                <input type="text" name="create_qt_head" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Explanation of the Question/Topic</label>

                <div>

                    <textarea name="create_qt_body" class="form-control" style="height: 200px"></textarea>
                
                </div>

            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;" name="create_qt">Submit</button>
        
        </form>

    </div>

    <!-- END CONTENT -->

    <?php include("footer.php"); ?>