<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>
<div class="row justify-content-center">
<div class="col-md-12">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Reset System </h4>
    <a  href="home.php" class="btn btn-secondary btn-block" > Home </a>
</header>
</div>
</div>
</div>
<?php
    if($_POST['password'] == "saroj123"){
      
        $delete_url_sql = "DELETE FROM urls";
        checkDB($delete_url_sql);
        $delete_keyword_sql = "DELETE FROM keyword";
        checkDB($delete_keyword_sql);
        $delete_title_sql = "DELETE FROM title";
        checkDB($delete_title_sql);
        $delete_desc_sql = "DELETE FROM descriptions";
        checkDB($delete_desc_sql);
      
    }else{
       echo "Wrong Password";
     }

    function checkDB($sql){
        $servername = "undcsmysql.mysql.database.azure.com";
        $username = "saroj.mishra@undcsmysql";
        $password = "smishra5138";
        $dbname = "saroj_mishra";
        
        $conn = mysqli_connect($servername,$username,$password,$dbname);
        
        if(!$conn){
            die("Connection Failed due to " . mysqli_connect_error());
        }

        if ($conn->query($sql) === TRUE) 
            echo "Deleted successfully!!!";
        else 
            echo "Error: " . $sql . "<br>" . $conn->error;
    }
     
?>
</html>
