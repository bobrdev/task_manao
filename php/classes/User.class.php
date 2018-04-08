<?php
class User{
   private $login;
   private $name;
   private $email;
   private $password;
   private $sald;

   public function __construct($login, $name, $email, $password, $sald){
      $this->login = (string)$login;
      $this->name = (string)$name;
      $this->email = (string)$email;
      $this->password = (string)$password;
      $this->sald = (string)$sald;
   }

   public function getLogin(){
      return $this->login;
   }

   public function setLogin( $login ){
      $this->login = $login;
   }

   public function getName(){
      return $this->name;
   }

   public function setName( $name ){
      $this->name = $name;
   }

   public function getEmail(){
      return $this->email;
   }

   public function setEmail( $email ){
      $this->email = $email;
   }

   public function getPassword(){
      return $this->password;
   }

   public function setPassword( $password ){
      $this->password = $password;
   }

   public function getSald(){
      return $this->sald;
   }

   public function setSald( $sald ){
      $this->sald = $sald;
   }

}

?>
