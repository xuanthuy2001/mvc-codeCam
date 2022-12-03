<?php


namespace app\controllers;

use app\core\Request;
use app\models\RegisterModel;
use app\controllers\Controller;

class AuthController extends Controller
{
    public  function  login(){
        $this -> setLayout('auth');
        return $this -> render('login');
    }

    public  function  register(Request  $request){
     
        $registerModel = new RegisterModel();
        
        if($request -> isPost()){
            $registerModel -> loadData($request -> getBody());

           echo '<div class="code"><pre>🐘🐱‍👤';
           var_dump($registerModel);
           echo '</pre></div>';
           exit();
            if($registerModel -> validate() && $registerModel  -> register())
            {
                return "success";
            }
            return $this -> render('register',[
                'model' => $registerModel
            ]);
        }
        $this -> setLayout('auth');
        return $this -> render('register',[
            'model' => $registerModel
        ]);
    }
}