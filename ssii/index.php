<?php

include("../security.php");
include("../functions_external.php");
include("../selections.php");

$field_empty = 0;

function xss($data)
{

    switch("0")
    {

        case "0" :

            $data = no_check($data);
            break;

      /*  case "1" :

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

if(isset($_POST["form"]))
{

    $firstname = ucwords(xss($_POST["firstname"]));
    $lastname = ucwords(xss($_POST["lastname"]));

    if($firstname == "" or $lastname == "")
    {

        $field_empty = 1;

    }

    else
    {

        $line = '<p>Hello ' . $firstname . ' ' . $lastname . ',</p><p>Your IP address is:' . '</p><h1><!--#echo var="REMOTE_ADDR" --></h1>';

        // Writes a new line to the file
        $fp = fopen("ssii.shtml", "w");
        fputs($fp, $line, 200);
        fclose($fp);

        header("Location: ssii.shtml");

        exit;

    }

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>SSI Injection</title>

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

    <h1>Server-Side Includes (SSI) Injection</h1>

    <p>What is your IP address? Lookup your IP address... </p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="firstname">First name:</label><br />
        <input type="text" id="firstname" name="firstname"></p>

        <p><label for="lastname">Last name:</label><br />
        <input type="text" id="lastname" name="lastname"></p>

        <button type="submit" name="form" value="submit">Lookup</button>  

    </form>

    <br />
    <?php

    if($field_empty == 1)
    {

        echo "<font color=\"red\">Please enter both fields...</font>";

    }

    else
    {

        echo "";

    }

    ?>

</div>

</body>

</html>
