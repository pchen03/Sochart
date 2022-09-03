<!DOCTYPE html>
<html>

<head>

    <!----    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SocialChart</title>
    <link rel="stylesheet" type="text/css" href="css/login-util.css">
    <link rel="stylesheet" type="text/css" href="css/login-main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <!-- favicon--->
    <link rel="icon" href="img/tab_image.png">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <form class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" action="login.php" method="post">
                <div class="login100-form validate-form">
                    <span class="login100-form-title p-b-33" style="color:white">
                        <a class="navbar-brand js-scroll-trigger" href="index.html"><img src="img/logo.png" alt="logo" width="170rem;" /></a><br>Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="identifier" placeholder="Email or Username">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>
                    <div class="row align-items-center remember" style="font-size:0.75rem; margin:0.5rem">
                        <input type="checkbox">Remember me
                    </div>
                    <div class="container-login100-form-btn m-t-20">
                        <input class="login100-form-btn" type="submit" name="login" value="Login">
                    </div>
                    <span class="hidden" id="loginResult" style="color:#addce0; font-size:1rem"></span>
                    <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                            Forgot
                        </span>

                        <a href="#" class="txt2 hov1">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center">
                        <span class="txt1">
                            Create an account?
                        </span>

                        <a href="#" class="txt2 hov1">
                            Sign up
                        </a>
                    </div>
            </form>
        </div>
    </div>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('databaseConnect.php');
    //determine what type of data user is loggin in with
    //check if the fields are blank

    //checks when the button is clicked
    if (isset($_POST['login'])) {

        $password = $_POST['password'];
        if (!strpos($_POST['identifier'], "@")) {
            $username = $_POST['identifier'];
            if (database::query('SELECT Username FROM users WHERE Username=:username', array(':username' => $username))) {
                if (password_verify($password, database::query('SELECT Password FROM users WHERE Username =:username', array(':username' => $username))[0]['Password'])) {
                    echo '<script type="text/javascript">';
                    echo '$("#loginResult").html("Successfully Logged in");$("#loginResult").removeClass(\'hidden\')';
                    echo '</script>';
                } else {
                    echo '<script type="text/javascript">';
                    echo '$("#loginResult").html("Incorrect Password");$("#loginResult").removeClass(\'hidden\')';
                    echo '</script>';
                }
            } else {
                echo '<script type="text/javascript">';
                echo '$("#loginResult").html("Username not registered");$("#loginResult").removeClass(\'hidden\')';
                echo '</script>';
            }
        } else {

            $email = $_POST['identifier'];
            if (database::query('SELECT Username FROM users WHERE Email=:Email', array(':Email' => $email))) {
                if (password_verify($password, database::query('SELECT Password FROM users WHERE Email =:Email', array(':Email' => $email))[0]['Password'])) {
                    echo '<script type="text/javascript">';
                    echo '$("#loginResult").html("Successfully Logged in");$("#loginResult").removeClass(\'hidden\')';
                    echo '</script>';

                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong);
                    $user_id = database::query('SELECT id FROM users WHERE username = :username')[0]['id'];
                    database::query('INSERT INTO login_tokens VALUES ('', itoken, :user_id)', array(':token'=>sha1($token), ':user_id'));

                } else {
                    echo '<script type="text/javascript">';
                    echo '$("#loginResult").html("Incorrect Password");$("#loginResult").removeClass(\'hidden\')';
                    echo '</script>';
                }
            } else {
                echo '<script type="text/javascript">';
                echo '$("#loginResult").html("Email not registered");$("#loginResult").removeClass(\'hidden\')';
                echo '</script>';
            }
        }
    }

    ?>
</body>


</html>