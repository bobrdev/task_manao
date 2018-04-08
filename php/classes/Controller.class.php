<?php
require_once('ResponseGenerator.class.php');
require_once('Database.class.php');

class Controller {
   private $RG; //ResponseGenerator
   private $DB; //Database

   public function __construct(){
     $this->RG = new ResponseGenerator();
     $this->DB = new Database();
   }

   private function filter_data($str){
      //trim or any code for check user date
      $rez = trim( $str );
      return $rez;
   }

   public function registration_user($data){
      if( !isset($data['password']) || !isset($data['confirm_password']) ){
         $this->RG->create_response('error', 103);
      }
      if( $data['password'] != $data['confirm_password'] ){
         $this->RG->create_response('error', 104);
      }
      if(  !isset($data['email']) || !isset($data['login']) ){
         $this->RG->create_response('error', 105);
      }

      if($data['login'] == "" || $data['email'] == "" || $data['user_name'] == "" || $data['password'] == ""){
         $this->RG->create_response('error', 105);
      }

      $user = array(
                     'login' => $this->filter_data( $data['login'] ),
                     'name' => $this->filter_data( $data['user_name'] ),
                     'email' => $this->filter_data( $data['email'] ),
                     'password' => $this->filter_data( $data['password'] ),
                    );

      return $this->DB->addNewUser($user);
   }

   private function saveSession( $user_date ){
      session_start();
      $_SESSION["logged_user"] = $user_date;
      // Save session id in cookies
      $sid = session_id();

      //$expire = time() + $days * 24 * 3600;
      $expire = time() + 600; //10 min
      $secure = false;
      $path = "/";

      $cookie = setcookie("sid", $sid, $expire, $path, $secure);
   }

   public function authorization_user($data){
      if( !isset($data['login']) || !isset($data['password']) ){
         $this->RG->create_response('error', 203);
      }

      $user = $this->DB->getUserByLoginOrEmail( $this->filter_data( $data['login'] ) );

      if ( is_array( $user ) ){
         return $this->RG->create_response('error', 201);
      }

      $concat_pass_salt = $data['password'].$user->getSald();

      if( sha1( $concat_pass_salt ) == $user->getPassword() ){
         $user_date_for_session = array( 'login' => $user->getLogin() ,
                                         'name' => $user->getName() );

         $this->saveSession( $user_date_for_session );
         return $this->RG->create_response('success', 2);
      }else{
         return $this->RG->create_response('error', 202);
      }

   }

}
?>
