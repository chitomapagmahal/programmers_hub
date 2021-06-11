<?php

    date_default_timezone_set('Asia/Manila');

    $DATE_TIME_NOW = date("m-d-Y h:i:s a");

    session_start(); // cache

    /* Set database connection */

    /* get all DB parameters */
    $SERVER = "localhost";
    $USER = "root";
    $PASS = "";
    $DATABASE = "practice_php";

    /* setup DB connection string */

    $CONN = mysqli_connect($SERVER, $USER, $PASS, $DATABASE);

    if (!$CONN)
    {
        die("Error in Database Connection!");
    }

    /* LOGIN */

    if (isset($_POST['login']))
    {
        /* get all POST data from the login form */
        $LOGIN_EMAIL = mysqli_real_escape_string($CONN, $_POST['login_email']);
        $LOGIN_PASSWORD = mysqli_real_escape_string($CONN, $_POST['login_password']);

        $_SESSION['login_email'] = $LOGIN_EMAIL;

        $QUERY = "SELECT * FROM `users` WHERE `email` = '". $LOGIN_EMAIL ."' AND `password` = '". $LOGIN_PASSWORD ."' LIMIT 1";
        $RESULT = mysqli_query($CONN, $QUERY);

        if (mysqli_num_rows($RESULT) > 0)
        {
            while ($USER_DETAILS = mysqli_fetch_array($RESULT))
            {
                $_SESSION['current_user'] = $USER_DETAILS['name'];
                $_SESSION['current_user_id'] = $USER_DETAILS['id'];
            }

            $_SESSION['is_login'] = "true";

            unset($_SESSION['login_email']);
            unset($LOGIN_EMAIL);
        }

        else
        {
            $_SESSION['login_status'] = "failed";
        }
    }

    /* Check login status */
    if (isset($_SESSION['login_status']))
    {
        if ($_SESSION['login_status'] == "failed")
        {
            $LOGIN_LOADER = "popup_error()";
        }
    }

    else
    {
        $LOGIN_LOADER = "";
    }

    /* REGISTER */
    if (isset($_POST['register']))
    {
        /*get all data from the Sign Up form */

        $REG_FULLNAME = $_POST['signup_name'];
        $REG_EMAIL = $_POST['signup_email'];
        $REG_PASSWORD = $_POST['signup_password'];
        $REG_CONFIRM_PASSWORD = $_POST['signup_confirm_password'];

        $_SESSION['inputted_name'] = $REG_FULLNAME;
        $_SESSION['inputted_email'] = $REG_EMAIL;
        $_SESSION['inputted_pass1'] = $REG_PASSWORD;
        $_SESSION['inputted_pass2'] = $REG_CONFIRM_PASSWORD;

        /* Check if passswords are matched */

        if ($REG_PASSWORD != $REG_CONFIRM_PASSWORD)
        {
            $_SESSION['signup_status'] = "unmatched_password";
        }

        /* Check if email already exists */
        
        $QUERY = "SELECT * FROM `users`";
        $RESULT = mysqli_query($CONN, $QUERY);

        if (mysqli_num_rows($RESULT) > 0)
        {
            while ($USER_DETAILS = mysqli_fetch_array($RESULT))
            {
                $USER_INPUTTED_EMAIL = $USER_DETAILS['email'];
            }

            if ($REG_EMAIL == $USER_INPUTTED_EMAIL)
            {
                $_SESSION['signup_status'] = "existing_email";
            }
        }

        /* Register User */
        if (($REG_PASSWORD == $REG_CONFIRM_PASSWORD) && ($REG_EMAIL != $USER_INPUTTED_EMAIL))
        {
            $QUERY = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('". $REG_FULLNAME ."', '". $REG_EMAIL ."', '". $REG_PASSWORD ."')";
            $RESULT = mysqli_query($CONN, $QUERY);

            $_SESSION['signup_status'] = "register_success";

            unset($REG_FULLNAME);
            unset($REG_EMAIL); 
            unset($REG_PASSWORD); 
            unset($REG_CONFIRM_PASSWORD);
            unset($_SESSION['inputted_name']);
            unset($_SESSION['inputted_email']); 
            unset($_SESSION['inputted_pass1']);
            unset($_SESSION['inputted_pass2']);
        }
    }

    /* Check Sign In status */

    if (isset($_SESSION['signup_status']))
    {
        if ($_SESSION['signup_status'] == "register_success")
        {
            $SIGNUP_LOADER = "signup_popup_success()";
        }

        if ($_SESSION['signup_status'] == "unmatched_password")
        {
            $SIGNUP_LOADER = "unmatched_password_popup()";
        }

        if ($_SESSION['signup_status'] == "existing_email")
        {
            $SIGNUP_LOADER = "existing_email_popup()";
        }
    }

    else
    {
        $SIGNUP_LOADER = "";
    }

    /* UPDATE ACCOUNT */
    if (isset($_POST['update']))
    {
        $INPUTTED_UPDATE_FULLNAME = $_POST['update_fullname'];
        $INPUTTED_UPDATE_EMAIL = $_POST['update_email'];
        $INPUTTED_UPDATE_PASSWORD = $_POST['update_password'];
        $INPUTTED_UPDATE_CONFIRM_PASSWORD = $_POST['update_confirm_password'];

        /* FORM VALIDATION */
        if ($INPUTTED_UPDATE_PASSWORD != $INPUTTED_UPDATE_CONFIRM_PASSWORD)
        {
            $_SESSION['update_status'] = "update_unmatched_password";
        }

        else
        {
            $QUERY = "UPDATE `users` SET `name`='". $INPUTTED_UPDATE_FULLNAME ."', `email`='". $INPUTTED_UPDATE_EMAIL ."', `password`='". $INPUTTED_UPDATE_PASSWORD ."' WHERE `id`='". $_SESSION['current_user_id'] ."' ";
            $RESULT = mysqli_query($CONN, $QUERY);

            $_SESSION['update_status'] = "update_success";
        }
    }

    /* Check UPDATE Status */
    if (isset($_SESSION['update_status']))
    {
        if ($_SESSION['update_status'] == "update_unmatched_password")
        {
            $UPDATE_LOADER = "update_unmatched_password_popup()";
        }

        if ($_SESSION['update_status'] == "update_success")
        {
            $UPDATE_LOADER = "update_success_popup()";
        }
    }

    else
    {
        $UPDATE_LOADER = "";
    }

    /* ARTICLE */
    if (isset($_POST['article']))
    {
        $_SESSION['current_data_id'] = $_POST['current_data_id'];

        header("location: read_more");
    }

    /* CREATE QUESTION/TOPIC */
    if (isset($_POST['create_qt']))
    {
        $QT_AUTHOR = $_POST['create_qt_author'];
        $QT_HEAD = $_POST['create_qt_head'];
        $QT_BODY = $_POST['create_qt_body'];
        $QT_AUTHOR_ID = $_SESSION['current_user_id'];

        $QUERY = "INSERT INTO `bulletin` (`author_id`,  `author`, `question_header`, `question_body`, `num_of_votes`, `num_of_answers`, `post_date_time`) VALUES ('". $QT_AUTHOR_ID ."', '". $QT_AUTHOR ."', '". $QT_HEAD ."', '". $QT_BODY ."', '0', '0', '". $DATE_TIME_NOW ."')";
        $RESULT = mysqli_query($CONN, $QUERY);

        $_SESSION['create_qt_status'] = "success";
    }

    /* Check Create Status */
    if (isset($_SESSION['create_qt_status']))
    {
        if ($_SESSION['create_qt_status'] == "success")
        {
            $CREATE_QT_LOADER = "create_qt_success_popup()";
        }
    }

    else
    {
        $CREATE_QT_LOADER = "";
    }

    /* POST COMMENT */

    if (isset($_POST['comment']))
    {
        $POST_ID = $_SESSION['current_data_id'];

        $QUERY = "SELECT * FROM `bulletin` WHERE `id` = '". $POST_ID ."' ";
        $RESULT = mysqli_query($CONN, $QUERY);

        if (mysqli_num_rows($RESULT) > 0)
        {
            $POST_DETAILS = mysqli_fetch_array($RESULT);

            $COMMENT_NAME = $POST_DETAILS['author'];
            $COMMENT_NAME_ID = $POST_DETAILS['author_id'];
        }

        $COMMENT_AUTHOR = $_POST['comment_author'];
        $COMMENT_BODY = $_POST['comment_body'];
        $ARTICLE_AUTHOR_ID = $COMMENT_NAME_ID;
        $ARTICLE_AUTHOR = $COMMENT_NAME;
        $DATE = $DATE_TIME_NOW;

        $QUERY = "INSERT INTO `comments` (`author_id`, `author`, `comment_author`, `comment_body`, `comment_date_time`) VALUES ('". $ARTICLE_AUTHOR_ID ."', '". $ARTICLE_AUTHOR ."', '". $COMMENT_AUTHOR ."', '". $COMMENT_BODY ."', '". $DATE ."');";
        $RESULT = mysqli_query($CONN, $QUERY);

        $_SESSION['comment_status'] = "success";
    }

    if (isset($_SESSION['comment_status']))
    {
        if ($_SESSION['comment_status'] == "success")
        {
            $READ_MORE_LOADER = "comment_success_popup()";
        }
    }

?>