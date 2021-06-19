<?php

include("functions_external.php");
include("connect_i.php");
include("admin/settings.php");

$message = "";

if(isset($_REQUEST["action"]))
{

    $login = $_REQUEST["login"];
    $password = $_REQUEST["password"];
    $password_conf = $_REQUEST["password_conf"];

    if($login == "" or  $password == "" )
    {

        $message = "<font color=\"red\">Please fill all the fields!</font>";

    }

    else
    {

        if(preg_match("/^[a-z\d_]{2,20}$/i", $login) == false)
        {

            $message = "<font color=\"red\">Please choose a valid login name!</font>";

        }

        else
        {

                if($password != $password_conf)
                {

                    $message = "<font color=\"red\">The passwords don't match!</font>";

                }

                else
                {

                    // Input validations
                    $login = mysqli_real_escape_string($link, $login);
                    $login = htmlspecialchars($login, ENT_QUOTES, "UTF-8");

                    $password = mysqli_real_escape_string($link, $password);
                    $password = hash("sha1", $password, false);

                    $sql = "SELECT * FROM users WHERE login = '" . $login ."'";

                    $recordset = $link->query($sql);

                    if(!$recordset)
                    {

                        die("Error: " . $link->error);

                    }

                    $row = $recordset->fetch_object();

                    // If the user is not present
                    if(!$row)
                    {

                            $sql = "INSERT INTO users (login, password) VALUES ('" . $login . "','" . $password . "')";

                            $recordset = $link->query($sql);

                            if(!$recordset)
                            {

                                die("Error: " . $link->error);

                            }

                            $message = "<font color=\"green\">User successfully created!</font>";

                    }

                    else
                    {

                        $message = "<font color=\"red\">The login already exists!</font>";

                    }

                }

        }

    }

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>New User</title>

</head>

<body>

<div id="menu">

    <table>

        <tr>

            <td><a href="login.php">Login</font></a></td>
            <td>New User</td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>New User</h1>

    <p>Create a new user.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <table>

        <tr><td>

        <p><label for="login">Login:</label><br />
        <input type="text" id="login" name="login"></p>

        </td>

        <td width="5"></td>

        </tr>

        <tr><td>

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password"></p>

        </td>

        <td width="25"></td>

        <td>

        <p><label for="password_conf">Re-type password:</label><br />
        <input type="password" id="password_conf" name="password_conf"></p>

        </td></tr>

        </table>

        <button type="submit" name="action" value="create">Create</button>

    </form>

    <br />
    <?php

    echo $message;

    $link->close();

    ?>

</div>

</body>

</html>
