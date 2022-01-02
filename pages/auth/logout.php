<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
    use App\Controllers\Auth;

    //Check if request came by POST
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(Auth::logout()){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
    }
?>