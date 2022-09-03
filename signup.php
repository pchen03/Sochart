<!doctype html>
<html lang="en">

<head>

    <!----    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SocialChart</title>
    <link rel="stylesheet" type="text/css" href="css/signup-util.css">
    <link rel="stylesheet" type="text/css" href="css/signup-main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <!-- favicon--->
    <link rel="icon" href="img/tab_image.png">
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <div class="login100-form validate-form">
                    <form method="post" action="signup.php">
                        <span class="login100-form-title p-b-33" style="color:white">
                            <a class="navbar-brand js-scroll-trigger" href="index.html"><img src="img/logo.png" alt="logo" width="170rem;" /></a><br>Signup<br>
                            <p style>It's fast and simple</p>
                        </span>

                        <div class="wrap-input100 validate-input tooltip" data-validate="Valid email is required: ex@abc.xyz">
                            <input id="email" class="input100" type="text" name="contact" placeholder="Email or Mobile Number">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <div class="wrap-input100 validate-input tooltip" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="name" placeholder="Full Name">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <div class="wrap-input100 validate-input tooltip" data-validate="Valid email is required: ex@abc.xyz">
                            <div class="tooltiptext">Your username is unique and helps others find you online</div>
                            <input class="input100" type="text" id="username" name="username" placeholder="Username">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>


                        <div class="wrap-input100 rs1 validate-input tooltip" data-validate="Password is required">
                            <div class="tooltiptext">Greater than 6 characters, and contains at least one special character</div>
                            <input class="input100" type="password" name="password" id="password" placeholder="Password">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <div class="wrap-input100 rs1 validate-input tooltip" data-validate="Password is required">
                            <div class="tooltiptext">re-enter your password from above</div>
                            <input class="input100" type="password" name="pass" id="verifyPassword" placeholder="Re-enter Password">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <span id="verifyNote" class="hidden" style="color:#addce0;transition:opacity 0.4s;">Passwords don't match</span>
                        <br>
                        <span id="emailTaken" class="hidden" style="color:#addce0;transition:opacity 0.4s;">placeholder</span>
                        <br>
                        <span id="usernameTaken" class="hidden" style="color:#addce0;transition:opacity 0.4s;">placeholder</span>



                        <p style="margin-top:0.5rem;font-size:0.7rem; text-align: center;">By clicking sign up, you agree to our <a>Terms</a>, <a>Data Policy</a>, and <a>Cookies Policy</a>. You may receive E-mail or SMS Notifications from us, and can unsubscribe anytime.</p>

                        <div class="container-login100-form-btn m-t-20">
                            <button name="signupButton" type="submit" class="login100-form-btn">
                                Sign Up
                            </button>
                        </div>

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
                                Already have an account?
                            </span>

                            <a href="#" class="txt2 hov1">
                                Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#verifyPassword').keyup(function() {
                    if ($(this).val() == $('#password').val()) {
                        $('#verifyNote').addClass('hidden');
                    } else {
                        $('#verifyNote').removeClass('hidden');
                    }
                });
                $('#password').keyup(function() {
                    if ($(this).val() == $('#verifyPassword').val()) {
                        $('#verifyNote').addClass('hidden');
                    } else {
                        $('#verifyNote').removeClass('hidden');
                    }
                });

                //email verification    
                $('#email').keyup(function() {

                    var email = $('#email').val();
                    jQuery.ajax({
                        url: 'check_email_available.php',
                        method: 'POST',
                        data: {
                            "passEmail": email
                        },
                        success: function(data) {
                            //alert('Successfully called' + 'data');
                            $("#emailTaken").html(data);
                            $("#emailTaken").removeClass('hidden')
                            //alert(data)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                            alert(thrownError);
                        }
                    });


                });
                $('#username').keyup(function() {

                    var username = $('#username').val();
                    jQuery.ajax({
                        url: 'check_username_availability.php',
                        method: 'POST',
                        data: {
                            "username": username
                        },
                        success: function(data) {
                            //alert('Successfully called' + 'data');
                            $("#usernameTaken").html(data);
                            $("#usernameTaken").removeClass('hidden')
                            //alert(data)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                            alert(thrownError);
                        }
                    });
                });
            });
        </script>

        <?php

        $dbHost = '127.0.0.1';
        $dbName = 'SocialChart';
        $dbUsername = "root";
        $dbPassword = "";
        $pdo = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName . ";chartset=utf8", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['signupButton'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['pass'];
            $contact = $_POST['contact'];
            $email = 'Not Registered';
            $phoneNumber = 'Not Registered';

            if (strpos($contact, '@') < 0) {
                $phoneNumber = $contact;
            } else {
                $email = $contact;
            }

            //check if username is available
            if (!database::query('SELECT username FROM users WHERE Username=:Username', array(':Username' => $username))) {
                //check for valid email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    if (strlen($password) >= 6 && strlen($password) <= 60) {
                        if ($password == $repassword) {
                            database::query('INSERT INTO users VALUES ( \'\', :Username, :Password, :Email, :phoneNumber,  :Followers)', array(':Username' => $username, ':Password' => password_hash($password, PASSWORD_BCRYPT), ':Email' => $email, 'phoneNumber' => $phoneNumber, ':Followers' => 0));
                            echo '<script type="text/javascript">';
                            echo '$("#emailTaken").html("user created");$("#emailTaken").removeClass(\'hidden\')';
                            echo '</script>';
                        } else {
                            echo '<script type="text/javascript">';
                            echo '$("#verifyNote").html("Passwords do not match");$("#verifyNote").removeClass(\'hidden\')';
                            echo '</script>';
                        }
                    } else {
                        echo '<script type="text/javascript">';
                        echo '$("#emailTaken").html("insecure Password");$("#emailTaken").removeClass(\'hidden\')';
                        echo '</script>';
                    }
                } else {
                    echo '<script type="text/javascript">';
                    echo '$("#emailTaken").html("invalid email");$("#emailTaken").removeClass(\'hidden\')';
                    echo '</script>';
                }
            } else {
                echo '<script type="text/javascript">';
                echo '$("#emailTaken").html("Username Already Taken");$("#emailTaken").removeClass(\'hidden\')';
                echo '</script>';
            }
        }

        class database
        {

            private static function connect()
            {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=socialchart;chartset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }

            public static function query($query, $params = array())
            {
                $statement = self::connect()->prepare($query);
                $statement->execute($params);

                if (explode(' ', $query)[0] == 'SELECT') {
                    $data = $statement->FetchAll();
                    return $data;
                }
            }
        }
        ?>
</body>



</html>