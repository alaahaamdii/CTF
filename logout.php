<?php

include("security.php");

// Destroys the session 
$_SESSION = array();
session_destroy();

// Deletes the cookies
setcookie("admin", "", time()-3600, "/", "", false, false);
setcookie("movie_genre", "", time()-3600, "/", "", false, false);
setcookie("secret", "", time()-3600, "/", "", false, false);
setcookie("top_security", "", time()-3600, "/", "", false, false);
setcookie("top_security_nossl", "", time()-3600, "/", "", false, false);
setcookie("top_security_ssl", "", time()-3600, "/", "", false, false);

header("Location: login.php");

?>
