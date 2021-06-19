<?php

include("../security.php");
include("../selections.php");

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>PHP Code Injection</title>

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

    <h1>PHP Code Injection</h1>

    <p>This is just a test page, reflecting back your <a href="<?php echo($_SERVER["SCRIPT_NAME"]);?>?message=test">message</a>...</p>
    
<?php

if(isset($_REQUEST["message"]))
{

    // If the security level is not MEDIUM or HIGH
    if($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2")
    {

?>
    <p><i><?php @eval ("echo " . $_REQUEST["message"] . ";");?></i></p>

<?php

    }

    // If the security level is MEDIUM or HIGH
    else
    {
?>
    <p><i><?php echo htmlspecialchars($_REQUEST["message"], ENT_QUOTES, "UTF-8");;?></i></p>

<?php

    }

}

?>
</div>

</body>

</html>
