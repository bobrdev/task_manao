<?php
require_once('ResponseGenerator.class.php');
require_once('User.class.php');

class Database {
    private $fileName = "users.xml";
    public $list_Accounts = array();
    private $RG; //ResponseGenerator

    public function __construct(){
      $this->loadData();
      $this->RG = new ResponseGenerator();
    }

    public function loadData(){
      $pos = strripos( $this->fileName, '.xml');
      if ($pos === false) {
        //echo "Неверное расширение файла, должно быть .xml а вы ввели $this->fileName ";
        exit();
      } else {
          $this->fileName =  $_SERVER['DOCUMENT_ROOT']."/xml/".$this->fileName;
      }

      if( !file_exists (  $this->fileName ) ){
        //echo "Файла с таким именем нет в папке xml";
        exit();
      }

      $root = new SimpleXMLElement( file_get_contents( $this->fileName ) );

      foreach ( $root->user as $user ) {
         $this->list_Accounts[] = new User($user->login,
                                           $user->name,
                                           $user->email,
                                           $user->password,
                                           $user->salt);
      }
   }

   private function saveData(){
      //Создает XML-строку и XML-документ при помощи DOM
      $xml = new DOMDocument( '1.0', 'UTF-8' );
      $xml->formatOutput = true;

      $xml_users = $xml->createElement( "users" );

      foreach ( $this->list_Accounts as $user ) {
          $xml_user = $xml->createElement( 'user' );

          $xml_user_login = $xml->createElement( 'login', $user->getLogin() );
          $xml_user_name = $xml->createElement( 'name', $user->getName() );
          $xml_user_email = $xml->createElement( 'email', $user->getEmail() );
          $xml_user_password = $xml->createElement( 'password', $user->getPassword() );
          $xml_user_salt = $xml->createElement( 'salt', $user->getSald() );

          $xml_user->appendChild( $xml_user_login );
          $xml_user->appendChild( $xml_user_name );
          $xml_user->appendChild( $xml_user_email );
          $xml_user->appendChild( $xml_user_password );
          $xml_user->appendChild( $xml_user_salt );

          $xml_users->appendChild( $xml_user );
      }

      $xml->appendChild( $xml_users );
      $xml->save( $this->fileName );
   }

   private function isUserExist($user){
      foreach ( $this->list_Accounts as $user_db ) {
         if ( $user_db->getLogin() == $user['login'] ){
            return $this->RG->create_response('error', 101);
         }

         if( $user_db->getEmail() == $user['email']  ){
            return $this->RG->create_response('error', 102);
         }
      }
      return $arrayName = array('status' => 'free',);
   }

   private function generateSalt(){
      $max = 40; ///Количество символов в salt.

      // Символы, которые будут использоваться в salt.
      $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

      $size=StrLen($chars)-1;

      $salt = null;

      while( $max-- ){ $salt.=$chars[rand(0,$size)]; }

      return $salt;
   }

   public function addNewUser($user){
      $checkResult = $this->isUserExist($user);

      if ( $checkResult['status'] == 'error') {
         return $checkResult;
      }

      $salt = $this->generateSalt();
      $concat_pass_salt = (string)$user['password'].$salt;
      $hash = sha1( $concat_pass_salt );

      $this->list_Accounts[] = new User($user['login'], $user['name'], $user['email'], $hash, $salt);

      $this->saveData();
      return $this->RG->create_response('success', 1);
   }

   public function getUserByLoginOrEmail($login){
      foreach ( $this->list_Accounts as $user_db ) {
         if ( (string)$user_db->getLogin()== (string)$login ){
            return $user_db;
         }

         if( (string)$user_db->getEmail()== (string)$login ){
            return $user_db;
         }
      }

      return array('error' => 'user not exist', );
   }

}

?>
