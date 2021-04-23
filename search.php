<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>

<body style="background-color:#E6E6FA;">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-12">
<div class="card">
<header class="card-header">
  <h4 class="card-title mt-2">Search a Page</h4>
    <a  href="home.php" class="btn btn-secondary btn-block" > Home </a>
</header>
<article class="card-body">
<form method="GET" action="search.php">
  <div class="form-row">
        <div class="form-group col-md-6">
            Keyword :
            <input class="form-control" type="text" name="keyword" placeholder="Type Keyword">
            <div class="form-group col-md-8">
                    <label class="radio-inline"><input type="radio" value="Title" name="option">Title </label>
                    <label class="radio-inline"><input type="radio" value="Keyword" name="option">Keyword </label>
                    <label class="radio-inline"><input type="radio" value="Desc" name="option">Description </label>
                    <label class="radio-inline"><input type="radio" value="All" name="option">All </label>
            </div> <!-- form-group// -->     
        </div> <!-- form-group// -->     
     
        <div class="form-group col-md-8">
            <button type="submit" class="btn btn-info btn-block"> Search Webpage </button>
        </div> <!-- form-group// -->     
	</div> <!-- form-row end.// -->
    <div class="container">
<?php
    $conn;
    $keyword = $_GET['keyword'];

    function startDB(){
        global $conn;

        $servername = "undcsmysql.mysql.database.azure.com";
        $username = "saroj.mishra@undcsmysql";
        $password = "smishra5138";
        $dbname = "saroj_mishra";
        
        $conn = mysqli_connect($servername,$username,$password,$dbname);
        
        if(!$conn){
            die("Connection Failed due to " . mysqli_connect_error());
        }
    }

   
?>
  <h2> Search Result: </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>URL</th>
        <?php 
            if($_GET['option'] == "Title" OR $_GET['option'] == "All"){
                echo "<th>Title</th>";
            }
        ?>
         <?php 
             if($_GET['option'] == "Desc" OR $_GET['option'] == "All"){
                echo "<th>Desc</th>";
            }
        ?>
         <?php 
            if($_GET['option'] == "Keyword" OR $_GET['option'] == "All"){
                echo "<th>Keywords</th>";
            }
        ?>
      </tr>
    </thead>
    
      
    <?php global $keyword;  global $conn; startDB(); if($keyword != NULL){
        $result_query = "SELECT url_id, urls, keyword, descriptions, title
                    FROM urls u
                    LEFT OUTER JOIN keyword k ON u.keyword_id = k.keyword_id
                    LEFT OUTER JOIN descriptions d ON u.desc_id = d.desc_id
                    LEFT OUTER JOIN title t ON u.title_id = t.title_id WHERE 
                    (keyword LIKE '%$keyword%') 
                    OR (title LIKE '%$keyword%') 
                    OR (urls LIKE '%$keyword%') 
                    OR (descriptions LIKE '%$keyword%')";
        
            if($result = mysqli_query($conn,$result_query)){
                if(mysqli_num_rows($result) > 0){
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){ 
                        
                        echo "<tbody>";
                        echo "<tr>";
                        echo  "<td>" .$i. "</td>";
                        echo  "<td>" . "<a href=".$row['urls'].">".$row['urls']."</a>". "</td>";
                        if($_GET['option'] == "Title" OR $_GET['option'] == "All"){
                            echo  "<td>" .$row['title']. "</td>";
                        }
                        if($_GET['option'] == "Desc" OR $_GET['option'] == "All"){
                            echo  "<td>" .$row['descriptions']. "</td>";
                        }
                        if($_GET['option'] == "Keyword" OR $_GET['option'] == "All"){
                            echo  "<td>" .$row['keyword']. "</td>";
                        }      
                        echo "</tr>";
                        echo "</tbody>";
                        $i += 1;
                       
                    }
                } else{
                    echo "result = 0";
                }
            }
    }else{
        if($_GET['option'] == "All"){
            $result_query = "SELECT url_id, urls, keyword, descriptions, title
                    FROM urls u
                    LEFT OUTER JOIN keyword k ON u.keyword_id = k.keyword_id
                    LEFT OUTER JOIN descriptions d ON u.desc_id = d.desc_id
                    LEFT OUTER JOIN title t ON u.title_id = t.title_id ";
            if($result = mysqli_query($conn,$result_query)){
                if(mysqli_num_rows($result) > 0){
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){ 
                        
                        echo "<tbody>";
                        echo "<tr>";
                        echo  "<td>" .$i. "</td>";
                        echo  "<td>" . "<a href=".$row['urls'].">".$row['urls']."</a>". "</td>";
                        echo  "<td>" .$row['title']. "</td>";
                        echo  "<td>" .$row['descriptions']. "</td>";
                        echo  "<td>" .$row['keyword']. "</td>";     
                        echo "</tr>";
                        echo "</tbody>";
                        $i += 1;
                       
                    }
                } else{
                    echo "result = 0";
                }
            }

        } else{
            echo "Please write keyword to search...";

        }
    }
    ?>
      
  </table>
</div>
 
</form>
</article> <!-- card-body end .// -->
<form method="POST" action="reset.php">
<div class="border-top card-body text-center">
    
        <div class="form-group">
            <input class="form-control" type="password" name="password" value="" placeholder="Password">
        </div> <!-- form-group end.// -->  
    <div class="form-row">
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-info btn-block" > Reset </button>
        </div> 
        <div class="form-group col-md-4">
            <button type="submit" formaction = "help.php" class="btn btn-info btn-block"> Help  </button>
        </div> 
        <div class="form-group col-md-4">
            <button type="submit" formaction = "check.php" class="btn btn-info btn-block"> Display Source  </button>
        </div> 
    </div>
</div>
</form>
</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->
</div> 
<!--container end.//-->
</body>
</html>
