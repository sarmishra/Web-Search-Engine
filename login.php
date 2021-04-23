<html>
<?php

if ($_POST["password"] =='saroj123')
   {
        include 'home.php';
    }
else
   {
        echo '<script>alert("Wrong Password, Try Again !!!")</script>';        
	include 'index.html';
    }

?>
</html>