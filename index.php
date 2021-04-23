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
  <h4 class="card-title mt-2">Index Pages</h4>
    <a  href="home.php" class="btn btn-secondary btn-block" > Home </a>
</header>
<article class="card-body">
<form method="POST" action="crawler.php">
  <div class="form-row">
        <div class="form-group col-md-12">
            Seed URL :
            <input class="form-control" type="text" name="URL" placeholder="Type URL" required>
        </div> <!-- form-group// -->      
        <div class="form-group col-md-8">
            Max Page Limit (500) :
            <input class="form-control" type="number" max="500" name="pageLimit" placeholder="Type Page Limit" required>
        </div> <!-- form-group// -->     
        <div class="form-group col-md-8">
            <button type="submit" class="btn btn-info btn-block"> Index Webpage  </button>
        </div> <!-- form-group// -->     
	</div> <!-- form-row end.// -->
 
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
