<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <?
        function readFromFile($filepath){
            $users = [];

            $fd = fopen($filepath, 'r') or die("Unable to read from file!");
            while(!feof($fd)){
                $str = fgets($fd);
                $user = trim($str);
                if(!empty($user)){
                    $users[] = $user;
                }
            }
            fclose($fd);
            return $users;
        }

        if(!isset($_POST['submit'])){
    ?>
    <div class="container">
        <h2>Log in</h2>
        <form method="POST">
            <div class="mb-3 w-25">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 w-25">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-primary">Log in</button>
            </div>    
        </form>
    </div>
    <?
        }
        else{
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $username = '';

                $filepath = "users.txt";
                $usersFromFile = [];
                $isUserMatch = false;

                if(file_exists($filepath)){
                    $usersFromFile = ReadFromFile($filepath);

                    if(count($usersFromFile) > 0){

                        foreach($usersFromFile as $user){
                            $userArray = explode(':', $user);
                            $isPasswordMatch = password_verify($password, $userArray[2]);
                            
                            if($email == $userArray[1] && $isPasswordMatch){
                                $isUserMatch = true;
                                $username = $userArray[0];
                                break;
                            }
                        }

                        if($isUserMatch){
                            setcookie("username", $username, time() + (60 * 60 * 2), "/", "", 0, 0);
                            setcookie("email", $email, time() + (60 * 60 * 2), "/", "", 0, 0);
                            echo "<div style='color: green; text-align: center;'>You have successfully passed the verification</div>";
                                    echo "<script>
                                            setTimeout(()=>{
                                                location = 'index.php?page=1';
                                            }, 2000)
                                        </script>";
                        }
                        else{
                            if(isset($_COOKIE['email'])){
                                setcookie("username", $username, time() - (60 * 60 * 2), "/", "", 0, 0);
                                setcookie("email", $email, time() - (60 * 60 * 2), "/", "", 0, 0);
                            }
                            echo "<div style='color: red; text-align: center;'>Email or password are not correct!</div>";
                            echo "<script>
                                    setTimeout(()=>{
                                        location = 'index.php?page=5';
                                    }, 2000)
                                </script>";
                        }
                    }
                }
            }
        }
    ?>
</body>
</html>