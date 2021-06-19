<?php


include("../security.php");
include("../functions_external.php");
include("../selections.php");

function commandi($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        /*case "1" :

            $data = commandi_check_1($data);
            break;

        case "2" :

            $data = commandi_check_2($data);
            break;*/

        default :

            $data = no_check($data);
            break;

    }

    return $data;

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>OS Command Injection</title>

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

    <h1>OS Command Injection - Blind</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p>

        <label for="target">Enter your IP address:</label>
        <input type="text" id="target" name="target" value="">

        <button type="submit" name="form" value="submit">PING</button>

        </p>

    </form>
    <?php

    if(isset($_POST["target"]))
    {

        $target = $_POST["target"];

        if($target == "")
        {

            echo "<font color=\"red\">Please enter your IP address...</font>";

        }

        else
        {

            echo "Did you captured our GOLDEN packet?";

            if(PHP_OS == "Windows" or PHP_OS == "WINNT" or PHP_OS == "WIN32")
            {

                shell_exec("ping -n 1 " . commandi($target));

            }

            else
            {


                shell_exec("ping -c 1 " . commandi($target));

            }

        }

    }

    ?>

</div>

</body>

</html>
