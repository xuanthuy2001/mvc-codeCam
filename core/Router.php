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
          echo "not found ";
          exit();
        }
        echo call_user_func($callback);//không hiểu lắm nhứng chắc là lấy nội dung trả về trong funtion
    }
   }
