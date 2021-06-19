<?php

include("../security.php");
include("../selections.php");
include("../functions_external.php");

if(!(isset($_GET["ParamUrl"])) || !(isset($_GET["ParamHeight"])) || !(isset($_GET["ParamWidth"])))
{

    header("Location: index.php?ParamUrl=robots.txt&ParamWidth=250&ParamHeight=250");

    exit;

}

function xss($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);      
            break;

        /*case "1" :

            $data = xss_check_4($data);
            break;

        case "2" :

            $data = xss_check_3($data);
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

<title>iFrame Injection</title>

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

    <h1>iFrame Injection</h1>

<?php

if($_COOKIE["security_level"] == "1" || $_COOKIE["security_level"] == "2")
{

?>
    <iframe frameborder="0" src="robots.txt" height="<?php echo xss($_GET["ParamHeight"])?>" width="<?php echo xss($_GET["ParamWidth"])?>"></iframe>
<?php

}

else
{

?>
    <iframe frameborder="0" src="<?php echo xss($_GET["ParamUrl"])?>" height="<?php echo xss($_GET["ParamHeight"])?>" width="<?php echo xss($_GET["ParamWidth"])?>"></iframe>
<?php

}

?>

</div>

</body>

</html>
