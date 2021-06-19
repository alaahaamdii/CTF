<?php


include("../security.php");
include("../security_level_check.php");
include("../functions_external.php");
include("../selections.php");

ini_set("display_errors", 1);

function xmli($data)
{

    if(isset($_COOKIE["security_level"]))
    {

        switch($_COOKIE["security_level"])
        {

            case "0" :

                $data = no_check($data);
                break;

            case "1" :

                $data = xmli_check_1($data);
                break;

            case "2" :

                $data = xmli_check_1($data);
                break;

            default :

                $data = no_check($data);
                break;

        }

    }

    return $data;

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>XML/XPath Injection</title>

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
    
    <h1>XML/XPath Injection (Search)</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="GET">

        <p>

        <label for="genre">Search movies by genre:</label>
        <select name="genre">
                    
                <option value="action">Action</option>";
                <option value="horror">Horror</option>";
                <option value="sci-fi">Science Fiction</option>";

        </select> 

        <button type="submit" name="action" value="search">Search</button>

        </p>

    </form>

    <table id="table_yellow">

        <tr height="40" bgcolor="#ffb717" align="center">

            <td width="10">#</td>
            <td width="200"><b>Movie</b></td>

        </tr>
<?php

if(isset($_REQUEST["genre"])) 
{
    
    $genre = $_REQUEST["genre"];
    $genre = xmli($genre);
   
    // Loads the XML file
    $xml = simplexml_load_file("passwords/heroes.xml");
     
    // XPath search
    // $result = $xml->xpath("//hero[genre = '$genre']/movie");
    $result = $xml->xpath("//hero[contains(genre, '$genre')]/movie");
    
    // Case insensitive search
    // $result = $xml->xpath("//hero[contains(translate(genre, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), translate('$genre', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'))]/movie");
    
    // $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZÆØÅ";
    // $lower = "abcdefghijklmnopqrstuvwxyzæøå";
    
    // $result = $xml->xpath("//hero[contains(translate(genre, '$upper', '$lower'), translate('$genre', '$upper', '$lower'))]/movie");

    // Debugging
    // print_r($result);  
    // echo $result[0][0];  
    // echo $result[0]->login;

    if($result)
    {    

        foreach($result as $key => $row)       
        {

            // print_r($row);    

?>

        <tr height="40">

            <td align="center"><?php echo $key + 1?></td>
            <td><?php echo $row;?></td>

        </tr>         
<?php        

        }        

    }

    else
    {

?>

        <tr height="40">

            <td colspan="5" width="210">No movies were found!</td>
 
        </tr>     
<?php        

    }

}

else
{

?>

        <tr height="40">

            <td colspan="5" width="210"></td>

        </tr>
<?php

}

?>

    </table>    

</div>
    
</body>
    
</html>
