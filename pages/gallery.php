<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        h2{
            text-align: center;
        }

        .photo-gallery{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .photo-item{
            width: 25%;
            height: 200px;
            margin: 5px;
        }

        .photo-item img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        body {
            background-color: transparent;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Photo Gallery</h2>
        <?
            $directory = '';
            if(isset($_COOKIE['email'])){
                $email = $_COOKIE['email'];
                $parts = explode('@', $email);
                $directory = $parts[0];
            }
            else{
                echo header('Location: index.php?page=5');
            }
        ?>

        <div class="photo-gallery">
            <?
                if($directory != ''){
                    $folderPath = $directory.'/';
                    $photoFiles = glob($folderPath.'*.{jpg, jpeg, png, gif}', GLOB_BRACE);
                    foreach($photoFiles as $file){
                        $filename = basename($file);
                        echo "<div class='photo-item'><img src='$file' alt='$filename'></div>";
                    }
                }
                else{
                    echo "<script>alert('The directory was not found!';)</script>";
                    echo "<script>
                            setTimeout(()=>{
                                location = 'index.php';
                            }, 1500);
                        </script>";
                }
            ?>
        </div>

    </div>
</body>
</html>