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

?>

<body>

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

    <?php

        $QUERY = "SELECT * FROM `bulletin` ORDER BY `id` DESC";
        $RESULT = mysqli_query($CONN, $QUERY);

    ?>

    <div class="container">

        <br>

        <h1 style="text-align: center; width: 80%;" class="my_head">Welcome to Programmer's <span style="border: 1px solid black; background-color: orange; font-weight: bold; border-radius: 25%;">Hub</span></h1>

        <hr>

        <?php if (mysqli_num_rows($RESULT) > 0) : ?>

            <?php while ($BULLETIN_DATA = mysqli_fetch_array($RESULT)) : ?>

                <form action="" method="POST">

                    <input type="text" name="current_data_id" value="<?php echo $BULLETIN_DATA['id']; ?>" hidden>

                    <div class="row my_row">

                        <button type="submit" name='article' class='my_link'>

                            <div class="col-12">

                                <h3><?php echo $BULLETIN_DATA['question_header']; ?></h3>

                            </div>

                        </button>

                        <small class="author">By <strong><?php echo $BULLETIN_DATA['author']; ?></strong> on <strong class="post_date"><?php echo $BULLETIN_DATA['post_date_time']; ?></strong></small>

                        <p>

                            <?php

                            if (strlen($BULLETIN_DATA['question_body']) > 250) 
                            {
                                echo substr($BULLETIN_DATA['question_body'], 0, 250) . " . . . <button type='submit' name='article' class='my_link'>Read More</button>";
                            } 
                            
                            else 
                            {
                                echo $BULLETIN_DATA['question_body'] . " . . . <button type='submit' name='article' class='my_link'>Read More</button>";
                            }

                            ?>

                        </p>
                        
                        <div style="float:left;">

                            <span class="vote"><?php echo $BULLETIN_DATA['num_of_votes']; ?> vote<?php if($BULLETIN_DATA['num_of_votes'] > 1){ echo "s";} ?></span> | 

                            <span class="vote"><?php echo $BULLETIN_DATA['num_of_answers']; ?> answer<?php if($BULLETIN_DATA['num_of_answers'] > 1){ echo "s";} ?></span>
                        
                        </div>

                    </div>

                </form>

                <hr class="my_head">

            <?php endwhile; ?>

        <?php else: ?>

            <h1 class="no_data">There is no data at the moment. Please come back later!</h1>

        <?php endif; ?>

    </div>

    <?php include("footer.php"); ?>