<?php
 header( "Content-type: text/plain" );

   if ( $_POST['password'] == "saroj123" ) {
       header( "Content-type: text/plain" );
     
       echo  ( "\n\n\n============================ Login1(index.html) ============================= \n\n\n" );
       $file = fopen( "index.html", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo  ( "\n\n\n============================ Login2(login.php) ============================= \n\n\n" );
       $file = fopen( "login.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo  ( "\n\n\n============================ Home(home.php) ============================= \n\n\n" );
       $file = fopen( "home.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo   ( "\n\n\n============================ Index Webpage(index.php) ============================= \n\n\n" );
       $file = fopen( "index.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo  ( "\n\n\n============================ Spider(crawler.php) ============================= \n\n\n" );
       $file = fopen( "crawler.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo  ( "\n\n\n============================ Search Webpage(search.php) ============================= \n\n\n" );
       $file = fopen( "search.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );

       echo  ( "\n\n\n============================ reset.php ============================= \n\n\n" );
       $file = fopen( "reset.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
    
      echo  ( "\n\n\n============================== Check.php ============================== \n\n\n" );
      $file = fopen( "check.php", "r" ) or exit( "Unable to open file!" );
      while ( !feof( $file ) )  echo  fgets( $file );
      fclose( $file );
 
      echo  ( "\n\n\n============================== help.php ============================== \n\n\n" );
      $file = fopen( "help.php", "r" ) or exit( "Unable to open file!" );
      while ( !feof( $file ) )  echo  fgets( $file );
      fclose( $file );

   }

   else {
     header( "Content-type: text/html" );
     echo  "<html><body><h3>Wrong password: <em>";
     echo  $_POST['password'];
     echo  "</em></h3></body></html>";
   }

?>
