<?php
// include_once "./header.php";
// include_once "../database/db_connect.php";
function render_blocks_ntimes($html_block, $n)
{
    for ($i = 0; $i < $n; $i++) {
        echo $html_block;
    }
}

function hash_password($pass)
{
    $pass = trim($pass);
    return password_hash($pass, PASSWORD_BCRYPT);
}

function compare_password($pass, $conn, $user_id)
{
    $query = "select password from users where user_id='$user_id';";
    $result = mysqli_query($conn, $query);
    if (!$result) return false;
    $hashed_password = mysqli_fetch_column($result);
    $pass = trim($pass);
    return password_verify($pass, $hashed_password);
}

function check_if_email_exists($email, $conn)
{
    $query = "select user_id from users where email='$email';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row) return true;
    return false;
}

function reset_password($email, $password, $conn)
{
    $query = "select user_id from users where email='$email'";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        $_SESSION["reset_password_error"] = ["error" => "Some error occured <br> try again later."];
        return false;
    }
    $password = hash_password($password);
    $result_for_id = mysqli_fetch_assoc($result);
    $id = $result_for_id["user_id"];
    $resting_query = "update users set password='$password' where user_id = '$id';";

    $password_reseted = mysqli_query($conn, $resting_query);
    if (!$password_reseted) {
        $_SESSION["reset_password_error"] = ["error" => "Some error occured <br> try again later."];
        return false;
    }
    return true;
}

function display_error_message($err, $session_name)
{

    echo "<div class='text-lg text-red-500 p-2'><p>$err</p></div>";
    unset($_SESSION[$session_name]);
}
function display_success_message($success, $session_name)
{

    echo "<div class='text-xl text-sky-500 p-2'><p>$success</p></div>";
    unset($_SESSION[$session_name]);
}

function go_to_location_with_exit($location)
{
    header("location: $location", true, 301);
    exit;
}
function go_to_location($location)
{
    header("location: $location", true, 301);
}

// function isLoggedIn_display($isLoggedin,$user_id,$conn){
//     if($isLoggedin) "<div></div>";
//     $query = "select name,email,role from users where user_id='$user_id';";
//     $result = mysqli_query($conn, $query);
//     if(!$result) exit;
//     $rows = mysqli_fetch_all($result);
//     var_dump($rows);

// }
// isLoggedIn_display($true,16,$conn);
