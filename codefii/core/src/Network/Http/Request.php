<?php
namespace Codefii\Http;
class Request
{
  public static $method=array();

  public static $POST = "POST";

  public static $GET  = "GET";

  public static $DELETE = "DELETE";

  public static $PUT = "PUT";

 public static function exists():String{

   $method = self::getMethod();

    if($method){

      if($method==self::$POST){

        self::$method = $_POST;

      }else if($method==self::$GET){

        self::$method = $_GET;

      }else if($method==self::$DELETE || $method==self::$PUT){

        self::getContents();

        $GLOBALS["_{$method}"] = self::$method;

        $_REQUEST = self::$method + $_REQUEST;

      }
    }
    return $method;
 }
 public static function is(String $request=null):String{
   if($request==self::$POST){

     self::$method = $_POST;

   } else if($request==self::$GET){

     self::$method = $_GET;

   }else if($request==self::$DELETE || self::$PUT){
      self::getContents();
        $GLOBALS["_{$request}"] = self::$method;

        $_REQUEST = self::$method + $_REQUEST;
   }
   return $request;
 }
  public static function field(String $request):String{

   if (isset(self::$method[$request])) {
    
      return self::$method[$request];

    }
  }
  public static function getMethod():String{
    return $_SERVER['REQUEST_METHOD'];
  }
  public static function allField(){
    $request = self::getMethod();

    if($request==self::$POST){

     return $_POST;

   } else if($request==self::$GET){

    return $_GET;

   }else if($request==self::$DELETE || self::$PUT){
        self::getContents();
        $GLOBALS["_{$request}"] = self::$method;

        $_REQUEST = self::$method + $_REQUEST;
        return $_REQUEST;
   }
   return $request;
  }
  public static function getContents(){
    return  parse_str(file_get_contents('php://input'), self::$method);
  }
}
