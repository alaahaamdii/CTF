<?php

include("../security.php");
include("../functions_external.php");
include("../selections.php");

$message = "";
$login = "test";
  
switch($_COOKIE["security_level"])
{

    case "0" : 

        $password = "test";
        break;

    case "1" :

        $password = "test123";
        break;

    case "2" :

        $password = "Test123";
        break;

    default :

        $password = "test";
        break;

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

    <h1>Broken Auth. - Weak Passwords</h1>

    <p>Enter your credentials.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Login:</label><br />
        <input type="text" id="login" name="login" size="20" autocomplete="off" /></p> 

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password" size="20" autocomplete="off" /></p>

        <button type="submit" name="form" value="submit">Login</button>  

    </form>

    <br />
<?php

    if(isset($_POST["form"]))
    {

        if($_POST["login"] == $login && $_POST["password"] == $password)
        {

            $message = "<font color=\"green\">Successful login!</font>";

        }

        else
        {

            $message = "<font color=\"red\">Invalid credentials!</font>";

            }

    }

    echo $message;

?>
</div>
      
</body>
    
</html>
