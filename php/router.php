<?php
session_start();

if( isset( $_GET['action'] ) ){
  if ( $_GET["action"] == "out" ) {
    session_destroy();
    header( "Location: ". './' );
  }
  //Other action
}

if ( !isset($_COOKIE['sid']) ){
   session_destroy();
   header( "Location: ". './' );
}

if ( !isset($_SESSION['logged_user']) ) {
   header( "Location: ". './' );
}
?>
