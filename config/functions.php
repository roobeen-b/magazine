<?php
  function debugger($data, $is_die=false){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if ($is_die) {
      exit();
    }
  }

  function sanitizer($str){
    return trim(stripcslashes(strip_tags($str)));
  }

  function tokenizer($n=10){
    $char = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789';
    $result = '';
    for ($i=0; $i < $n; $i++) {
      $index = rand(0, strlen($char)-1);
      $result .= $char[$index];
    }
    return $result;
  }

  function redirect($loc, $key="", $message=""){
    $_SESSION[$key] = $message;
    @header ['location: ' .$loc];
  }
 ?>
