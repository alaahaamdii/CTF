<?php

include("security.php");
include("functions_external.php");
include("selections.php");

function commandi($data)
{

    switch($_COOKIE["security_level"])
    {

        /*case "0" :

            $data = no_check($data);
            break;

        case "1" :

            $data = commandi_check_1($data);
            break;*/

        case "0" :

            $data = commandi_check_2($data);
            break;

        default :

             $data = commandi_check_2($data);
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

            <td><a href="portal.php">Main</a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>OS Command Injection</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p>

        <label for="target">DNS lookup:</label>
        <input type="text" id="target" name="target" value="www.nsa.gov">

        <button type="submit" name="form" value="submit">Lookup</button>

        </p>

    </form>
    <?php

    if(isset($_POST["target"]))
    {

        $target = $_POST["target"];

        if($target == "")
        {

            echo "<font color=\"red\">Enter a domain name...</font>";

        }

        else
        {

            echo "<p align=\"left\">" . shell_exec("nslookup  " . commandi($target)) . "</p>";

        }

    }

    ?>

</div>

<div id="bug">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label>Choose the vulnerability :</label><br />

        <select name="bug">

<?php

// Lists the options from the array 'bugs' (bugs.txt)
foreach ($bugs as $key => $value)
{

   $bug = explode(",", trim($value));

   echo "<option value='$key'>$bug[0]</option>";

}

?>


        </select>

        <button type="submit" name="form_bug" value="submit">Hack</button>

    </form>

</div>

</body>

</html>
