<?php

include("../security.php");
include("../selections.php");
include("../functions_external.php");
include("../connect_i.php");

if($_COOKIE["security_level"] == "2")
{

    header("Location: sqli_13-ps.php");

    exit;

}

// Selects all the records
$sql = "SELECT * FROM movies";

$recordset = mysqli_query( $link , $sql );

function sqli($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        case "1" :

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

    <h1>SQL Injection (POST/Select)</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="POST">

        <p>Select a movie:

        <select name="movie">

<?php

            // Fills the 'select' object
            while($row = mysqli_fetch_array($recordset))
            {

?>
            <option value="<?php echo $row["id"];?>"><?php echo $row["title"];?></option>
<?php

            }

?>

        </select>

        <button type="submit" name="action" value="go">Go</button>

        </p>

    </form>

    <table id="table_yellow">

        <tr height="30" bgcolor="#ffb717" align="center">

            <td width="200"><b>Title</b></td>
            <td width="80"><b>Release</b></td>
            <td width="140"><b>Character</b></td>
            <td width="80"><b>Genre</b></td>
            <td width="80"><b>IMDb</b></td>

        </tr>
<?php

if(isset($_POST["movie"]))
{

    $id = $_POST["movie"];

    $sql = "SELECT * FROM movies";

    // If the user selects a movie
    if($id)
    {

        $sql.= " WHERE id = " . sqli($id);

    }

    $recordset = mysqli_query( $link , $sql);

    if(!$recordset)
    {


?>

        <tr height="50">

            <td colspan="5" width="580"><?php die("Error: " . mysqli_error()); ?></td>

        </tr>
<?php

    }

    // Shows the movie details when a valid record exists
    if(mysqli_num_rows($recordset) != 0)
    {

        $row = mysqli_fetch_array($recordset);

?>

        <tr height="30">

            <td><?php echo $row["title"]; ?></td>
            <td align="center"><?php echo $row["release_year"]; ?></td>
            <td><?php echo $row["main_character"]; ?></td>
            <td align="center"><?php echo $row["genre"]; ?></td>
            <td align="center"><a href="http://www.imdb.com/title/<?php echo $row["imdb"]; ?>" target="_blank">Link</a></td>

        </tr>
<?php

    }

    else
    {

?>

        <tr height="30">

            <td colspan="5" width="580">No movies were found!</td>

        </tr>
<?php

    }

}

else
{

?>

        <tr height="30">

            <td colspan="5" width="580"></td>

        </tr>
<?php

}

mysqli_close($link);

?>

    </table>

</div>

</body>

</html>
