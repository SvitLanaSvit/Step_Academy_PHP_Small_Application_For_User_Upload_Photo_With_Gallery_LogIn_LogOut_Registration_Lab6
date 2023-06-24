<?
$pages = ["HOME" => "?page=1", "UPLOAD" => "?page=2", "GALLERY" => "?page=3", "REGISTRATION" => "?page=4"];
$pageLogIn = ["LOG IN" => "?page=5"];
$pageLogOut = ["LOG OUT" => "?page=6"];
$username = '';

echo "<div><ul class='navbar-nav'>";
foreach($pages as $k=>$page){
    echo "<li class='nav-item'><a href='$page' class='nav-link'>$k</a></li>";
}
echo "</ul></div>";
echo "<div class='navbar-nav ml-auto' style='display: flex; align-items: center;'>";
if(!isset($_COOKIE['username'])){
    $username = '';
    echo "<p id='userIn' class='nav-link navbar-text' style='margin-bottom: 0;'>$username</p>";
    foreach($pageLogIn as $k=>$v){
        echo "<a href='$v' id='log' class='nav-link'>$k</a>";
    } 
}
else{
    if(isset($_COOKIE['username'])){
        $username = $_COOKIE['username'];
        echo "<p id='userIn' class='nav-link navbar-text' style='margin-bottom: 0;'>Hello, $username</p>";
        foreach($pageLogOut as $k=>$v){
            echo "<a href='$v' id='log' class='nav-link'>$k</a>";
        } 
    }
}
echo "</div>";