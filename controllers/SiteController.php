<?php  
    namespace app\controllers;

    use app\core\Request;
    class SiteController extends Controller {
        public function home(){
            $params = [
                'name' => 'the code cam'
            ];
            return $this -> render('home',$params);
        }

        public function contact(){
            return $this -> render('contact');
        } 
        public function handleContact(Request  $request){
           $body = $request->getBody();
            return "handle contact";
        }
    }
