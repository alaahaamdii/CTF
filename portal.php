<?php

include("security.php");
include("selections.php");

if(isset($_POST["form"]) && isset($_POST["bug"]))
{

    $key = $_POST["bug"];
    $bug = explode(",", trim($bugs[$key]));

    header("Location: " . $bug[1]);

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Portal</title>

</head>

<body>

<div id="menu">

    <table>

        <tr>
            <td>Main</td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
	    <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>
        </tr>

    </table>

</div>

<div id="bug">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label>Choose the vulnerabilty :</label><br />

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
