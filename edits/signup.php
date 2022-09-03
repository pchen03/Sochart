<!DOCTYPE html>  
 <html>  
 <head>  
      <title>Webslesson | <?php echo $title; ?></title>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
 </head>  
 <body>  
      <div class="container" style="width:600px">  
           <br /><br /><br />  
           <h3><?php echo $title; ?></h3>  
           <br />  
           <label>Enter Email</label>  
           <input type="text" name="email" id="email" class="form-control" />  
           <span id="email_result"></span>  
           <br /><br />  
           <label>Enter Password</label>  
           <input type="text" name="password" id="password" class="form-control" />  
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
                    $('#email').keyup(function() {  
                        <?php
                        if(isset($_POST['email'])){
                            $emailAddress = $_POST['email'];
                            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                                echo 'Enter a valid email';
                            }else{
                                $query = mysql_query("SELECT * FROM users WHERE Email='$emailAddress' ");
                                if(mysql_num_rows($query)>0){
                                    echo 'Email is already in use';
                                }
                            }  
                        }
                        ?>
                    });
                });
            </script>
 </body>  
 </html>
 <?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=SocialChart;chartset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['signupButton'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['pass'];
        $email = 'Not Registered';
        $phoneNumber = 'Not Registered';

        if(strrpos($_POST['contact'], '@')<0){
            $phoneNumber = $_POST['contact'];
        }else{
            $email = $_POST['contact'];
        }
        //check if username is available
        if(!database::query('SELECT username FROM users WHERE Username=:Username', array(':Username'=>$username))){
           
           //check for username length
            if(strlen($username)>=3 && strlen($username)<= 32){

                //check for valid email
               if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    if(strlen($password)>=6 && strlen($password)<=60)   {
                        if($password == $repassword){
                            database::query('INSERT INTO users VALUES ( \'\', :Username, :Password, :Email, :phoneNumber,  :Followers)', array( ':Username'=>$username, ':Password'=>password_hash($password, PASSWORD_BCRYPT), ':Email'=>$email, 'phoneNumber'=>$phoneNumber, ':Followers'=>0));
                            echo 'user created';
                        }else{
                            echo 'password do not match';
                        }
                        
                    }else{
                        echo 'invalid password';
                    }
               }else{
                   echo 'invalid email';
               }            
            }else{
                echo 'invalid username';
            }
        }else{
            echo 'user exists';
        }

}

class database{

    private static function connect(){
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=SocialChart;chartset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if(explode(' ', $query)[0]== 'SELECT'){
            $data = $statement->FetchAll();
            return $data;
        }
    }
}
?>