<?php  
    namespace app\core;
    
    class Application{
        
        public Router $router;

        public function __construct()
        {
            $this -> route = new Router();
        }
        public function run()
        {

        }
    }
