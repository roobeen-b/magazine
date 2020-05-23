<?php
  //ob_start();
  include $_SERVER['DOCUMENT_ROOT'].'config/init.php';

  //redirect('cms/index');
 // @header("location: cms/index");

  $user = new user();
  $data = array(
  	'username' => 'rubin',
  	'session_token' => tokenizer()
  );
  $user->deleteUserByEmail('rubin@magazine.com');
 ?>
