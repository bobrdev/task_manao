<?php
class ResponseGenerator {
  private $response_list = array(
     'success' =>
     array( '1'  => array('operation' => 'registration', 'status' => 'success', 'message' => 'Вы успешно зарегистрировались! Теперь можете войти в свой аккаунт.'),
            '2' => array('operation' => 'authorization', 'status' => 'success', 'message' => 'Вы успешно авторизовались!'),
      ),
     'error' =>
     array( '101' => array('operation' => 'registration', 'status' => 'error', 'message' => 'Логин занят!'),
            '102' => array('operation' => 'registration', 'status' => 'error', 'message' => 'Пользователь с таким E-mail уже существует!'),
            '103' => array('operation' => 'registration', 'status' => 'error', 'message' => 'Поле пароля не заполненно!'),
            '104' => array('operation' => 'registration', 'status' => 'error', 'message' => 'Пароли не совпали!'),
           '105' => array('operation' => 'registration', 'status' => 'error', 'message' => 'Поле Логин или E-mail не заполненно!'),
           '201' => array('operation' => 'authorization', 'status' => 'error', 'message' => 'Неверный логин или E-mail!'),
           '202' => array('operation' => 'authorization', 'status' => 'error', 'message' => 'Неверный пароль!'),
           '203' => array('operation' => 'authorization', 'status' => 'error', 'message' => 'Поле Логин/E-mail или пароль заполненно!'),
     )
  );

   public function create_response( $type, $number ){
      if ( !$this->response_list[(string)$type][(string)$number] ) {
         throw new Exception('Ошибка, такого ответа в списке доступных нет!');
      }else{
         return $this->response_list[(string)$type][(string)$number];
      }
   }
}

?>
