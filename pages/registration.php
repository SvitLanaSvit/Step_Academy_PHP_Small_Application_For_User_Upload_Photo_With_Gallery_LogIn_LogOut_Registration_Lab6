<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <?
    function writeToFile($filepath, $user){
        $fd = fopen($filepath, 'a+') or die("Unable to create file!");
        $hashPassword = hashPassword($user->password);
        $str = "$user->username:$user->email:$hashPassword";
        fwrite($fd, $str.PHP_EOL);
        fclose($fd);
        echo "<div class='info' style='color: green; text-align: center'>Registration was successful!</div>";
    }

    function hashPassword($password): string{
        return password_hash($password, PASSWORD_BCRYPT);
    }

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

    function validatePassword($password){
        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])\S{6,}$/';
        return preg_match($passwordRegex, $password);
    }

    if(!isset($_POST['submit'])){
    ?>
    <div class="container">
        <h2>User Registration</h2>
        <form method="POST">
            <div class="mb-3 w-25">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3 w-25">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 w-25">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
                <a href="menu.php" class="btn btn-secondary">Back to menu</a>
            </div>
        </form>
    </div>
    <?}
        else{
            class User {
                public $username;
                public $email;
                public $password;
            
                function __construct($username, $email, $password) {
                    $this->username = $username;
                    $this->email = $email;
                    $this->password = $password;
                }
            }

            $filepath = 'users.txt';
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                if(!validatePassword($password)){
                    echo "<script>alert('Password should be at least 6 characters long and contain at least one lowercase character, one uppercase character, and one symbol.')</script>";
                    echo "<script>
                            setTimeout(()=>{
                                location = 'index.php?page=4'
                            }, 2500);
                        </script>";
                }
                else{
                    $userToWrite = new User($username, $email, $password);
                    //echo var_dump($userToWrite);

                    $usersFromFile = [];
                    $isUserExists = false;

                    if(file_exists("users.txt")){
                        $usersFromFile = readFromFile($filepath);

                        foreach($usersFromFile as $userFromFile){
                            $userArray = explode(':', $userFromFile);

                            if($username == $userArray[0] && $email == $userArray[1] || $email == $userArray[1]){
                                echo "<div style='color: red; text-align: center;'>This user is already registred!</div>";
                                $isUserExists = true;
                                echo "<script>
                                        setTimeout(()=>{
                                            location = 'index.php?page=5'
                                        }, 2000)
                                    </script>";
                                break;
                            }
                        }
                    }

                    if(!$isUserExists){
                        writeToFile($filepath, $userToWrite);
                        echo "<script>
                                    setTimeout(()=>{
                                        location = 'index.php?page=5'
                                    }, 2000)
                                </script>";
                    }
                }
            }
        }
    ?>
</body>
</html>