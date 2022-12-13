<?php  
   namespace app\core;

    class Router {
    public Request $request;
    public Response $response;

    protected array $routes = [];


    public function __construct(Request $request, Response $response){
      $this -> request = $request ;
      $this -> response = $response ;
    }
    public function get($path , $callback)
    {
      $this -> routes['get'][$path] = $callback; 
      // routes['get']['/'] = function ( ){return "hello world";}
    }
    public function post($path , $callback){
      $this -> routes['post'][$path] = $callback; 
     
    }

    public function resolve(){
      $path = $this -> request  -> getPath();
      $method = $this -> request -> method();
      
      $callback = $this -> routes[$method][$path] ?? false; // routes['get']['/']
        if($callback === false){
          $this -> response -> setStatusCode(404);
          return  $this -> renderView("_404");
        }

        if(is_string($callback)){
         
            return $this -> renderView( $callback);
        }
        // phù hợp khi viết  get('/home',[SiteController::class, 'home']);
        if(is_array($callback)){
          Application::$app -> controller  = new $callback[0]();
          $callback[0] = Application::$app ->controller;
        }
      //  echo '<pre>';
      //  var_dump($callback); 
      // => [0]=>object(app\controllers\SiteController)#6 (0) {}
      // [1]=>string(7) "contact"
      //  echo '</pre>';
   
        return call_user_func($callback,$this -> request);
        //không hiểu lắm nhứng chắc là lấy nội dung trả về trong funtion
    }
  public function renderView($view, $params=[]){ //renderView("home")
    $layoutContent = $this->layoutContent();
    $viewContent  = $this->renderOnLyView($view, $params);
    return str_replace('{{content}}', $viewContent ,$layoutContent);
  }
  public function renderContentView($viewContent){
      $layoutContent = $this->layoutContent();
      return str_replace('{{content}}', $viewContent ,$layoutContent);
  }
  public function layoutContent(){
    $layout = Application::$app -> controller->layout;
    ob_start();
    include_once  Application::$ROOT_DIR."/views/layouts/$layout.php";
    return ob_get_clean();
  }
  public function renderOnLyView($view, $params){
    // extract($params); chuyển key của mảng thành biến
    foreach($params as $key => $value){
      $$key = $value;
    }
    ob_start();
    include_once  Application::$ROOT_DIR."/views/$view.php";
    return ob_get_clean();
  }
}
