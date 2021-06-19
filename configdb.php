<?php

$message = "Click <a href=\"configdb.php?configdb=yes\">here</a> to configure .";
$db = 0;

if(isset($_REQUEST["configdb"]) && $_REQUEST["configdb"] == "yes")
{

    // Connection settings
    include("config.inc.php");

    // Connects to the server
    $link = new mysqli($server, $username, $password);

    // Checks the connection
    if($link->connect_error)
    {

        die("Connection failed: " . $link->connect_error);

    }

    // Checks if the database already exists
    if(!mysqli_select_db($link,"labdbhat"))
    {

        // Creates the database 
        $sql = "CREATE DATABASE IF NOT EXISTS labdbhat";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Selects the database 
         mysqli_select_db($link,"labdbhat");

        // Creates the 'users' table
        $sql = "CREATE TABLE IF NOT EXISTS users (id int(10) NOT NULL AUTO_INCREMENT,login varchar(100) DEFAULT NULL,password varchar(100) DEFAULT NULL,";
        $sql.= "activated tinyint(1) DEFAULT '0',";
        $sql.= "admin tinyint(1) DEFAULT '0',PRIMARY KEY (id)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Populates the table 'users' with the default users
        $sql = "INSERT INTO users (login, password, activated, admin) VALUES";
  
        $sql.= "('user', '12dea96fec20593566ab75692c9949596833adc9', 1 , 1)";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Creates the table 'blog' 
        $sql = "CREATE TABLE IF NOT EXISTS blog (id int(10) NOT NULL AUTO_INCREMENT,owner varchar(100) DEFAULT NULL,";
        $sql.= "entry varchar(500) DEFAULT NULL,date datetime DEFAULT NULL,PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Creates the table 'visitors'
        $sql = "CREATE TABLE IF NOT EXISTS visitors (id int(10) NOT NULL AUTO_INCREMENT,ip_address varchar(50) DEFAULT NULL,";
        $sql.= "user_agent varchar(500) DEFAULT NULL,date datetime DEFAULT NULL,PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        $recordset = $link->query($sql);             

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }      
        
        // Creates the table 'movies' 
        $sql = "CREATE TABLE IF NOT EXISTS movies (id int(10) NOT NULL AUTO_INCREMENT,title varchar(100) DEFAULT NULL,";
        $sql.= "release_year varchar(100) DEFAULT NULL,genre varchar(100) DEFAULT NULL,main_character varchar(100) DEFAULT NULL,";
        $sql.= "imdb varchar(100) DEFAULT NULL,tickets_stock int(10) DEFAULT NULL,PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Populates the table 'movies'
        $sql = "INSERT INTO movies (title, release_year, genre, main_character, imdb, tickets_stock) VALUES ('G.I. Joe: Retaliation', '2013', 'action', 'Cobra Commander', 'tt1583421', 100),";
        $sql.= "('Iron Man', '2008', 'action', 'Tony Stark', 'tt0371746', 53),";
        $sql.= "('Man of Steel', '2013', 'action', 'Clark Kent', 'tt0770828', 78),";
        $sql.= "('Terminator Salvation', '2009', 'sci-fi', 'John Connor', 'tt0438488', 100),";
        $sql.= "('The Amazing Spider-Man', '2012', 'action', 'Peter Parker', 'tt0948470', 13),";
        $sql.= "('The Cabin in the Woods', '2011', 'horror', 'Some zombies', 'tt1259521', 666),";
        $sql.= "('The Dark Knight Rises', '2012', 'action', 'Bruce Wayne', 'tt1345836', 3),";
        $sql.= "('The Fast and the Furious', '2001', 'action', 'Brian O\'Connor', 'tt0232500', 40),";
        $sql.= "('The Incredible Hulk', '2008', 'action', 'Bruce Banner', 'tt0800080', 23),";
        $sql.= "('World War Z', '2013', 'horror', 'Gerry Lane', 'tt0816711', 0)";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }
        
        // Creates the 'heroes' table
        $sql = "CREATE TABLE IF NOT EXISTS heroes (id int(10) NOT NULL AUTO_INCREMENT,login varchar(100) DEFAULT NULL,password varchar(100) DEFAULT NULL,secret varchar(100) DEFAULT NULL,";
        $sql.= "PRIMARY KEY (id)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        $recordset = $link->query($sql);             

        if(!$recordset)
        {

                die("Error: " . $link->error);

        }

        // Populates the table 'heroes' with the default users
        $sql = "INSERT INTO heroes (login, password, secret) VALUES";
        $sql.= "('neo', 'trinity', 'Oh why didn\'t I took that BLACK pill?'),";
        $sql.= "('alice', 'loveZombies', 'There\'s a cure!'),";
        $sql.= "('thor', 'Asgard', 'Oh, no... this is Earth... isn\'t it?'),";
        $sql.= "('wolverine', 'Log@N', 'What\'s a Magneto?'),";
        $sql.= "('johnny', 'm3ph1st0ph3l3s', 'I\'m the Ghost Rider!'),";
        $sql.= "('seline', 'm00n', 'It wasn\'t the Lycans. It was you.')";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

                die("Error: " . $link->error);

        }


        $message = "DB has been installed successfully!";

    }

    else
    {

        $message = "The database already exists...";

    }

    $db = 1;

    $link->close();

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>

<title>Configuration</title>

</head>

<body>

<div id="menu">

    <table>

        <tr>
        <?php

        if($db == 1)

        {

        ?>
            <td><a href="login.php">Login</a></td>
            <td><a href="user_new.php">New User</a></td>
        <?php

        }
        else
        {

        ?>
 
            <td>Install</td>
        <?php

        }
  
        ?>
        </tr>

    </table>

</div> 

<div id="main">

    <h1>Installation</h1>

    <p><?php echo $message?></p>

</div>
    
</body>

</html>
