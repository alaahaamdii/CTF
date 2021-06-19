<?php

include("../security.php");
include("../selections.php");
include("../functions_external.php");
include("../connect_i.php");

$message = "";

function sqli($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

      /*  case "1" :

            $data = sqli_check_1($data);
            break;

        case "2" :

            $data = sqli_check_2($data);
            break;
*/
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

<title>SQL Injection</title>

</head>

<body>

<header>

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

    <h1>SQL Injection (Login Form/Hero)</h1>

    <p>Enter your 'superhero' credentials.</p>

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

        $login = $_POST["login"];
        $login = sqli($login);

        $password = $_POST["password"];
        $password = sqli($password);

        $sql = "SELECT * FROM heroes WHERE login = '" . $login . "' AND password = '" . $password . "'";

        // echo $sql;

	$recordset = mysqli_query( $link , $sql);

        if(!$recordset)
        {

	die("Error: " . mysqli_error());

        }

        else
        {

            $row = mysqli_fetch_array($recordset);

            if($row["login"])
            {

                // $message = "<font color=\"green\">Welcome " . ucwords($row["login"]) . "...</font>";
                $message =  "<p>Welcome <b>" . ucwords($row["login"]) . "</b>, how are you today?</p><p>Your secret: <b>" . ucwords($row["secret"]) . "</b></p>";
                // $message = $row["login"];

            }

            else
            {

                $message = "<font color=\"red\">Invalid credentials!</font>";

            }

        }

        mysqli_close($link);

    }

    echo $message;

?>

</div>

</body>

</html>
