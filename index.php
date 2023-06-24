<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        html{
            background-image: url('/assets/back.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100%;
        }   
        
        a.nav-link:hover{
            background-color: #1979a9;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <header class="col-sm-12 col-md-12 col-lg-12">

            </header>
        </div>

        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #1979a9;">
                <div class="container-fluid">
                    <?include_once("pages/menu.php")?>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="container">
                <section class="col-sm-12 col-md-12 col-lg-12">
                    <?
                        if(isset($_GET["page"])){
                            $num = $_GET["page"];
                            switch ($num){
                                case '1':
                                    if(isset($_COOKIE['email'])){
                                        include_once("pages/home.php");
                                        break;
                                    }
                                    else{
                                        echo "<script>alert('You should log in!');</script>";
                                        break;
                                    }
                                case '2':
                                    if(isset($_COOKIE['email'])){
                                        include_once("pages/upload.php");
                                        break;
                                    }
                                    else{
                                        echo "<script>alert('You should log in!');</script>";
                                        break;
                                    }
                                case '3':
                                    if(isset($_COOKIE['email'])){
                                        include_once("pages/gallery.php");
                                        break;
                                    }
                                    else{
                                        echo "<script>alert('You should log in!');</script>";
                                        break;
                                    }
                                case '4':{
                                    if(isset($_COOKIE['email'])){
                                        echo "<script>alert('You are already registered!');</script>";
                                        break;
                                    }
                                    else{
                                        include_once("pages/registration.php");
                                        break;
                                    }
                                } 
                                case '5':{
                                    include_once("pages/login.php");
                                    break;
                                } 
                                case '6':{
                                    include_once("pages/logout.php");
                                    break;  
                                }  
                                default:
                                    echo "There is not this address.";
                            }
                        }
                    ?>
                </section>
            </div>
        </div>
    </div>
</body>
</html>