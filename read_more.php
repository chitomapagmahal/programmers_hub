<?php include("header.php"); ?>

<?php

if (isset($_SESSION['current_user'])) {
    $CURRENT_USER = $_SESSION['current_user'];
} else {
    header("location: login");
}

?>

<body onload="<?php echo $READ_MORE_LOADER; ?>">

    <?php
    
        unset($READ_MORE_LOADER);
        unset($_SESSION['comment_status']);

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

    <?php

    $QUERY = "SELECT * FROM `bulletin` WHERE id='" . $_SESSION['current_data_id'] . "';";
    $RESULT = mysqli_query($CONN, $QUERY);

    ?>

    <div class="container">

        <br>

        <?php if (mysqli_num_rows($RESULT) > 0) : ?>

            <?php while ($BULLETIN_DATA = mysqli_fetch_array($RESULT)) : ?>

                <div class="row my_row">

                    <h3><?php echo $BULLETIN_DATA['question_header']; ?></h3>
                    <small class="author">By <strong><?php echo $BULLETIN_DATA['author']; ?></strong> on <strong class="post_date"><?php echo $BULLETIN_DATA['post_date_time']; ?></strong></small>

                    <p class="job_desc">

                        <?php echo $BULLETIN_DATA['question_body']; ?>

                    </p>

                    <div style="float:left;">

                        <span class="vote"><?php echo $BULLETIN_DATA['num_of_votes']; ?> vote<?php if ($BULLETIN_DATA['num_of_votes'] > 1) {
                                                                                                    echo "s";
                                                                                                } ?></span> |

                        <span class="vote"><?php echo $BULLETIN_DATA['num_of_answers']; ?> answer<?php if ($BULLETIN_DATA['num_of_answers'] > 1) {
                                                                                                        echo "s";
                                                                                                    } ?></span>

                    </div>

                </div>

                <hr class="my_head">

            <?php endwhile; ?>

        <?php endif; ?>
        
        <!-- COMMENTS -->
        <?php

            $QUERY = "SELECT * FROM `bulletin` WHERE `id`='". $_SESSION['current_data_id'] ."' ";
            $RESULT = mysqli_query($CONN, $QUERY);

            if (mysqli_num_rows($RESULT) > 0)
            {
                $POST_DATA = mysqli_fetch_array($RESULT);
                $_SESSION['author_id'] = $POST_DATA['author_id'];
            }

            $QUERY = "SELECT * FROM `comments` WHERE `author_id` = '". $_SESSION['author_id'] ."' ORDER BY `id` DESC";
            $RESULT = mysqli_query($CONN, $QUERY);

        ?>

        <h1>Comments</h1>

        <div class="comments">

        <?php if(mysqli_num_rows($RESULT) > 0): ?>

            <?php while($COMMENT_DATA = mysqli_fetch_array($RESULT)): ?>

                    <p class="comment_body"><strong><?php echo $COMMENT_DATA['comment_body']; ?></strong></p>
                    <small class="comment_author"><strong><?php echo $COMMENT_DATA['comment_author']; ?></strong> left a comment on <strong class="post_date"><?php echo $COMMENT_DATA['comment_date_time']; ?></strong></small>

                    <br><br>
            <?php endwhile; ?>

        <?php else: ?>

            <h5 class="no_data_comments">There are no comments at the moment. Please come back later!</h5>

        <?php endif; ?>

        </div>

        <hr>
        <br>

        <!-- POST COMMENT -->
        <h1>Post Comment</h1>

        <form actions="" method="POST">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="comment_author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['current_user']; ?>" readonly>

            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Comment</label>

                <div>

                    <textarea name="comment_body" class="form-control" style="height: 200px" required></textarea>

                </div>

            </div>

            <button type="submit" class="btn btn-primary" style="margin-bottom: 15px;" name="comment">Post Comment</button>

        </form>

    </div>

    <?php include("footer.php"); ?>