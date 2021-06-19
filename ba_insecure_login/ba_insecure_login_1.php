<?php

include("security.php");
include("admin/settings.php");

$bugs = file("bugs.txt");

if(isset($_POST["form_bug"]) && isset($_POST["bug"]))
{
        
            $key = $_POST["bug"]; 
            $bug = explode(",", trim($bugs[$key]));

            header("Location: " . $bug[1]);
            
            exit;
   
}
 
if(isset($_POST["form_security_level"]) && isset($_POST["security_level"]))    
{
    
    $security_level_cookie = $_POST["security_level"];
    
    switch($security_level_cookie)
    {

        case "0" :

            $security_level_cookie = "0";
            break;

        case "1" :

            $security_level_cookie = "1";
            break;

        case "2" :

            $security_level_cookie = "2";
            break;

        default : 

            $security_level_cookie = "0";
            break;

    }

    setcookie("security_level", $security_level_cookie, time()+60*60*24*365, "/", "", false, false);
       
    header("Location: ba_insecure_login.php");
    
    exit;

}

if(isset($_COOKIE["security_level"]))
{

    switch($_COOKIE["security_level"])
    {
        
        case "0" :
            
            $security_level = "low";
            break;
        
        case "1" :
            
            $security_level = "medium";
            break;
        
        case "2" :
            
            $security_level = "high";
            break;
        
        default : 
            
            $security_level = "low";
            break;

    }
    
}

else
{
     
    $security_level = "not set";
    
}

$message = "";

if(isset($_POST["form"]))   
{ 
        
    if($_POST["login"] == "tonystark" && $_POST["password"] == "I am Iron Man")
    {
        
        $message = "<font color=\"green\">Successful login! You really are Iron Man :)</font>";
        
    }
    
    else        
    {

        $message = "<font color=\"red\">Invalid credentials!</font>";

    }
    
}
    
?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Broken Authentication</title>

</head>

<body>
    
<div id="menu">
      
    <table>
        
        <tr>
            
            <td><a href="../portal.php">Main</a></td>
            <td><a href="../logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>
            
        </tr>
        
    </table>   
   
</div> 

<div id="main">

    <h1>Broken Auth. - Insecure Login Forms</h1>

    <p>Enter your credentials.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Login:</label><font color="white">tonystark</font><br />
        <input type="text" id="login" name="login" size="20" /></p> 

        <p><label for="password">Password:</label><font color="white">I am Iron Man</font><br />
        <input type="password" id="password" name="password" size="20" /></p>

        <button type="submit" name="form" value="submit">Login</button>  

    </form>

    </br >    
    <?php echo $message;?>    
</div>
    
</body>
    
</html>
