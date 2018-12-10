<?php
namespace Codefii\Controller;
use Codefii\FileReader;
use Codefii\View\View;
use Codefii\Controller\Template;
use Codefii\Session\Session;

abstract class BaseController
{
    
    protected $middleware = [];
     protected $route_params = [];
    protected $template_path ="app/templates/";
    protected $layout_path ="app/templates/layouts/";
    public    $global_view;
    protected $set_template;
    protected $view_data = array();
    public $session;
 
    final protected function view(string $view,$data=[])
    {
       
      $this->view_data = $data;
      $GLOBALS['magic'] = $data;
      $template = new Template();
        if($view !==NULL){
          $this->set_template = $view;
        $template->setPath($view);
         if(!file_exists($this->layout_path."base.php")){
          return View::render('System/404',["error"=>
          "No base file found in <b>apps/templates/layouts</b>"]);
         }else{
          $this->setFileName('base');
         }

        }   

    }

    public function setFileName($file){
      $this->global_view = $file;
      if(is_readable($this->layout_path."{$file}".".php")){
        if(isset($this->view_data)){
          extract($this->view_data, EXTR_SKIP | EXTR_REFS);
        }
      return require_once($this->layout_path."{$file}".".php");
     }
      
  }
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }

    public function getMiddleware()
    {
        return $this->middleware;
    }

   
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [{$method}] does not exist on [".get_class($this).'].');
    }

  }