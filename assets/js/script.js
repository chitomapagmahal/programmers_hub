function popup_login_success()
{
    Swal.fire(
        'Login Success!',
        '',
        'success'
    ).then(function(){window.location.href = "index";});
}

function popup_error()
{
    Swal.fire(
        'Wrong Username or Password!',
        '',
        'error'
    )
}

function unmatched_password_popup()
{
    Swal.fire(
        'Passwords do not matched!',
        '',
        'error'
    )
}

function existing_email_popup()
{
    Swal.fire(
        'Email already exists!',
        '',
        'error'
    )
}

function signup_popup_success()
{
    Swal.fire(
        'Data has been saved successfully!',
        '',
        'success'
    ).then(function(){window.location.href = "index";});
}

function update_unmatched_password_popup()
{
    Swal.fire(
        'Passwords do not matched!',
        '',
        'error'
    )
}

function update_success_popup()
{
    Swal.fire(
        'Account Update Success! You must re-login to continue.',
        '',
        'success'
    ).then(function(){window.location.href = "logout";})
}

function create_qt_success_popup()
{
    Swal.fire(
        'Your Question/Topic has been posted!',
        '',
        'success'
    ).then(function(){window.location.href = "index";});
}

function comment_success_popup()
{
    Swal.fire(
        'Your comment is posted successfuly!',
        '',
        'success'
    );
}