<?php
    include $_SERVER['DOCUMENT_ROOT']."/resources/includes/init.php";
    use App\Controllers\Auth;

    //Check if request came by POST
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Check if email and password are set
        if(isset($_POST["email"]) && isset($_POST["password"])){
            $email = trim($_POST["email"]);
            $password = sha1($password);
            //Try to login
            if(Auth::login($email, $password)){
                //Login Successful
                header('Location: /');
                die();
            }
            else{
                //Login Failed
                $_SESSION["Alert"] = array(
                    "Title" => "Error!",
                    "Text" => "The credentials provided are invalid ",
                    "Icon" => "error"
                );
                http_response_code(406);
                header('Location: '.$_SERVER['PHP_SELF']);
                die();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="<?php echo getenv('APP_LANG') ?>">
    <?php include $_SERVER['DOCUMENT_ROOT']."/resources/includes/head.php"?>
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4"><?php echo getenv('APP_NAME') ?></h1>
                                        </div>
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="user">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="E-Mail Address" autocomplete="email" required  autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control form-control-user" name="password" placeholder="Password" autocomplete="current-password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember">
                                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


