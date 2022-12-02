<?php  
   namespace app\core;

    class Router {
    public Request $request;

    protected array $routes = [];


    public function __construct(Request $request){
      $this -> request = $request ;
    }


    public function get($path , $callback){
      $this -> routes['get'][$path] = $callback; 
      // routes['get']['/'] = function ( ){return "hello world";}
    }

    public function resolve(){
      $path = $this -> request  -> getPath();

      $method = $this -> request -> getMethod();
      
      $callback = $this -> routes[$method][$path] ?? false; // routes['get']['/']
        if($callback === false){
          return "not found ";
        }
        if(is_string($callback)){
            return $this -> renderView( $callback);
        }
        return call_user_func($callback);//không hiểu lắm nhứng chắc là lấy nội dung trả về trong funtion
    }
  public function renderView($view){
    $layoutContent = $this->layoutContent();
    $viewContent  = $this->renderOnLyView($view);
    return str_replace('{{content}}', $viewContent ,$layoutContent);
  }
  public function layoutContent(){
    ob_start();
    include_once  Application::$ROOT_DIR."/views/layouts/main.php";
    return ob_get_clean();
  }
  public function renderOnLyView($view){
    ob_start();
    include_once  Application::$ROOT_DIR."/views/$view.php";
    return ob_get_clean();
  }
}
