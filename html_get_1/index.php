<?php

include("../security.php");
include("../functions_external.php");
include("../selections.php");

function htmli($data)
{
         
    $data = no_check($data);            

    return $data;

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>HTML Injection</title>

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
    
    <h1>HTML Injection - Reflected (GET)</h1>

    <p>Enter your first and last name:</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="GET">

        <p><label for="firstname">First name:</label><br />
        <input type="text" id="firstname" name="firstname"></p>

        <p><label for="lastname">Last name:</label><br />
        <input type="text" id="lastname" name="lastname"></p>

        <button type="submit" name="form" value="submit">Go</button>  

    </form>

    <br />
    <?php

    if(isset($_GET["firstname"]) && isset($_GET["lastname"]))
    {   

        $firstname = $_GET["firstname"];
        $lastname = $_GET["lastname"];    

        if($firstname == "" or $lastname == "")
        {

            echo "<font color=\"red\">Please enter both fields...</font>";       

        }

        else            
        { 

            echo "Welcome " . htmli($firstname) . " " . htmli($lastname);   

        }

    }

    ?>

</div>
      
</body>
    
</html>
