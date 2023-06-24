<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: transparent;
        }

        h2{
            text-align: center;
        }

        .container>.table>thead>tr>th, .container>.table>tbody>tr>td{
            background-color: transparent;
        }
    </style>
</head>
<body>
    <h2>Home page</h2>
    <?
        $username = '';
        $email = '';
        $countOfPhotos = 0;

        if(isset($_COOKIE['email']) && isset($_COOKIE['username'])){
            $username = $_COOKIE['username'];
            $email = $_COOKIE['email'];

            $arrayFolder = explode('@', $email);
            $foldername = $arrayFolder[0];

            if($foldername != ''){
                $folderPath = $foldername.'/';
                $photos = glob($folderPath.'*.{jpg, jpeg, png, gif}', GLOB_BRACE);
                $countOfPhotos = count($photos);
            }
        }
        else{
            header('Location: index.php?page=5');
        }
    ?>
    <div class="container">
        <table class="table table-striped w-50">
            <thead>
                <tr style="text-align: center;">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Count of photos</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: center;">
                    <?
                        if($username !='' && $email != ''){
                            echo "<td>$username</td>";
                            echo "<td>$email</td>";
                            echo "<td>$countOfPhotos</td>";
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>