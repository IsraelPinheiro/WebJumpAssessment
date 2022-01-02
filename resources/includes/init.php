<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
    use App\DotEnvParser;
    use App\Controllers\Auth;
    (new DotEnvParser($_SERVER['DOCUMENT_ROOT'].'/.env'))->load();
    include $_SERVER['DOCUMENT_ROOT']."/app/Guards/LoginGuard.php";
?>