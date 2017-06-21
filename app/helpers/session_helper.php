<?php
function set_session($username)
{
    $_SESSION['username'] = $username;
}

function get_session_username()
{
    return $_SESSION['username'];
}

function check_user_session($username)
{
    if ((isset($_SESSION['username']) == $username) && ($username != null)) {
    }
    if (!isset($_SESSION['username'])) {
        session_start();
        session_destroy();
        redirect('/users/login');
        exit();
    }
}
