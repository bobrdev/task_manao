<?php

if ( isset( $_POST['action'] ) ) {
   require_once('classes\Controller.class.php');

   $controller = new Controller();

   switch ( (string)$_POST['action'] ) {
      case 'REGISTRATION':
         $response = $controller->registration_user($_POST);
         echo json_encode($response);
         break;
      case 'AUTHORIZATION':
         $response = $controller->authorization_user($_POST);
         echo json_encode($response);
         break;
      default:
         json_encode("action not found!");
         break;
   }

}else{
   echo json_encode("access denaided!");
}

?>
