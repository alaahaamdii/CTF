<?php

include("security.php");
include("functions_external.php");
include("selections.php");

$url= "";

        
switch($_COOKIE["security_level"])
{

   /* case "0" :

        // $url = "http://" . $_SERVER["HTTP_HOST"] . urldecode($_SERVER["REQUEST_URI"]);
        $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];           
        break;*/

    case "1" :

        $url = "<script>document.write(document.URL)</script>";
        break;

   /* case "2" :

        $url = "http://" . $_SERVER["HTTP_HOST"] . xss_check_3($_SERVER["REQUEST_URI"]);
        break;*/

    default :

        $url = "<script>document.write(document.URL)</script>";
        break;

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>HTML Injection</title>

</head>

<body>   

<div id="menu">
      
    <table>
        
        <tr>
            
            <td><a href="portal.php">Main</a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>
            
        </tr>
        
    </table>   
   
</div> 

<div id="main">
    
    <h1>HTML Injection - Reflected (URL)</h1>   

    <?php echo "<p align=\"left\">Your current URL: <i>" . $url . "</i></p>";?>    

</div>
  
<div id="bug">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">
        
        <label>Choose the vulnerability :</label><br />
        
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
