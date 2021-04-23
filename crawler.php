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
  <h4 class="card-title mt-2">Web Crawler</h4>
    <a  href="home.php" class="btn btn-secondary btn-block" > Home </a>
</header>
</div>
</div>
</div>
<?php

    $visitedLink = array();
    $seedUrl = $_POST['URL'];
    $pageLimit = $_POST['pageLimit'];
    $conn;
    

    function webCrawl($url,$depth = 5){

        global $visitedLink;
        global $pageLimit;
        global $seedUrl;

            if($depth < 0)
                return;

            $doc = new DomDocument();

            @$doc -> loadHTML(@file_get_contents($url));

            $links = $doc -> getElementsByTagName('a');

            foreach ($links as $href) {

                    $link = $href -> getAttribute('href');
                
                    if($pageLimit > 500)
                        $pageLimit = 500;
                    
                    if(count($visitedLink) >= $pageLimit)
                        break;  

                    if (ignoreLink($link))
                        continue;

                    $link = convertReltoA($link,$url);
  
                    if(strpos($link,$seedUrl) !== false){

                        if (!in_array($link, $visitedLink)){

                            $visitedLink[] = $link;
                            indexPages($link);   

                        } 

                        foreach($visitedLink as $visit) {
                            webCrawl($visit, $depth - 1);
                        } 
                    }  
            }                   
    }

    function indexPages($link){

        global $seedUrl;
        global $conn;
        $desc = " ";
        $keyword = " ";

        $doc = new DOMDocument();

        @$doc->loadHTML(@file_get_contents($link));

        $title = $doc->getElementsByTagName("title");

        $pageTitle = $title->item(0)->nodeValue;
        
        $metaTag = $doc->getElementsByTagName("meta");

        for ($i = 0; $i < $metaTag->length; $i++) {
            $meta = $metaTag->item($i);
            if (strtolower($meta->getAttribute("name")) == "description")
                $desc = $meta->getAttribute("content");
            if (strtolower($meta->getAttribute("name")) == "keywords")
                $keyword = $meta->getAttribute("content");

        }
        
        if(strpos($link,$seedUrl) !== false){
            startDB();
            //Saving the KEYWORD for the webpage
            if($keyword != null){
                $check_keyword_sql = "SELECT * FROM keyword where keyword = '$keyword'";
                if($result = mysqli_query($conn, $check_keyword_sql)){
                    if(mysqli_num_rows($result) == 0){
                        $keyword_sql = "INSERT INTO keyword(keyword) VALUES ('$keyword')";
                        checkDB($keyword_sql);
                    }else{
                    }
                }
            }
           
            //Saving the DISCRIPTION for the WEB PAGE
            if($desc != null){
                $check_desc_sql = "SELECT * FROM descriptions where descriptions = '$desc'";
                if($result = mysqli_query($conn, $check_desc_sql)){
                    if(mysqli_num_rows($result) == 0){
                        $desc_sql = "INSERT INTO descriptions(descriptions) VALUES ('$desc')";
                        checkDB($desc_sql);
                    }else{
                    }
                }
            }
            //Saving the TITLE FOR the WEB PAGE
            if($pageTitle != null){

                $check_title_sql = "SELECT * FROM title where title = '$pageTitle'";
                if($result = mysqli_query($conn, $check_title_sql)){
                    if(mysqli_num_rows($result) == 0){
                        $title_sql = "INSERT INTO title(title) VALUES ('$pageTitle')";    
                        checkDB($title_sql);
                    }else{
                    }
                }
            }
            // //saving the URL for the web page
            if($link != null){

                $check_url_sql = "SELECT * FROM urls where urls = '$link'";
                if($result = mysqli_query($conn,$check_url_sql)){
                    if(mysqli_num_rows($result) == 0){
                        $url_sql = "
                        INSERT INTO urls (urls,keyword_id,desc_id,title_id) VALUES ('$link',
                        (SELECT keyword_id FROM keyword WHERE keyword ='$keyword'),
                        (SELECT desc_id from descriptions WHERE descriptions = '$desc'),
                        (SELECT title_id FROM title WHERE title='$pageTitle'))";
                        checkDB($url_sql);
                    }else{
                    }
                }
            }

        }  

    }

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

    function checkDB($sql){
        global $conn;

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function ignoreLink($url){
        return $url[0]=="#" or substr($url, 0, 11) == "javascript:"; 
    }

    function convertReltoA($originalLink,   $seedURL) {

        if (parse_url($originalLink,  PHP_URL_SCHEME)  !=  '') {
            return  $originalLink;
        }

        if ($originalLink[0] == '#'  ||   $originalLink[0] == '?') {
            return  $seedURL . $originalLink;
        }

        extract(parse_url($seedURL));
        $path  =  preg_replace('#/[^/]*$#',  '',   $path);
        if ($originalLink[0]  ==  '/') {
            $path  =  '';
        }

        $abs  =  "$host$path/$originalLink";
        $originalLink   =  array('#(/.?/)#',  '#/(?!..)[^/]+/../#');
        
        $abs = str_replace('../', '', $abs);
        return  $scheme . '://' . $abs;
    }

    webCrawl($seedUrl);
?>

</html>
