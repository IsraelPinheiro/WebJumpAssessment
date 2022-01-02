<?php
    use App\Controllers\Auth;

    //Get the current page
    $location = basename($_SERVER['REQUEST_URI']);
    //Check if we are not on login or logout pages
    if(!$location=="login.php" && !$location=="logout.php"){
        //Check if there is a user logged in
        if(!Auth::check()){
            //If not, send to login page
            header('Location: /pages/auth/login.php');
            die();
        }
    } 
    else if($location=="login.php" && Auth::check()){
    //If current locale is the login page and there is a logged in user, redirects to the home page
        header('Location: /');
        die();
    }
?>