<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <?
        if(!isset($_POST["save"])){
    ?>
    <div class="container">
        <h2 style="text-align: center;">Upload a Picture</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Load Photo</label>
                <input class="form-control" type="file" id="formFile" name="photo">
            </div>
            <div class="btn-group">
                <button class="btn btn-info" name="save">Save</button>
            </div>
        </form>       
    </div>
    <div class="container">
    <?
        }
        else{
            if(isset($_COOKIE['email']) && isset($_POST['save'])){
                $email = $_COOKIE['email'];
                $parts = explode("@", $email);
                $directory = $parts[0];
                //echo "<div>$directory</div>";

                if(is_dir($directory)){
                    putPhotoToDirectory($directory);
                    echo "<script>
                                setTimeout(()=>{
                                location = 'index.php?page=2';
                                }, 1500)
                            </script>";        
                }
                else{
                    mkdir($directory);
                    if(is_dir($directory)){
                        putPhotoToDirectory($directory);
                        echo "<script>
                                setTimeout(()=>{
                                    location = 'index.php?page=2';
                                }, 1500)
                            </script>";
                    }
                    else{
                        echo "<div style='color: red; text-align: center'>The directory $directory is not exists.</div>";
                        echo "<script>
                                setTimeout(()=>{
                                    location = 'index.php?page=1';
                                }, 1500)
                            </script>";
                    }
                }
            }
            else if(!isset($_COOKIE['email'])){
                echo "<script>
                        setTimeout(()=>{
                            location = 'index.php?page=5';
                        }, 100)
                    </script>";
            }
        }

        function putPhotoToDirectory($directory){
            if($_FILES && $_FILES['photo']['error'] == UPLOAD_ERR_OK){
                $filename = $_FILES['photo']['name'];
                move_uploaded_file($_FILES['photo']['tmp_name'], $directory.'/'.$filename);
                echo "<div style='color: green; text-align: center'>File $filename upload successfully!</div>";
            }
            else{
                echo "<div style='color: red; text-align: center'>Error while upload file!</div>";
                //echo $_FILES['photo']['error'];
            }
        }
    ?>
    </div>
</body>
</html>