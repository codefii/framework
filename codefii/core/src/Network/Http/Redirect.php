<?php

namespace Codefii\Http;

final class Redirect
{
  protected static  $with;
  protected static $instance =null;

  public function __construct(){
    ob_start();
  }
  
  public  static function with($value){
    static::$with = $value;
    return new static;
   
  }
  public static function get(){
    return static::$with;
  }
  public  static function to($url,array $param=null){

   if(self::$instance==null){
      self::$instance = new self;
    }

  }
}
