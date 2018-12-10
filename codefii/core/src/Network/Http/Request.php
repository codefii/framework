<?php

namespace Codefii\Http;
use Codefii\Session\Token;
class Request
{
  public static $post_type=null;
  public static function isPost(){
    self::$post_type ='post';
    if(isset(self::$post_type)){
      // if(Token::check('token')){
        return $_POST;
      // }
    }
  }
  public static function getPostData(){
    if(isset(self::$post_type)){
      return $_POST;
    }
  }
  public static function exists($type='post')
  {
    switch($type){
      case 'post':
      return (!empty($_POST)) ? true :false;
      break;
      case 'get':
      return (!empty($_GET)) ? true :false;
      break;
      default:
      return false;
      break;

    }

  }
  public static function get($item)
  {
    if(isset($_POST[$item]))
    {
      return $_POST[$item];
    }else{
      return $_GET[$item];
    }
    return '';//return an empty string
  }
 

}
