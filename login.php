<?php

include("connect_i.php");
include("admin/settings.php");

session_start();

$message = "";

if(isset($_POST["form"]))
{

    $login = $_POST["login"];
    $login = mysqli_real_escape_string($link, $login);

    $password = $_POST["password"];
    $password = mysqli_real_escape_string($link, $password);
    $password = hash("sha1", $password, false);

    $sql = "SELECT * FROM users WHERE login = '" . $login;
    $sql.= "' AND BINARY password = '" . $password . "'";
    // Checks if the user is activated
    $sql.= " AND activated = 1";


    $recordset = $link->query($sql);

    if(!$recordset)
    {

        die("Error: " . $link->error);

    }

    else
    {

        $row = $recordset->fetch_object();

        if($row)
        {

            session_regenerate_id(true);

            $token = sha1(uniqid(mt_rand(0,100000)));

            $_SESSION["login"] = $row->login;
            $_SESSION["admin"] = $row->admin;
            $_SESSION["token"] = $token;
            $_SESSION["amount"] = 1000;

            $security_level_cookie = $_POST["security_level"];

            switch($security_level_cookie)
            {

                case "0" :

                    $security_level_cookie = "0";
                    break;

             /*   case "1" :

                    $security_level_cookie = "1";
                    break;

                case "2" :

                    $security_level_cookie = "2";
                    break;*/

                default :

                    $security_level_cookie = "0";
                    break;

            }

            setcookie("security_level", $security_level_cookie, time()+60*60*24*365, "/", "", false, false);

            header("Location: portal.php");

            exit;

        }

        else
        {

        $message = "<font color=\"red\">Invalid credentials or user not activated!</font>";

        }

    }

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Login</title>

</head>

<body>

<div id="menu">

    <table>

        <tr>

            <td>Login</td>
            <td><a href="user_new.php">New User</a></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>Login</h1>

    <p>Enter your credentials :</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Login:</label><br />
        <input type="text" id="login" name="login" size="20" autocomplete="off"></p> 

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password" size="20" autocomplete="off"></p>

        <button type="submit" name="form" value="submit">Login</button>

    </form>

    <br />
    <?php

    echo $message;

    $link->close();

    ?>

</div>

</body>

</html>
