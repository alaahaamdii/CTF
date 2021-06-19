<?php

include("../security.php");
include("../selections.php");
include("../functions_external.php");
include("../connect_i.php");

function sqli($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        case "1" :

            $data = sqli_check_1($data);
            break;

        case "2" :

            $data = sqli_check_2($data);
            break;

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

    <h1>SQL Injection - Blind - Boolean-Based</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="GET">

        <p>

        <label for="title">Search for a movie:</label>
        <input type="text" id="title" name="title" size="25">

        <button type="submit" name="action" value="search">Search</button>

        </p>

    </form>
    <?php

    if(isset($_REQUEST["title"]))
    {

        $title = $_REQUEST["title"];

        $sql = "SELECT * FROM movies WHERE title = '" . sqli($title) . "'";

        $recordset = mysqli_query($link, $sql);

        if(!$recordset)
        {

            die("<font color=\"red\">Incorrect syntax detected!</font>");

        }

        if(mysqli_num_rows($recordset) != 0)
        {

            echo "The movie exists in our database!";

        }

        else
        {

            echo "The movie does not exist in our database!";

        }

        mysqli_close($link);

    }

    ?>
</div>

</body>

</html>
