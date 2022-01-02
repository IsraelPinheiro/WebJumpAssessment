<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Candidate evaluation for a developer position at WebJump ">
    <meta name="author" content="Israel R Pinheiro">
    <title>WebJump</title>
    <link rel="icon" type="image/svg+xml" href="/public/images/favicon.svg">
    <link rel="alternate icon" href="/public/images/favicon.png">
    <!-- Styles -->
    <link href="/public/css/app.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="/public/js/app.js"></script>
    <?php
        if(isset($_SESSION["Alert"])){
            echo '<script>
                    $(function(){
                        swal({
                            title: "'.$_SESSION["Alert"]["Title"].'",
                            text: "'.$_SESSION["Alert"]["Text"].'",
                            icon: "'.$_SESSION["Alert"]["Icon"].'",
                        })
                    })
                </script>';
            unset($_SESSION["Alert"]);
        }
    ?>
</head>