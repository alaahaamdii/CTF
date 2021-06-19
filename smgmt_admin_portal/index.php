<?php

include("../security.php");
include("../selections.php");

$message = "";

switch($_COOKIE["security_level"])
{

    case "0" :       

        if(isset($_GET["admin"]))                
        {

            if($_GET["admin"] == "1")
            {

                $message = "Cowabunga...<p><font color=\"green\">You unlocked this page using an URL manipulation.</font></p>";

            }

            else
            {

                 $message="<font color=\"red\">This page is locked.</font><p>HINT: check the URL...</p>";

            }

        }

        else 
        {

            header("Location: " . $_SERVER["SCRIPT_NAME"] . "?admin=0");

            exit;                  

        }          

        break;

    case "1" :

        if((isset($_COOKIE["admin"])))
        {

            if($_COOKIE["admin"] == "1")
            {

				$message = "Cowabunga...<p><font color=\"green\">You unlocked this page using a cookie manipulation.</font></p>";

            }  

            else
            {

                $message="<font color=\"red\">This page is locked.</font><p>HINT: check the cookies...</p>";

            } 

        }

        else    
        {    

            // Sets a cookie 'admin' when there is no cookie detected
            setcookie("admin", "0", time()+300, "/", "", false, false);

            header("Location: " . $_SERVER["SCRIPT_NAME"]);

            exit;

        }        

        break;

    case "2" :             

        // Debugging
        // print_r($_SESSION);

        if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
        {

            $message = "Cowabunga...<p><font color=\"green\">You unlocked this page with a little help from the dba :)</font></p>";

        }

        else
        {

            $message="<font color=\"red\">This page is locked.</font><p>HINT: contact your dba...</p>";

        }            

        break;

    default :  

        if(isset($_GET["admin"]))                
        {

            if($_GET["admin"] == "1")
            {

                $message = "Cowabunga...<p><font color=\"green\">You unlocked this page using an URL manipulation.</font></p>";

            }

            else
            {

                 $message="<font color=\"red\">This page is locked.</font><p>HINT: check the URL...</p>";

            }

        }

        else 
        {                

            header("Location: " . $_SERVER["SCRIPT_NAME"] . "?admin=0");

            exit;                  

        }          

        break;

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Session Management</title>

</head>

<body>
   
<div id="menu">
      
    <table>
        
        <tr>
            
            <td><a href="../portal.php">Main</a></td>
            <td><a href="../logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);};}?></font></td>
            
        </tr>
        
    </table>   
   
</div> 

<div id="main">

    <h1>Session Mgmt. - Administrative Portals</h1>

    <p><?php echo $message;?></p>

</div>
      
</body>
    
</html>
