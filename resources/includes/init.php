<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
    use App\DotEnvParser;
    (new DotEnvParser($_SERVER['DOCUMENT_ROOT'].'/.env'))->load();
?>